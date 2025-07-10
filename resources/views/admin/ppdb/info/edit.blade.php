<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Edit Informasi: ') . $informasiPpdb->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.informasi-ppdb.update', $informasiPpdb->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @include('admin.ppdb.info._form', ['informasiPpdb' => $informasiPpdb])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
