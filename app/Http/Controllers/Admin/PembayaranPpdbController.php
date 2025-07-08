<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PembayaranPpdb;
use App\Models\PendaftarPpdb;

class PembayaranPpdbController extends Controller
{
    /**
     * Menampilkan daftar pembayaran PPDB.
     */
    public function index(Request $request)
    {
        $query = PembayaranPpdb::with('pendaftarPpdb', 'verifikator');

        if ($request->has('search') && $request->search != '') {
            $query->whereHas('pendaftarPpdb', function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_pendaftaran', 'like', '%' . $request->search . '%');
            })->orWhere('jenis_pembayaran', 'like', '%' . $request->search . '%');
        }
        if ($request->has('status_pembayaran') && $request->status_pembayaran != '') {
            $query->where('status_pembayaran', $request->status_pembayaran);
        }

        $pembayaran = $query->latest()->paginate(10);
        return View::make('admin.ppdb.pembayaran.index', compact('pembayaran'));
    }

    /**
     * Menampilkan formulir untuk membuat pembayaran baru (jika admin input manual).
     */
    public function create(Request $request)
    {
        $pendaftar = PendaftarPpdb::all();
        $selectedPendaftar = null;
        if ($request->has('pendaftar_id')) {
            $selectedPendaftar = PendaftarPpdb::find($request->pendaftar_id);
        }
        return View::make('admin.ppdb.pembayaran.create', compact('pendaftar', 'selectedPendaftar'));
    }

    /**
     * Menyimpan pembayaran baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pendaftar_ppdb_id' => 'required|exists:pendaftar_ppdbs,id',
            'jenis_pembayaran' => 'required|string|max:255',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'nullable|string|max:255',
            'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'kode_unik_pembayaran' => 'nullable|string|unique:pembayaran_ppdbs,kode_unik_pembayaran',
            'status_pembayaran' => 'required|in:pending,terverifikasi,ditolak',
        ]);

        $data = $request->except(['_token', 'bukti_pembayaran']);

        if ($request->hasFile('bukti_pembayaran')) {
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('public/ppdb/bukti_pembayaran');
        }

        if ($request->status_pembayaran == 'terverifikasi') {
            $data['verifikator_id'] = Auth::id();
            $data['tanggal_verifikasi'] = now();
        }

        PembayaranPpdb::create($data);

        return Redirect::route('admin.pembayaran-ppdb.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pembayaran PPDB tertentu.
     */
    public function show(PembayaranPpdb $pembayaranPpdb)
    {
        return View::make('admin.ppdb.pembayaran.show', compact('pembayaranPpdb'));
    }

    /**
     * Menampilkan formulir untuk mengedit pembayaran PPDB tertentu.
     */
    public function edit(PembayaranPpdb $pembayaranPpdb)
    {
        $pendaftar = PendaftarPpdb::all();
        return View::make('admin.ppdb.pembayaran.edit', compact('pembayaranPpdb', 'pendaftar'));
    }

    /**
     * Memperbarui data pembayaran PPDB di database.
     */
    public function update(Request $request, PembayaranPpdb $pembayaranPpdb)
    {
        $request->validate([
            'pendaftar_ppdb_id' => 'required|exists:pendaftar_ppdbs,id',
            'jenis_pembayaran' => 'required|string|max:255',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'nullable|string|max:255',
            'bukti_pembayaran' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'kode_unik_pembayaran' => 'nullable|string|unique:pembayaran_ppdbs,kode_unik_pembayaran,' . $pembayaranPpdb->id,
            'status_pembayaran' => 'required|in:pending,terverifikasi,ditolak',
        ]);

        $data = $request->except(['_token', '_method', 'bukti_pembayaran']);

        if ($request->hasFile('bukti_pembayaran')) {
            if ($pembayaranPpdb->bukti_pembayaran) {
                Storage::delete($pembayaranPpdb->bukti_pembayaran);
            }
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('public/ppdb/bukti_pembayaran');
        }

        // Otomatis set verifikator dan tanggal verifikasi jika status menjadi terverifikasi
        if ($request->status_pembayaran == 'terverifikasi' && $pembayaranPpdb->status_pembayaran != 'terverifikasi') {
            $data['verifikator_id'] = Auth::id();
            $data['tanggal_verifikasi'] = now();
        } elseif ($request->status_pembayaran != 'terverifikasi' && $pembayaranPpdb->status_pembayaran == 'terverifikasi') {
            // Jika status berubah dari terverifikasi ke lain, reset verifikator
            $data['verifikator_id'] = null;
            $data['tanggal_verifikasi'] = null;
        }

        $pembayaranPpdb->update($data);

        return Redirect::route('admin.pembayaran-ppdb.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    /**
     * Menghapus pembayaran PPDB dari database.
     */
    public function destroy(PembayaranPpdb $pembayaranPpdb)
    {
        if ($pembayaranPpdb->bukti_pembayaran) {
            Storage::delete($pembayaranPpdb->bukti_pembayaran);
        }
        $pembayaranPpdb->delete();
        return Redirect::route('admin.pembayaran-ppdb.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}