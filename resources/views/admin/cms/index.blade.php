<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">
                    Manajemen Konten Website
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Pilih halaman yang ingin Anda ubah kontennya dari dropdown di bawah.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            {{-- Notifikasi Sukses --}}
            @if (session('success'))
                <div class="p-4 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-r-lg shadow" role="alert" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                    <div class="flex items-center justify-between">
                        <div><i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}</div>
                        <button @click="show = false" class="text-green-900 hover:text-green-700"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            @endif

            {{-- Pemilih Halaman (Page Selector) --}}
            <div class="mb-8">
                <label for="page_selector" class="block text-sm font-medium text-slate-700">Pilih Halaman untuk Diedit</label>
                <select id="page_selector" name="page" onchange="window.location.href=this.value;"
                        class="block w-full max-w-sm mt-1 border-gray-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    @foreach($pages as $page)
                        <option value="{{ route('admin.cms.index', ['page' => $page]) }}" {{ $activePage == $page ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $page)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if($contents && $contents->isNotEmpty())
                <div x-data="{ tab: '{{ array_key_first($contents->toArray()) ?? 'default' }}' }" class="grid grid-cols-1 gap-8 lg:grid-cols-4">
                    
                    {{-- Kolom Kiri: Navigasi Grup Konten --}}
                    <aside class="lg:col-span-1">
                        <div class="sticky top-24">
                            <h3 class="px-4 mb-2 text-xs font-bold tracking-wider uppercase text-slate-500">Grup Konten</h3>
                            <nav class="flex flex-col space-y-2" aria-label="Tabs">
                                @foreach ($contents as $group => $items)
                                    <button @click="tab = '{{ $group }}'" :class="{ 'bg-sky-600 text-white shadow': tab === '{{ $group }}', 'text-slate-600 hover:bg-slate-100': tab !== '{{ $group }}' }" class="flex items-center w-full gap-3 px-4 py-3 text-sm font-semibold text-left transition-all duration-200 rounded-lg">
                                        @php
                                            $icons = ['hero' => 'fas fa-bullhorn', 'features' => 'fas fa-star', 'stats' => 'fas fa-chart-bar', 'cta' => 'fas fa-mouse-pointer', 'footer' => 'fas fa-shoe-prints', 'header' => 'fas fa-heading', 'content' => 'fas fa-file-alt', 'default' => 'fas fa-layer-group'];
                                        @endphp
                                        <i class="{{ $icons[$group] ?? $icons['default'] }} fa-fw text-base w-5 text-center"></i>
                                        <span class="capitalize">{{ str_replace('_', ' ', $group) }}</span>
                                    </button>
                                @endforeach
                            </nav>
                        </div>
                    </aside>

                    {{-- Kolom Kanan: Form Konten --}}
                    <main class="lg:col-span-3">
                        <form action="{{ route('admin.cms.update') }}" method="POST" enctype="multipart/form-data" class="bg-white border rounded-xl shadow-sm border-slate-200">
                            @csrf
                            <input type="hidden" name="page" value="{{ $activePage }}">
                            
                            <div class="p-6 border-b md:p-8 border-slate-200">
                                <h3 class="text-xl font-bold text-slate-800">Mengedit Halaman: <span class="text-sky-600">{{ ucfirst(str_replace('_', ' ', $activePage)) }}</span></h3>
                            </div>

                            <div class="p-6 md:p-8">
                                @foreach ($contents as $group => $items)
                                    <div x-show="tab === '{{ $group }}'" class="space-y-8" x-cloak>
                                        @foreach ($items as $item)
                                            <div class="py-6 border-b border-slate-200 last:border-b-0">
                                                <label for="{{ $item->key }}" class="block text-sm font-medium text-slate-700">{{ $item->label }}</label>
                                                @if($item->notes)<p class="mt-1 text-xs text-slate-500">{{ $item->notes }}</p>@endif
                                                
                                                <div class="mt-2">
                                                    @if ($item->type === 'richtext')
                                                        <textarea name="{{ $item->key }}" id="{{ $item->key }}" class="tinymce-editor">{{ old($item->key, $item->value) }}</textarea>
                                                    @elseif ($item->type === 'textarea')
                                                        <textarea name="{{ $item->key }}" id="{{ $item->key }}" rows="5" class="block w-full rounded-md shadow-sm border-slate-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">{{ old($item->key, $item->value) }}</textarea>
                                                    @elseif ($item->type === 'image')
                                                        <div x-data="{ imageUrl: '{{ $item->value ? asset('storage/' . $item->value) : '' }}' }" class="w-full">
                                                            <div class="w-full p-2 mb-2 border rounded-md h-44 bg-slate-50 border-slate-200" x-show="imageUrl"><img :src="imageUrl" alt="Pratinjau Gambar" class="object-contain w-full h-full"></div>
                                                            <input type="file" name="{{ $item->key }}" id="{{ $item->key }}" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100" @change="imageUrl = URL.createObjectURL($event.target.files[0])">
                                                        </div>
                                                    @elseif ($item->type === 'repeater')
                                                        <div x-data='{ items: {{ old($item->key, $item->value) ?? "[]" }}, newItem: { icon: "fas fa-check", title: "", description: "" }, addItem() { this.items.push({ ...this.newItem }); }, removeItem(index) { this.items.splice(index, 1); }}' class="p-4 space-y-4 border rounded-md bg-slate-50 border-slate-200">
                                                            <input type="hidden" :name="`{{ $item->key }}`" :value="JSON.stringify(items)">
                                                            <template x-for="(item, index) in items" :key="index">
                                                                <div class="relative flex p-4 space-x-4 bg-white border rounded-md shadow-sm">
                                                                    <div class="flex-grow space-y-3"><input type="text" x-model="item.icon" placeholder="Ikon (e.g., fas fa-star)" class="block w-full text-sm border-slate-300 rounded-md shadow-sm"><input type="text" x-model="item.title" placeholder="Judul" class="block w-full text-sm border-slate-300 rounded-md shadow-sm"><textarea x-model="item.description" placeholder="Deskripsi" rows="2" class="block w-full text-sm border-slate-300 rounded-md shadow-sm"></textarea></div>
                                                                    <button type="button" @click="removeItem(index)" class="absolute top-2 right-2 text-red-500 hover:text-red-700">&times;</button>
                                                                </div>
                                                            </template>
                                                            <button type="button" @click="addItem()" class="w-full px-4 py-2 text-sm font-medium text-center border-2 border-dashed rounded-md text-slate-500 border-slate-300 hover:border-sky-500 hover:text-sky-600">+ Tambah Item</button>
                                                        </div>
                                                    @else
                                                        <input type="{{ in_array($item->type, ['url', 'number']) ? $item->type : 'text' }}" name="{{ $item->key }}" id="{{ $item->key }}" value="{{ old($item->key, $item->value) }}" class="block w-full rounded-md shadow-sm border-slate-300 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                                                    @endif
                                                </div>
                                                @error($item->key) <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div class="flex items-center justify-end px-6 py-4 bg-slate-50 rounded-b-xl border-t border-slate-200">
                                <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white bg-sky-600 border border-transparent rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">Simpan Perubahan</button>
                            </div>
                        </form>
                    </main>
                </div>
            @else
                <div class="p-8 text-center bg-white border rounded-lg shadow-sm border-slate-200">
                    <div class="max-w-md mx-auto"><i class="mb-4 text-5xl text-slate-400 fas fa-box-open"></i><h3 class="text-xl font-semibold text-slate-800">Belum Ada Konten untuk Di-edit</h3><p class="mt-2 text-slate-600">Sistem manajemen konten belum memiliki data untuk ditampilkan. Pastikan Anda telah menjalankan database seeder untuk mengisi konten awal.</p><div class="mt-6 text-sm text-left bg-slate-100 p-4 rounded-md"><p class="font-semibold text-slate-700">Saran:</p><p class="mt-1 text-slate-600">Jalankan perintah berikut di terminal proyek Anda:</p><code class="block p-2 mt-2 font-mono text-xs text-red-600 bg-red-50 rounded">php artisan db:seed --class=FrontContentSeeder</code></div></div>
                </div>
            @endif
        </div>
    </div>

    {{-- Script untuk TinyMCE Rich Text Editor --}}
    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/u4g4qhgicye8ic2xpmruo2g27wvazbihir233uj0slxzfc56/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                tinymce.init({
                    selector: 'textarea.tinymce-editor',
                    plugins: 'autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template paste textpattern',
                    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                    height: 300,
                });
            });
        </script>
    @endpush
</x-app-layout>
