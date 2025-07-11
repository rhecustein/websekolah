<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-slate-800">
                    {{ __('Album: ') . $albumGaleri->nama }}
                </h2>
                <p class="mt-1 text-sm text-slate-600">{{ $albumGaleri->deskripsi }}</p>
            </div>
            <div class="flex space-x-2">
                 <a href="{{ route('admin.foto.create', ['album_id' => $albumGaleri->id]) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md hover:bg-green-700">
                    <i class="mr-2 fas fa-camera"></i> Tambah Foto
                </a>
                 <a href="{{ route('admin.video.create', ['album_id' => $albumGaleri->id]) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                    <i class="mr-2 fas fa-video"></i> Tambah Video
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
             <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <h3 class="text-lg font-medium text-slate-900">Isi Album</h3>
                <div class="mt-4">
                    {{-- Di sini Anda akan menampilkan daftar foto dan video yang terkait dengan album ini --}}
                    <p class="text-center text-gray-500 py-16">
                        Belum ada konten di dalam album ini.
                        <br>
                        Silakan tambahkan foto atau video menggunakan tombol di atas.
                    </p>
                </div>
             </div>
        </div>
    </div>
</x-app-layout>
