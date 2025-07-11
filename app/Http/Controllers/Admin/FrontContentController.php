<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontContent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FrontContentController extends Controller
{
    /**
     * Menampilkan halaman manajemen konten (CMS).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ambil semua halaman unik yang ada di database untuk dropdown
        $pages = FrontContent::select('page')->distinct()->pluck('page');

        // Tentukan halaman yang sedang aktif, defaultnya adalah 'home'
        $activePage = $request->input('page', $pages->first() ?? 'home');

        // Ambil konten hanya untuk halaman yang aktif dan kelompokkan berdasarkan grup
        $contents = FrontContent::where('page', $activePage)->get()->groupBy('group');

        return view('admin.cms.index', compact('contents', 'pages', 'activePage'));
    }

    /**
     * Memperbarui konten halaman depan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $activePage = $request->input('page'); // Ambil halaman aktif dari input tersembunyi
        
        $contentItems = FrontContent::where('page', $activePage)->get();
        $rules = [];

        foreach ($contentItems as $item) {
            if ($item->type === 'image') {
                $rules[$item->key] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
            } elseif ($item->type === 'url') {
                $rules[$item->key] = 'nullable|url';
            } elseif ($item->type === 'number') {
                $rules[$item->key] = 'nullable|numeric';
            } else {
                $rules[$item->key] = 'nullable|string';
            }
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        foreach ($request->except(['_token', 'page']) as $key => $value) {
            $content = $contentItems->where('key', $key)->first();

            if ($content) {
                if ($content->type === 'image' && $request->hasFile($key)) {
                    if ($content->value) {
                        Storage::disk('public')->delete($content->value);
                    }
                    $path = $request->file($key)->store('frontend', 'public');
                    $content->value = $path;
                } else {
                    $content->value = $value;
                }
                $content->save();
            }
        }

        // Hapus cache untuk halaman yang baru saja diupdate
        Cache::forget('front_contents_' . $activePage);

        return redirect()->route('admin.cms.index', ['page' => $activePage])->with('success', 'Konten untuk halaman "' . ucfirst($activePage) . '" berhasil diperbarui.');
    }

    public function show($pageSlug)
    {
        // Mengambil semua konten untuk halaman yang diminta dari cache atau database
        $contents = Cache::rememberForever('front_contents_' . $pageSlug, function () use ($pageSlug) {
            return FrontContent::where('page', $pageSlug)->get();
        });

        // Jika tidak ada konten untuk halaman tersebut, tampilkan 404
        if ($contents->isEmpty()) {
            abort(404);
        }

        // Mengubah koleksi menjadi array asosiatif agar mudah diakses di view
        // Contoh: $pageData['hero_title'] akan berisi nilainya.
        $pageData = $contents->pluck('value', 'key');

        // Menentukan view mana yang akan digunakan.
        // Jika ada view khusus (e.g., 'sambutan.blade.php'), gunakan itu.
        // Jika tidak, gunakan template generik 'page-template.blade.php'.
        $viewName = 'public.pages.' . str_replace('_', '-', $pageSlug);
        if (!view()->exists($viewName)) {
            $viewName = 'public.pages.generic-template';
        }

        return view($viewName, compact('pageData'));
    }
}
