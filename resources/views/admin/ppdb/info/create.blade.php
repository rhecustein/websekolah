<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Tambah Informasi PPDB Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.informasi-ppdb.store') }}" method="POST">
                    @csrf
                    @include('admin.ppdb.info._form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
