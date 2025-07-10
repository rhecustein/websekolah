<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Manajemen Konten Halaman Depan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center justify-between p-4 mb-6 text-sm text-green-700 bg-green-100 rounded-lg"
                    role="alert">
                    <p><i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}</p>
                    <button @click="show = false" class="ml-4 text-green-900 hover:text-green-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            <div x-data="{ tab: '{{ array_key_first($contents->toArray()) ?? 'default' }}' }" class="bg-white shadow-sm sm:rounded-lg">
                <div class="px-4 border-b sm:px-6 border-slate-200">
                    <nav class="flex -mb-px space-x-6" aria-label="Tabs">
                        {{-- Render Tombol Tab secara Dinamis --}}
                        @foreach ($contents as $group => $items)
                            <button @click="tab = '{{ $group }}'"
                                :class="{ 'border-sky-500 text-sky-600': tab === '{{ $group }}', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== '{{ $group }}' }"
                                class="px-1 py-4 text-sm font-medium capitalize border-b-2 whitespace-nowrap">
                                {{ str_replace('_', ' ', $group) }}
                            </button>
                        @endforeach
                    </nav>
                </div>

                <form action="{{ route('admin.cms.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6">
                        {{-- Render Konten Tab secara Dinamis --}}
                        @foreach ($contents as $group => $items)
                            <div x-show="tab === '{{ $group }}'" class="space-y-6" x-cloak>
                                @foreach ($items as $item)
                                    <div>
                                        <label for="{{ $item->key }}" class="block text-sm font-medium text-slate-700">{{ $item->label }}</label>
                                        
                                        @if ($item->type === 'textarea')
                                            <textarea name="{{ $item->key }}" id="{{ $item->key }}" rows="5" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old($item->key, $item->value) }}</textarea>
                                        
                                        @elseif ($item->type === 'file')
                                            <div class="flex items-center mt-2 space-x-4">
                                                @if($item->value)
                                                <img src="{{ Storage::url($item->value) }}" alt="Gambar saat ini" class="object-contain p-1 border rounded-md h-28">
                                                @endif
                                                <input type="file" name="{{ $item->key }}" id="{{ $item->key }}" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                            </div>
                                            @if($item->value)
                                            <p class="mt-1 text-xs text-slate-500">Unggah file baru untuk menggantikan yang lama.</p>
                                            @endif

                                        @else {{-- Default to text input --}}
                                            <input type="text" name="{{ $item->key }}" id="{{ $item->key }}" value="{{ old($item->key, $item->value) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                        @endif

                                        @if($item->helper)
                                            <p class="mt-2 text-xs text-slate-500">{{ $item->helper }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-end px-6 py-4 bg-slate-50 text-right sm:rounded-b-lg">
                        <button type="submit"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
