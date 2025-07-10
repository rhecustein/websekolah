<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-slate-800">
            {{ __('Edit Pengguna: ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Alamat Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm" required>
                            @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label for="password" class="block text-sm font-medium text-slate-700">Password Baru</label>
                                <input type="password" name="password" id="password" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                                <p class="mt-1 text-xs text-slate-500">Kosongkan jika tidak ingin mengubah password.</p>
                                @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="pt-6 border-t">
                            <label class="block text-sm font-medium text-slate-700">Role Pengguna</label>
                            <div class="mt-2 space-y-2">
                                @foreach ($roles as $role)
                                    <div class="flex items-center">
                                        <input id="role-{{ $role->id }}" name="roles[]" type="checkbox" value="{{ $role->id }}" class="w-4 h-4 rounded text-sky-600 border-slate-300 focus:ring-sky-500"
                                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                        <label for="role-{{ $role->id }}" class="ml-3 text-sm text-slate-600">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                             @error('roles') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-6 py-4 space-x-3 bg-slate-50">
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Batal</a>
                        <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
