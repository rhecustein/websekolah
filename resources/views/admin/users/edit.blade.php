<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold leading-tight text-slate-800">
                {{ __('Edit Pengguna: ') }}<span class="text-sky-600">{{ $user->name }}</span>
            </h2>
            {{-- Anda bisa menambahkan breadcrumb di sini jika diperlukan --}}
            {{-- Contoh Breadcrumb:
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-sky-600">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route('admin.users.index') }}" class="ms-1 text-sm font-medium text-slate-700 hover:text-sky-600 md:ms-2">Manajemen Pengguna</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ms-1 text-sm font-medium text-slate-500 md:ms-2">Edit</span>
                        </div>
                    </li>
                </ol>
            </nav>
            --}}
        </div>
    </x-slot>

    <div class="py-8 md:py-12">
        <div class="mx-auto max-w-8xl sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg border border-slate-200"> {{-- Menggunakan kelas shadow-lg, rounded-xl, dan border --}}
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 md:p-8 space-y-6"> {{-- Padding disesuaikan, space-y-6 tetap --}}

                        {{-- Kartu Informasi Dasar --}}
                        <div class="p-6 bg-white rounded-xl shadow-lg border">
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Informasi Dasar</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Masukkan nama lengkap pengguna" required>
                                    @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Masukkan alamat email pengguna" required>
                                    @error('email') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Kartu Ubah Kata Sandi (Opsional) --}}
                        <div class="p-6 bg-white rounded-xl shadow-lg border">
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Ubah Kata Sandi (Opsional)</h3>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label for="password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                                    <input type="password" name="password" id="password" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Kosongkan jika tidak ingin mengubah password.">
                                    <p class="mt-1 text-xs text-slate-500">Kosongkan jika tidak ingin mengubah password.</p>
                                    @error('password') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full mt-1 border-slate-300 rounded-lg shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" placeholder="Konfirmasi password baru">
                                </div>
                            </div>
                        </div>

                        {{-- Kartu Role Pengguna --}}
                        <div class="p-6 bg-white rounded-xl shadow-lg border">
                            <h3 class="text-lg font-bold text-slate-800 border-b border-slate-200 pb-3 mb-4">Role Pengguna <span class="text-red-500">*</span></h3>
                            <div class="mt-2 space-y-2">
                                @forelse ($roles as $role)
                                    <div class="flex items-center">
                                        {{-- Cek apakah role ini sudah dimiliki user atau termasuk dalam old('roles') --}}
                                        <input id="role-{{ $role->id }}" name="roles[]" type="checkbox" value="{{ $role->id }}" class="w-4 h-4 rounded text-sky-600 border-slate-300 focus:ring-sky-500"
                                        {{ (in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()))) ? 'checked' : '' }}>
                                        <label for="role-{{ $role->id }}" class="ml-3 text-sm text-slate-700">{{ $role->name }}</label>
                                    </div>
                                @empty
                                    <p class="text-sm text-slate-500">Tidak ada role yang tersedia. Harap tambahkan role terlebih dahulu.</p>
                                @endforelse
                            </div>
                            @error('roles') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                    </div> {{-- Akhir dari p-6 md:p-8 space-y-6 --}}

                    {{-- Footer Form Aksi --}}
                    <div class="flex items-center justify-end px-6 md:px-8 py-4 space-x-4 bg-slate-50 border-t border-slate-200 rounded-b-xl shadow-lg"> {{-- Padding disesuaikan, space-x-4 --}}
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
                        <button type="submit" class="inline-flex justify-center px-6 py-2 text-sm font-semibold text-white border border-transparent rounded-lg shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>