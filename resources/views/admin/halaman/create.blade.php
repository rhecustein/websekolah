<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Buat Halaman Baru
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Gunakan editor di bawah untuk membuat halaman statis baru.
                </p>
            </div>
            <a href="{{ route('admin.halaman.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Manajemen Halaman
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    {{-- 
      - Form ini mengarah ke route 'store' untuk membuat data baru.
      - Kontainer utama tidak lagi memiliki class `py-12` atau `bg-white` karena styling
        sudah ditangani oleh komponen _form untuk konsistensi.
    --}}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('admin.halaman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- 
              - Memanggil komponen form.
              - Mengirim `['halaman' => null]` menandakan ini adalah mode 'create',
                sehingga form akan ditampilkan kosong.
            --}}
            @include('admin.halaman._form', ['halaman' => null])
            
        </form>
    </div>
</x-app-layout>