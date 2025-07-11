<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Edit Album: ') . $albumGaleri->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.album-galeri.update', $albumGaleri->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.galeri._form', ['albumGaleri' => $albumGaleri])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
