<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Pengaturan Situs & Profil Sekolah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white border shadow-sm border-slate-200 sm:rounded-lg">
                <form action="{{ route('admin.sekolah.update', $sekolah->id) }}" method="POST" enctype="multipart/form-data" x-data="{ tab: 'profil' }">
                    @csrf
                    @method('PUT')

                    {{-- Tab Headers --}}
                    <div class="px-6 pt-6 border-b border-slate-200">
                        <div class="flex overflow-x-auto -mb-px">
                            <button type="button" @click="tab = 'profil'" :class="{'border-sky-500 text-sky-600': tab === 'profil', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== 'profil'}" class="px-1 py-2 text-sm font-medium border-b-2 whitespace-nowrap focus:outline-none">
                                Profil Utama
                            </button>
                            <button type="button" @click="tab = 'branding'" :class="{'border-sky-500 text-sky-600': tab === 'branding', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== 'branding'}" class="px-1 py-2 ml-8 text-sm font-medium border-b-2 whitespace-nowrap focus:outline-none">
                                Branding & Media
                            </button>
                            <button type="button" @click="tab = 'seo'" :class="{'border-sky-500 text-sky-600': tab === 'seo', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== 'seo'}" class="px-1 py-2 ml-8 text-sm font-medium border-b-2 whitespace-nowrap focus:outline-none">
                                Pengaturan SEO
                            </button>
                            <button type="button" @click="tab = 'sosmed'" :class="{'border-sky-500 text-sky-600': tab === 'sosmed', 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300': tab !== 'sosmed'}" class="px-1 py-2 ml-8 text-sm font-medium border-b-2 whitespace-nowrap focus:outline-none">
                                Media Sosial
                            </button>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        {{-- Tab Content: Profil Utama --}}
                        <div x-show="tab === 'profil'" class="space-y-6">
                            <div class="p-6 bg-white border rounded-lg border-slate-200">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Informasi Dasar</h3>
                                <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
                                    <div>
                                        <x-input-label for="nama_sekolah" :value="__('Nama Sekolah')" />
                                        <x-text-input id="nama_sekolah" name="nama_sekolah" type="text" class="block w-full mt-1" :value="old('nama_sekolah', $sekolah->nama_sekolah)" required />
                                        <x-input-error :messages="$errors->get('nama_sekolah')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="jenjang" :value="__('Jenjang Pendidikan')" />
                                        <x-text-input id="jenjang" name="jenjang" type="text" class="block w-full mt-1" :value="old('jenjang', $sekolah->jenjang)" required />
                                        <x-input-error :messages="$errors->get('jenjang')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="kepala_sekolah" :value="__('Kepala Sekolah')" />
                                        <x-text-input id="kepala_sekolah" name="kepala_sekolah" type="text" class="block w-full mt-1" :value="old('kepala_sekolah', $sekolah->kepala_sekolah)" />
                                        <x-input-error :messages="$errors->get('kepala_sekolah')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="akreditasi" :value="__('Akreditasi')" />
                                        <x-text-input id="akreditasi" name="akreditasi" type="text" class="block w-full mt-1" :value="old('akreditasi', $sekolah->akreditasi)" />
                                        <x-input-error :messages="$errors->get('akreditasi')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 bg-white border rounded-lg border-slate-200">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Kontak & Alamat</h3>
                                <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
                                     <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $sekolah->email)" required />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="telepon" :value="__('Telepon')" />
                                        <x-text-input id="telepon" name="telepon" type="text" class="block w-full mt-1" :value="old('telepon', $sekolah->telepon)" />
                                        <x-input-error :messages="$errors->get('telepon')" class="mt-2" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <x-input-label for="website" :value="__('Website')" />
                                        <x-text-input id="website" name="website" type="url" class="block w-full mt-1" :value="old('website', $sekolah->website)" placeholder="https://contoh.com" />
                                        <x-input-error :messages="$errors->get('website')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <x-input-label for="alamat" :value="__('Alamat Lengkap')" />
                                    <textarea name="alamat" id="alamat" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('alamat', $sekolah->alamat) }}</textarea>
                                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                                </div>
                                <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-3">
                                    <div>
                                        <x-input-label for="kota" :value="__('Kota')" />
                                        <x-text-input id="kota" name="kota" type="text" class="block w-full mt-1" :value="old('kota', $sekolah->kota)" required />
                                        <x-input-error :messages="$errors->get('kota')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="provinsi" :value="__('Provinsi')" />
                                        <x-text-input id="provinsi" name="provinsi" type="text" class="block w-full mt-1" :value="old('provinsi', $sekolah->provinsi)" required />
                                        <x-input-error :messages="$errors->get('provinsi')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="kode_pos" :value="__('Kode Pos')" />
                                        <x-text-input id="kode_pos" name="kode_pos" type="text" class="block w-full mt-1" :value="old('kode_pos', $sekolah->kode_pos)" />
                                        <x-input-error :messages="$errors->get('kode_pos')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-6 bg-white border rounded-lg border-slate-200">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Deskripsi, Visi, & Misi</h3>
                                <div class="mt-6 space-y-6">
                                    <div>
                                        <x-input-label for="deskripsi" :value="__('Deskripsi Singkat Sekolah')" />
                                        <textarea name="deskripsi" id="deskripsi" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $sekolah->deskripsi) }}</textarea>
                                    </div>
                                     <div>
                                        <x-input-label for="visi" :value="__('Visi')" />
                                        <textarea name="visi" id="visi" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('visi', $sekolah->visi) }}</textarea>
                                    </div>
                                     <div>
                                        <x-input-label for="misi" :value="__('Misi')" />
                                        <textarea name="misi" id="misi" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('misi', $sekolah->misi) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tab Content: Branding & Media --}}
                        <div x-show="tab === 'branding'" class="space-y-6">
                            <div class="p-6 bg-white border rounded-lg border-slate-200" x-data="{ logoPreview: '{{ $sekolah->logo ? Storage::url($sekolah->logo) : '' }}' }">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Logo</h3>
                                <div class="flex items-center mt-4 space-x-6">
                                    <img x-show="logoPreview" :src="logoPreview" alt="Logo saat ini" class="object-contain w-24 h-24 p-2 bg-white border rounded-md border-slate-200">
                                    <div class="flex-1">
                                        <input type="file" name="logo" id="logo" @change="logoPreview = URL.createObjectURL($event.target.files[0])" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                        <p class="mt-1 text-xs text-slate-500">PNG, JPG, SVG, GIF hingga 2MB.</p>
                                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                             <div class="p-6 bg-white border rounded-lg border-slate-200" x-data="{ faviconPreview: '{{ $sekolah->favicon ? Storage::url($sekolah->favicon) : '' }}' }">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Favicon</h3>
                                <div class="flex items-center mt-4 space-x-6">
                                    <img x-show="faviconPreview" :src="faviconPreview" alt="Favicon saat ini" class="object-contain w-12 h-12 p-1 bg-white border rounded-md border-slate-200">
                                    <div class="flex-1">
                                        <input type="file" name="favicon" id="favicon" @change="faviconPreview = URL.createObjectURL($event.target.files[0])" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                        <p class="mt-1 text-xs text-slate-500">ICO, PNG hingga 2MB.</p>
                                        <x-input-error :messages="$errors->get('favicon')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 bg-white border rounded-lg border-slate-200" x-data="{ fotoPreview: '{{ $sekolah->foto_sekolah ? Storage::url($sekolah->foto_sekolah) : '' }}' }">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Foto Utama Sekolah</h3>
                                <div class="mt-4 space-y-4">
                                    <img x-show="fotoPreview" :src="fotoPreview" alt="Foto Sekolah" class="object-cover w-full bg-white border rounded-md max-h-64 border-slate-200">
                                    <div>
                                        <input type="file" name="foto_sekolah" id="foto_sekolah" @change="fotoPreview = URL.createObjectURL($event.target.files[0])" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                                        <p class="mt-1 text-xs text-slate-500">JPG, PNG hingga 4MB.</p>
                                        <x-input-error :messages="$errors->get('foto_sekolah')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tab Content: Pengaturan SEO --}}
                        <div x-show="tab === 'seo'" class="space-y-6">
                            <div class="p-6 bg-white border rounded-lg border-slate-200">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Meta Tags untuk Mesin Pencari</h3>
                                <p class="mt-1 text-sm text-slate-600">Pengaturan ini membantu mesin pencari seperti Google untuk memahami konten situs Anda.</p>
                                <div class="mt-6 space-y-6">
                                    <div>
                                        <x-input-label for="meta_title" :value="__('Meta Title')" />
                                        <x-text-input id="meta_title" name="meta_title" type="text" class="block w-full mt-1" :value="old('meta_title', $sekolah->meta_title)" />
                                        <p class="mt-1 text-xs text-slate-500">Judul yang muncul di tab browser dan hasil pencarian. Jika kosong, akan menggunakan nama sekolah.</p>
                                        <x-input-error :messages="$errors->get('meta_title')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="meta_description" :value="__('Meta Description')" />
                                        <textarea name="meta_description" id="meta_description" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('meta_description', $sekolah->meta_description) }}</textarea>
                                        <p class="mt-1 text-xs text-slate-500">Deskripsi singkat (optimal 155-160 karakter) untuk hasil pencarian.</p>
                                        <x-input-error :messages="$errors->get('meta_description')" class="mt-2" />
                                    </div>
                                    <div>
                                        <x-input-label for="meta_keywords" :value="__('Meta Keywords')" />
                                        <x-text-input id="meta_keywords" name="meta_keywords" type="text" class="block w-full mt-1" :value="old('meta_keywords', $sekolah->meta_keywords)" />
                                        <p class="mt-1 text-xs text-slate-500">Pisahkan setiap kata kunci dengan koma (,).</p>
                                        <x-input-error :messages="$errors->get('meta_keywords')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tab Content: Media Sosial --}}
                        <div x-show="tab === 'sosmed'" class="space-y-6">
                           <div class="p-6 bg-white border rounded-lg border-slate-200">
                                <h3 class="text-lg font-medium leading-6 text-slate-900">Tautan Media Sosial</h3>
                                <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">
                                    <div>
                                        <x-input-label for="link_facebook" :value="__('Facebook URL')" />
                                        <x-text-input id="link_facebook" name="link_facebook" type="url" class="block w-full mt-1" :value="old('link_facebook', $sekolah->link_facebook)" placeholder="https://facebook.com/namapengguna" />
                                        <x-input-error :messages="$errors->get('link_facebook')" class="mt-2" />
                                    </div>
                                     <div>
                                        <x-input-label for="link_instagram" :value="__('Instagram URL')" />
                                        <x-text-input id="link_instagram" name="link_instagram" type="url" class="block w-full mt-1" :value="old('link_instagram', $sekolah->link_instagram)" placeholder="https://instagram.com/namapengguna" />
                                        <x-input-error :messages="$errors->get('link_instagram')" class="mt-2" />
                                    </div>
                                     <div>
                                        <x-input-label for="link_twitter" :value="__('Twitter URL')" />
                                        <x-text-input id="link_twitter" name="link_twitter" type="url" class="block w-full mt-1" :value="old('link_twitter', $sekolah->link_twitter)" placeholder="https://twitter.com/namapengguna" />
                                        <x-input-error :messages="$errors->get('link_twitter')" class="mt-2" />
                                    </div>
                                     <div>
                                        <x-input-label for="link_youtube" :value="__('YouTube URL')" />
                                        <x-text-input id="link_youtube" name="link_youtube" type="url" class="block w-full mt-1" :value="old('link_youtube', $sekolah->link_youtube)" placeholder="https://youtube.com/c/namachannel" />
                                        <x-input-error :messages="$errors->get('link_youtube')" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center justify-end px-6 py-4 mt-6 -mx-6 -mb-6 space-x-3 bg-slate-50">
                        <a href="{{ route('admin.sekolah.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
