@props(['banner' => null])

{{-- Pesan error validasi --}}
@if ($errors->any())
    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg" role="alert">
        <p class="font-bold">Terjadi Kesalahan</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="list-disc list-inside">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- START: Layout Form Dua Kolom --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    {{-- Kolom Kiri: Input Data --}}
    <div class="lg:col-span-2 space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-slate-700">Judul Banner</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500" value="{{ old('title', $banner?->title) }}" placeholder="Contoh: PPDB Tahun Ajaran Baru" required>
            <p class="mt-2 text-xs text-slate-500">Judul utama yang akan tampil besar di banner.</p>
        </div>

        <div>
            <label for="subtitle" class="block text-sm font-medium text-slate-700">Subjudul (Opsional)</label>
            <input type="text" name="subtitle" id="subtitle" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500" value="{{ old('subtitle', $banner?->subtitle) }}" placeholder="Contoh: Segera daftarkan putra-putri Anda!">
            <p class="mt-2 text-xs text-slate-500">Teks singkat yang muncul di bawah judul.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="order" class="block text-sm font-medium text-slate-700">Nomor Urutan</label>
                <input type="number" name="order" id="order" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500" value="{{ old('order', $banner?->order ?? '1') }}" min="1">
                <p class="mt-2 text-xs text-slate-500">Menentukan posisi banner di slider.</p>
            </div>

            <div>
                <label for="is_active" class="block text-sm font-medium text-slate-700">Status</label>
                <select name="is_active" id="is_active" class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    <option value="1" @selected(old('is_active', $banner?->is_active) == 1)>Aktif</option>
                    <option value="0" @selected(old('is_active', $banner?->is_active) == 0)>Tidak Aktif</option>
                </select>
                <p class="mt-2 text-xs text-slate-500">Hanya banner aktif yang akan tampil.</p>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Upload dan Pratinjau Gambar --}}
    <div class="lg:col-span-1">
        <label class="block text-sm font-medium text-slate-700">Gambar Banner</label>
        <div 
            x-data="{ imageUrl: '{{ $banner?->image_path ? asset('storage/' . $banner->image_path) : '' }}' }" 
            class="mt-1"
        >
            <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden bg-slate-100 flex items-center justify-center">
                <img 
                    :src="imageUrl" 
                    alt="Pratinjau Banner" 
                    class="object-cover w-full h-full" 
                    x-show="imageUrl"
                >
                <div x-show="!imageUrl" class="text-slate-400">
                    <i class="fas fa-image fa-3x"></i>
                    <p class="mt-2 text-sm">Pilih gambar...</p>
                </div>
            </div>

            <input 
                type="file" 
                name="image_path" 
                id="image_path" 
                class="sr-only"
                @change="imageUrl = URL.createObjectURL($event.target.files[0])"
            >
            <label for="image_path" class="cursor-pointer mt-4 inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all w-full">
                <i class="fas fa-upload"></i>
                {{ $banner?->image_path ? 'Ganti Gambar' : 'Pilih Gambar' }}
            </label>
            <p class="mt-2 text-xs text-slate-500">Rekomendasi ukuran: 1920x1080px. Maks: 2MB.</p>
        </div>
    </div>
</div>
{{-- END: Layout Form Dua Kolom --}}

{{-- Footer Aksi Form --}}
<div class="mt-8 pt-6 border-t border-slate-200 flex justify-end gap-4">
    <a href="{{ route('admin.banners.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-md shadow-sm hover:bg-slate-50">
        Batal
    </a>
    <button type="submit" class="px-6 py-2 text-sm font-semibold text-white bg-sky-600 rounded-md shadow-sm hover:bg-sky-700">
        Simpan Perubahan
    </button>
</div>