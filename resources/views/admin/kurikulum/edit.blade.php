<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Edit Kurikulum: ') . $kurikulum->nama_kurikulum }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.kurikulum.update', $kurikulum->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.kurikulum._form', ['kurikulum' => $kurikulum])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
