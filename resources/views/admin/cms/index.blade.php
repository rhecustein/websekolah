<x-app-layout>
    {{-- START: Header Halaman yang Ditingkatkan --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Konten Website
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Ubah teks, gambar, dan informasi lain yang tampil di halaman depan website Anda.
                </p>
            </div>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        {{-- Notifikasi Sukses yang lebih konsisten --}}
        @if (session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg shadow" role="alert" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                <div class="flex justify-between items-center">
                    <div>
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                    <button @click="show = false" class="text-green-900 hover:text-green-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        {{-- START: Layout Utama Dua Kolom --}}
        <div x-data="{ tab: '{{ array_key_first($contents->toArray()) ?? 'default' }}' }" class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            {{-- Kolom Kiri: Navigasi Tab Visual --}}
            <div class="lg:col-span-1">
                <nav class="flex flex-col space-y-2" aria-label="Tabs">
                    @foreach ($contents as $group => $items)
                        <button @click="tab = '{{ $group }}'"
                            :class="{ 'bg-sky-600 text-white shadow-md': tab === '{{ $group }}', 'text-slate-600 hover:bg-slate-100': tab !== '{{ $group }}' }"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-lg transition-all duration-200 text-left">
                            
                            {{-- Menambahkan Ikon (Contoh) --}}
                            @php
                                $icons = [
                                    'sambutan' => 'fas fa-hands-helping',
                                    'tentang_kami' => 'fas fa-info-circle',
                                    'kontak' => 'fas fa-phone-alt',
                                    'default' => 'fas fa-file-alt'
                                ];
                            @endphp
                            <i class="{{ $icons[$group] ?? $icons['default'] }} fa-fw text-base"></i>
                            <span class="capitalize">{{ str_replace('_', ' ', $group) }}</span>
                        </button>
                    @endforeach
                </nav>
            </div>

            {{-- Kolom Kanan: Form Konten --}}
            <div class="lg:col-span-3">
                <form action="{{ route('admin.cms.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg">
                    @csrf
                    <div class="p-6 md:p-8">
                        {{-- Render Konten Tab secara Dinamis --}}
                        @foreach ($contents as $group => $items)
                            <div x-show="tab === '{{ $group }}'" class="space-y-8" x-cloak>
                                @foreach ($items as $item)
                                    <div>
                                        <label for="{{ $item->key }}" class="block text-sm font-medium text-slate-700 mb-1">{{ $item->label }}</label>
                                        
                                        @if ($item->type === 'textarea')
                                            <textarea name="{{ $item->key }}" id="{{ $item->key }}" rows="6" class="block w-full border-slate-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm">{{ old($item->key, $item->value) }}</textarea>
                                        
                                        @elseif ($item->type === 'file')
                                            {{-- Component Upload Gambar Interaktif --}}
                                            <div x-data="{ imageUrl: '{{ $item->value ? Storage::url($item->value) : '' }}' }" class="mt-1">
                                                <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-slate-100 flex items-center justify-center">
                                                    <img :src="imageUrl" alt="Pratinjau Gambar" class="object-cover w-full h-full" x-show="imageUrl">
                                                    <div x-show="!imageUrl" class="text-slate-400 text-center">
                                                        <i class="fas fa-image fa-3x"></i>
                                                        <p class="mt-2 text-sm">Pratinjau Gambar</p>
                                                    </div>
                                                </div>
                                                <input type="file" name="{{ $item->key }}" id="{{ $item->key }}" class="sr-only" @change="imageUrl = URL.createObjectURL($event.target.files[0])">
                                                <label for="{{ $item->key }}" class="cursor-pointer mt-4 inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 w-full">
                                                    <i class="fas fa-upload"></i>
                                                    {{ $item->value ? 'Ganti Gambar' : 'Pilih Gambar' }}
                                                </label>
                                            </div>
                                            
                                        @else {{-- Default to text input --}}
                                            <input type="text" name="{{ $item->key }}" id="{{ $item->key }}" value="{{ old($item->key, $item->value) }}" class="block w-full border-slate-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                                        @endif

                                        @if($item->helper)
                                            <p class="mt-2 text-xs text-slate-500">{{ $item->helper }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    {{-- Footer Tombol Simpan --}}
                    <div class="flex items-center justify-end px-6 py-4 bg-slate-50 text-right rounded-b-xl border-t border-slate-200">
                        <button type="submit"
                            class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- END: Layout Utama Dua Kolom --}}
    </div>
</x-app-layout>