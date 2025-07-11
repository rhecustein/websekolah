<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Edit Banner
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Perbarui detail banner yang sudah ada di slider halaman depan.
                </p>
            </div>
            <a href="{{ route('admin.banners.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar Banner
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    {{-- Layout utama tanpa padding vertikal berlebih --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden rounded-xl shadow-lg">
            <div class="p-6 md:p-8">
                {{-- Form action tetap di sini, membungkus file _form --}}
                <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    {{-- Memanggil file _form yang sudah kita tingkatkan --}}
                    @include('admin.banners._form', ['banner' => $banner])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>