<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Menggunakan model User bawaan Laravel
use Spatie\Permission\Models\Role; // Untuk manajemen role

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna (admin, editor, dll.).
     */
   public function index(Request $request)
    {
        $query = User::query();

        // Filter Pencarian
        if ($search = $request->input('search')) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        // Filter Berdasarkan Role
        if ($role = $request->input('role')) {
            $query->role($role); // Menggunakan helper dari Spatie Permission
        }

        $users = $query->latest()->paginate(10); // Sesuaikan jumlah item per halaman

        // Jika Anda perlu mengirimkan daftar role yang tersedia ke view
        // $availableRoles = Role::pluck('name')->all(); 
        // return view('admin.users.index', compact('users', 'availableRoles'));

        return view('admin.users.index', compact('users'));
    }
    /**
     * Menampilkan formulir untuk membuat pengguna baru.
     */
    public function create()
    {
        $roles = Role::all(); // Ambil semua role yang tersedia
        return View::make('admin.users.create', compact('roles'));
    }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array', // Pastikan roles dipilih
            'roles.*' => 'exists:roles,id', // Pastikan ID role valid
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role ke user
        $roles = Role::whereIn('id', $request->roles)->get();
        $user->syncRoles($roles);

        return Redirect::route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengguna tertentu.
     */
    public function show(User $user)
    {
        return View::make('admin.users.show', compact('user'));
    }

    /**
     * Menampilkan formulir untuk mengedit pengguna tertentu.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return View::make('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Memperbarui data pengguna di database.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Update role user
        $roles = Role::whereIn('id', $request->roles)->get();
        $user->syncRoles($roles);

        return Redirect::route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Redirect::route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}