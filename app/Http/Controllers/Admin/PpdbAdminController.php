<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\PendaftarPpdb;
use App\Models\PembayaranPpdb;
use Illuminate\Support\Str;
class PpdbAdminController extends Controller
{
    /**
     * Menampilkan daftar pendaftar PPDB.
     */
    public function index(Request $request)
    {
        $query = PendaftarPpdb::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_pendaftaran', 'like', '%' . $request->search . '%')
                  ->orWhere('email_siswa', 'like', '%' . $request->search . '%');
        }
        if ($request->has('status_pendaftaran') && $request->status_pendaftaran != '') {
            $query->where('status_pendaftaran', $request->status_pendaftaran);
        }
        if ($request->has('jurusan_diminati') && $request->jurusan_diminati != '') {
            $query->where('jurusan_diminati', $request->jurusan_diminati);
        }

        $pendaftar = $query->latest()->paginate(10);
        return View::make('admin.ppdb.index', compact('pendaftar'));
    }

    /**
     * Menampilkan formulir untuk membuat pendaftar baru (jarang dilakukan, biasanya dari frontend).
     */
    public function create()
    {
        return View::make('admin.ppdb.create');
    }

    /**
     * Menyimpan pendaftar baru ke database (jika dibuat dari admin).
     */
    public function store(Request $request)
    {
        // Validasi dan logika penyimpanan pendaftar dari admin
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            // ... validasi dokumen dan lainnya
        ]);

        $data = $request->except(['_token']);
        $data['nomor_pendaftaran'] = 'PPDB-' . date('YmdHis') . Str::random(4); // Generate nomor unik

        // Logika upload dokumen jika ada
        if ($request->hasFile('dokumen_kk')) {
            $data['dokumen_kk'] = $request->file('dokumen_kk')->store('public/ppdb/dokumen');
        }
        // ... untuk dokumen lainnya

        PendaftarPpdb::create($data);

        return Redirect::route('admin.ppdb-admin.index')->with('success', 'Pendaftar PPDB berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pendaftar PPDB tertentu.
     */
    public function show(PendaftarPpdb $ppdbAdmin) // Variabel otomatis diubah Laravel
    {
        // Muat juga data pembayaran terkait
        $pembayaran = $ppdbAdmin->pembayaranPpdb; // Asumsi relasi hasOne
        return View::make('admin.ppdb.show', compact('ppdbAdmin', 'pembayaran'));
    }

    /**
     * Menampilkan formulir untuk mengedit pendaftar PPDB tertentu.
     */
    public function edit(PendaftarPpdb $ppdbAdmin)
    {
        return View::make('admin.ppdb.edit', compact('ppdbAdmin'));
    }

    /**
     * Memperbarui data pendaftar PPDB di database.
     */
    public function update(Request $request, PendaftarPpdb $ppdbAdmin)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'status_pendaftaran' => 'required|in:pending,diverifikasi,seleksi,lulus,tidak_lulus,daftar_ulang',
            'catatan_admin' => 'nullable|string',
            // ... validasi lain yang bisa diubah admin
        ]);

        $data = $request->except(['_token', '_method']);

        // Logika update dokumen jika ada
        if ($request->hasFile('dokumen_kk')) {
            if ($ppdbAdmin->dokumen_kk) {
                Storage::delete($ppdbAdmin->dokumen_kk);
            }
            $data['dokumen_kk'] = $request->file('dokumen_kk')->store('public/ppdb/dokumen');
        }
        // ... untuk dokumen lainnya

        $ppdbAdmin->update($data);

        return Redirect::route('admin.ppdb-admin.index')->with('success', 'Data pendaftar PPDB berhasil diperbarui.');
    }

    /**
     * Menghapus pendaftar PPDB dari database.
     */
    public function destroy(PendaftarPpdb $ppdbAdmin)
    {
        // Hapus juga dokumen terkait jika ada
        if ($ppdbAdmin->dokumen_kk) { Storage::delete($ppdbAdmin->dokumen_kk); }
        if ($ppdbAdmin->dokumen_akta_lahir) { Storage::delete($ppdbAdmin->dokumen_akta_lahir); }
        if ($ppdbAdmin->dokumen_ijazah_skl) { Storage::delete($ppdbAdmin->dokumen_ijazah_skl); }
        if ($ppdbAdmin->dokumen_foto_siswa) { Storage::delete($ppdbAdmin->dokumen_foto_siswa); }

        $ppdbAdmin->delete();
        return Redirect::route('admin.ppdb-admin.index')->with('success', 'Pendaftar PPDB berhasil dihapus.');
    }
}