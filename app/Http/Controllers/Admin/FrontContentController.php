<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontContent;

class FrontContentController extends Controller
{
    public function index()
    {
        // Ambil semua konten dan kelompokkan berdasarkan grup
        $contents = FrontContent::all()->groupBy('group');
        return view('admin.cms.index', compact('contents'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            $content = FrontContent::where('key', $key)->first();
            if ($content) {
                // Handle file uploads
                if ($request->hasFile($key)) {
                    // Hapus file lama jika ada
                    if ($content->value && file_exists(storage_path('app/public/' . $content->value))) {
                        unlink(storage_path('app/public/' . $content->value));
                    }
                    // Simpan file baru
                    $path = $request->file($key)->store('frontend', 'public');
                    $content->value = $path;
                } else {
                    // Simpan nilai teks
                    $content->value = $value;
                }
                $content->save();
            }
        }

        return back()->with('success', 'Konten halaman depan berhasil diperbarui.');
    }
}
