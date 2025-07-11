<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Tambah Data Staf Baru
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Isi formulir di bawah untuk menambahkan data staf atau tenaga kependidikan baru.
                </p>
            </div>
            <a href="{{ route('admin.staf.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Manajemen Staf
            </a>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    {{-- Kontainer utama yang bersih, menyerahkan styling ke komponen _form --}}
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('admin.staf.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            {{-- 
              - Memanggil komponen form yang sudah ditingkatkan.
              - Mengirim `['staf' => null]` menandakan ini mode 'create'.
            --}}
            @include('admin.staf._form', ['staf' => null])
            
        </form>
    </div>
</x-app-layout>