<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrontContent;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    /**
     * Menampilkan halaman dinamis berdasarkan slug.
     *
     * @param string $pageSlug
     * @return \Illuminate\View\View
     */
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
