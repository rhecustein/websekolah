<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold leading-tight text-slate-800">
                {{ __('Tambah Dokumen Baru') }}
            </h2>
            {{-- Anda bisa menambahkan breadcrumb di sini jika diperlukan --}}
            {{-- Contoh Breadcrumb:
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-sky-600">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('admin.dokumen.index') }}" class="ms-1 text-sm font-medium text-slate-700 hover:text-sky-600 md:ms-2">Manajemen Dokumen</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2">Tambah Baru</span>
                        </div>
                    </li>
                </ol>
            </nav>
            --}}
        </div>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8"> {{-- max-w-4xl diubah menjadi max-w-8xl untuk layout form yang lebih luas --}}
            <div class="bg-white rounded-xl shadow-lg"> {{-- Menggunakan kelas shadow-lg dan rounded-xl --}}
                <form action="{{ route('admin.dokumen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.dokumen._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>