{{-- File: resources/views/admin/berita/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Edit Berita
                </h2>
                {{-- Gunakan variabel $beritum --}}
                <p class="mt-1 text-sm text-slate-500">
                    Anda sedang memperbarui artikel: <span class="font-semibold">{{ $beritum->judul }}</span>
                </p>
            </div>
            <a href="{{ route('admin.berita.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Manajemen Berita
            </a>
        </div>
    </x-slot>

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        {{-- Gunakan $beritum->id untuk parameter route --}}
        <form action="{{ route('admin.berita.update', $beritum->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            {{-- 
              PENTING:
              Kita mengirim data dari `$beritum` ke dalam _form.blade.php
              dan menamainya sebagai 'berita' agar file _form tetap reusable.
            --}}
            @include('admin.berita._form', ['berita' => $beritum])
            
        </form>
    </div>
</x-app-layout>