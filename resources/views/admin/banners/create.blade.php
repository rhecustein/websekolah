<x-app-layout>
    {{-- START: Header Halaman --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Tambah Banner Baru
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Isi formulir di bawah ini untuk menambahkan banner ke slider halaman depan.
                </p>
            </div>
            <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar Banner
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden rounded-xl shadow-lg">
            <div class="p-6 md:p-8">
                {{-- Arahkan form ke route 'store' dengan method 'POST' --}}
                <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Menggunakan file _form yang sama dengan halaman edit --}}
                    {{-- Variabel $banner di-pass sebagai null untuk menandakan ini adalah form 'create' --}}
                    @include('admin.banners._form', ['banner' => null])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>