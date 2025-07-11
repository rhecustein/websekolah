<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Pengaturan Situs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-8 max-w-8xl sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <i class="mr-2 fas fa-check-circle"></i>{{ session('success') }}
                </div>
            @endif

            <!-- Form Pengaturan Utama -->
            <div class="overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg">
                <form action="{{ route('admin.pengaturan.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-6">
                        <h3 class="text-lg font-medium leading-6 text-slate-900">Pengaturan Umum & SEO</h3>
                        <p class="mt-1 text-sm text-slate-600">Pengaturan ini akan mempengaruhi nama situs, email kontak, dan tampilan di mesin pencari.</p>
                        
                        <div class="pt-6 mt-6 border-t border-slate-200">
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <x-input-label for="nama_sekolah" :value="__('Nama Situs (Sekolah)')" />
                                    <x-text-input id="nama_sekolah" name="nama_sekolah" type="text" class="block w-full mt-1" :value="old('nama_sekolah', $pengaturan->nama_sekolah)" required />
                                    <x-input-error :messages="$errors->get('nama_sekolah')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Email Kontak Utama')" />
                                    <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $pengaturan->email)" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 mt-6 border-t border-slate-200">
                            <div>
                                <x-input-label for="meta_title" :value="__('Meta Title')" />
                                <x-text-input id="meta_title" name="meta_title" type="text" class="block w-full mt-1" :value="old('meta_title', $pengaturan->meta_title)" />
                                <p class="mt-1 text-xs text-slate-500">Judul yang muncul di tab browser dan hasil pencarian. Jika kosong, akan menggunakan nama sekolah.</p>
                                <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                            </div>
                        </div>
                        <div class="pt-6 mt-6 border-t border-slate-200">
                            <div>
                                <x-input-label for="meta_description" :value="__('Meta Description')" />
                                <textarea name="meta_description" id="meta_description" rows="3" class="block w-full mt-1 rounded-md shadow-sm border-slate-300 text-slate-900 focus:border-sky-500 focus:ring-sky-500">{{ old('meta_description', $pengaturan->meta_description) }}</textarea>
                                <p class="mt-1 text-xs text-slate-500">Deskripsi singkat (optimal 155-160 karakter) untuk hasil pencarian.</p>
                                <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                            </div>
                        </div>
                        <div class="pt-6 mt-6 border-t border-slate-200">
                            <div>
                                <x-input-label for="meta_keywords" :value="__('Meta Keywords')" />
                                <x-text-input id="meta_keywords" name="meta_keywords" type="text" class="block w-full mt-1" :value="old('meta_keywords', $pengaturan->meta_keywords)" />
                                <p class="mt-1 text-xs text-slate-500">Pisahkan setiap kata kunci dengan koma (,).</p>
                                <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-6 py-4 mt-6 -mx-6 -mb-6 space-x-3 bg-slate-50 border-t border-slate-200">
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Opsi Maintenance -->
            <div class="overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg" x-data="{ showConfirm: false }">
                <div class="p-6">
                    <h3 class="text-lg font-medium leading-6 text-slate-900">Tindakan Sistem</h3>
                    <p class="mt-1 text-sm text-slate-600">Gunakan tombol ini untuk membersihkan cache konfigurasi, tampilan, dan data sementara lainnya. Berguna jika perubahan terbaru tidak muncul.</p>
                    <div class="pt-6 mt-6 border-t border-slate-200">
                         <button type="button" @click="showConfirm = true" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="mr-2 fas fa-trash"></i>
                            Bersihkan Cache Aplikasi
                        </button>
                    </div>
                </div>

                <!-- Modal Konfirmasi -->
                <div x-show="showConfirm" class="fixed inset-0 z-50 flex items-center justify-center px-4 py-6 bg-black bg-opacity-50" x-cloak>
                    <div class="w-full max-w-sm p-6 bg-white rounded-lg shadow-xl" @click.away="showConfirm = false">
                        <h3 class="text-lg font-bold">Konfirmasi Tindakan</h3>
                        <p class="mt-2 text-sm text-slate-600">Anda yakin ingin membersihkan semua cache aplikasi? Tindakan ini tidak dapat diurungkan.</p>
                        <div class="flex justify-end mt-6 space-x-3">
                            <button type="button" @click="showConfirm = false" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">Batal</button>
                            <form action="{{ route('admin.pengaturan.clear-cache') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700">Ya, Bersihkan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
