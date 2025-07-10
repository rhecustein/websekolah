<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Edit Dokumen: ') . $dokuman->nama }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                {{-- Perhatikan penggunaan $dokuman sesuai dengan variabel di controller --}}
                <form action="{{ route('admin.dokumen.update', $dokuman->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.dokumen._form', ['dokuman' => $dokuman])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
