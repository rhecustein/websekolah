<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Edit Pengumuman: ') . Str::limit($pengumuman->judul, 30) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.pengumuman.update', $pengumuman->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.pengumuman._form', ['pengumuman' => $pengumuman])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
