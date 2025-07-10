<x-app-layout>
    <x-slot name="header">
        {{ __('Pengaturan Situs') }}
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                class="flex items-center justify-between p-4 text-sm text-green-700 bg-green-100 rounded-lg"
                role="alert">
                <p><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</p>
                <button @click="show = false" class="ml-4 text-green-900 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <div x-data="{ tab: 'umum' }" class="bg-white shadow-sm sm:rounded-lg">
            <div class="px-4 sm:px-6 border-b border-slate-200">
                <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                    {{-- Tombol Tab --}}
                    <button @click="tab = 'umum'"
                        :class="{ 'border-sky-500 text-sky-600': tab === 'umum', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== 'umum' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Umum
                    </button>
                    <button @click="tab = 'analytics'"
                        :class="{ 'border-sky-500 text-sky-600': tab === 'analytics', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== 'analytics' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Google Analytics
                    </button>
                    <button @click="tab = 'seo'"
                        :class="{ 'border-sky-500 text-sky-600': tab === 'seo', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== 'seo' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        SEO & Media Sosial
                    </button>
                     <button @click="tab = 'tindakan'"
                        :class="{ 'border-sky-500 text-sky-600': tab === 'tindakan', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== 'tindakan' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Tindakan Sistem
                    </button>
                </nav>
            </div>

            <form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-6 space-y-6">
                    {{-- KONTEN TAB --}}
                    <div x-show="tab === 'umum'" class="space-y-6">
                        <h3 class="text-lg font-medium text-slate-900">Pengaturan Umum</h3>
                        <div>
                            <label for="nama_sekolah" class="block text-sm font-medium text-slate-700">Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah', $sekolah->nama_sekolah ?? '') }}" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="email_kontak" class="block text-sm font-medium text-slate-700">Email Kontak</label>
                            <input type="email" name="email_kontak" id="email_kontak" value="{{ old('email_kontak', $sekolah->email ?? '') }}" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                            <p class="mt-2 text-xs text-slate-500">Email ini akan ditampilkan di halaman kontak.</p>
                        </div>
                        {{-- Tambahkan field lain dari tabel sekolah jika ada, contoh: --}}
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-slate-700">Telepon</label>
                            <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $sekolah->telepon ?? '') }}" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-slate-700">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">{{ old('alamat', $sekolah->alamat ?? '') }}</textarea>
                        </div>
                    </div>

                    <div x-show="tab === 'analytics'" x-cloak class="space-y-6">
                        <h3 class="text-lg font-medium text-slate-900">Pengaturan Google Analytics</h3>
                        <div>
                            <label for="analytics_property_id" class="block text-sm font-medium text-slate-700">Analytics Property ID</label>
                            <input type="text" name="analytics_property_id" id="analytics_property_id" value="{{ config('analytics.property_id') }}" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Contoh: 123456789">
                            <p class="mt-2 text-xs text-slate-500">Masukkan ID Properti Google Analytics 4 Anda.</p>
                        </div>
                        <div>
                            <label for="analytics_credentials" class="block text-sm font-medium text-slate-700">Service Account Credentials (JSON)</label>
                            <p class="mt-2 text-xs text-slate-500">Untuk keamanan, path ke file kredensial JSON harus diatur langsung di file `.env` dengan key `ANALYTICS_CREDENTIALS_PATH`.</p>
                            <div class="mt-2 p-3 bg-slate-100 rounded-md text-sm text-slate-600">
                                Path saat ini: `{{ config('analytics.credentials_path') ?: 'Belum diatur' }}`
                            </div>
                        </div>
                    </div>

                    <div x-show="tab === 'seo'" x-cloak class="space-y-6">
                         <h3 class="text-lg font-medium text-slate-900">SEO & Media Sosial</h3>
                         <div>
                            <label for="meta_description" class="block text-sm font-medium text-slate-700">Meta Deskripsi</label>
                            <textarea name="meta_description" id="meta_description" rows="3" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Deskripsi singkat tentang sekolah Anda untuk mesin pencari.">{{ old('meta_description', $sekolah->meta_description ?? '') }}</textarea>
                        </div>
                        <div>
                            <label for="facebook_url" class="block text-sm font-medium text-slate-700">URL Facebook</label>
                            <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $sekolah->facebook_url ?? '') }}" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="https://facebook.com/namasekolah">
                        </div>
                        <div>
                            <label for="instagram_url" class="block text-sm font-medium text-slate-700">URL Instagram</label>
                            <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $sekolah->instagram_url ?? '') }}" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="https://instagram.com/namasekolah">
                        </div>
                         <div>
                            <label for="youtube_url" class="block text-sm font-medium text-slate-700">URL Youtube</label>
                            <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $sekolah->youtube_url ?? '') }}" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="https://youtube.com/c/namasekolah">
                        </div>
                    </div>

                    <div x-show="tab === 'tindakan'" x-cloak class="space-y-6">
                        <h3 class="text-lg font-medium text-slate-900">Tindakan Sistem</h3>
                        <div class="p-4 border border-amber-300 bg-amber-50 rounded-md">
                            <h4 class="font-semibold text-amber-800">Perhatian!</h4>
                            <p class="text-sm text-amber-700">Tindakan ini akan membersihkan cache sistem. Lakukan hanya jika Anda mengalami masalah tampilan atau data yang tidak sinkron.</p>
                        </div>
                        <div class="flex space-x-4">
                            {{-- Tombol ini bisa dihubungkan ke route khusus yang menjalankan Artisan command --}}
                            <a href="#" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 active:bg-amber-700 focus:outline-none focus:border-amber-700 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-broom mr-2"></i>
                                Clear All Caches
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end px-6 py-4 bg-slate-50 text-right sm:rounded-b-lg">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
