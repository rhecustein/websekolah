@extends('layouts.public')

@section('title', 'Hasil Cek Status Pendaftaran') {{-- Judul halaman --}}

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Hasil Cek Status Pendaftaran PPDB</h1>

    <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 border-b pb-2">Data Pendaftar</h2>

        @if($pendaftar)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                <div>
                    <p class="font-semibold">Nomor Pendaftaran:</p>
                    <p class="text-lg font-mono text-blue-600">{{ $pendaftar->nomor_pendaftaran }}</p>
                </div>
                <div>
                    <p class="font-semibold">Nama Lengkap:</p>
                    <p>{{ $pendaftar->nama_lengkap }}</p>
                </div>
                <div>
                    <p class="font-semibold">Jenis Kelamin:</p>
                    <p>{{ $pendaftar->jenis_kelamin }}</p>
                </div>
                <div>
                    <p class="font-semibold">Tempat, Tanggal Lahir:</p>
                    <p>{{ $pendaftar->tempat_lahir }}, {{ \Carbon\Carbon::parse($pendaftar->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <p class="font-semibold">Asal Sekolah:</p>
                    <p>{{ $pendaftar->asal_sekolah_sebelumnya }}</p>
                </div>
                <div>
                    <p class="font-semibold">Jurusan Diminati:</p>
                    <p>{{ $pendaftar->jurusan_diminati ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold">Status Pendaftaran:</p>
                    {{-- Sesuaikan label status dengan logika bisnis Anda --}}
                    @php
                        $statusColor = 'bg-gray-200 text-gray-800';
                        if ($pendaftar->status == 'pending') $statusColor = 'bg-yellow-200 text-yellow-800';
                        else if ($pendaftar->status == 'diterima') $statusColor = 'bg-green-200 text-green-800';
                        else if ($pendaftar->status == 'ditolak') $statusColor = 'bg-red-200 text-red-800';
                        else if ($pendaftar->status == 'verifikasi') $statusColor = 'bg-blue-200 text-blue-800';
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                        {{ ucfirst($pendaftar->status ?? 'Belum Ditentukan') }}
                    </span>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4 border-b pb-2">Informasi Kontak & Orang Tua</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                <div>
                    <p class="font-semibold">Telepon Siswa:</p>
                    <p>{{ $pendaftar->telepon_siswa ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold">Email Siswa:</p>
                    <p>{{ $pendaftar->email_siswa ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold">Nama Ayah:</p>
                    <p>{{ $pendaftar->nama_ayah }}</p>
                </div>
                <div>
                    <p class="font-semibold">Telepon Ayah:</p>
                    <p>{{ $pendaftar->telepon_ayah }}</p>
                </div>
                <div>
                    <p class="font-semibold">Nama Ibu:</p>
                    <p>{{ $pendaftar->nama_ibu }}</p>
                </div>
                <div>
                    <p class="font-semibold">Telepon Ibu:</p>
                    <p>{{ $pendaftar->telepon_ibu }}</p>
                </div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mt-8 mb-4 border-b pb-2">Dokumen Terunggah</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                <div>
                    <p class="font-semibold">Kartu Keluarga (KK):</p>
                    <p><a href="{{ Storage::url($pendaftar->dokumen_kk) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>
                </div>
                <div>
                    <p class="font-semibold">Akta Kelahiran:</p>
                    <p><a href="{{ Storage::url($pendaftar->dokumen_akta_lahir) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>
                </div>
                <div>
                    <p class="font-semibold">Ijazah / SKL Terakhir:</p>
                    <p><a href="{{ Storage::url($pendaftar->dokumen_ijazah_skl) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Dokumen</a></p>
                </div>
                <div>
                    <p class="font-semibold">Foto Siswa:</p>
                    <p><a href="{{ Storage::url($pendaftar->dokumen_foto_siswa) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Foto</a></p>
                </div>
            </div>

        @else
            <p class="text-center text-gray-600 text-lg">Data pendaftar tidak ditemukan.</p>
        @endif
    </div>

    {{-- Informasi Pembayaran (jika ada) --}}
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-blue-700 mb-6 border-b pb-2">Status Pembayaran</h2>

        @if($pembayaran && $pembayaran->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Kode Pembayaran</th>
                            <th class="py-3 px-6 text-left">Jumlah</th>
                            <th class="py-3 px-6 text-left">Status</th>
                            <th class="py-3 px-6 text-left">Tanggal Bayar</th>
                            <th class="py-3 px-6 text-left">Bukti Bayar</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @foreach($pembayaran as $bayar)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $bayar->kode_pembayaran }}</td>
                            <td class="py-3 px-6 text-left">Rp{{ number_format($bayar->jumlah_bayar, 0, ',', '.') }}</td>
                            <td class="py-3 px-6 text-left">
                                @php
                                    $paymentStatusColor = 'bg-gray-200 text-gray-800';
                                    if ($bayar->status_pembayaran == 'pending') $paymentStatusColor = 'bg-yellow-200 text-yellow-800';
                                    else if ($bayar->status_pembayaran == 'terverifikasi') $paymentStatusColor = 'bg-green-200 text-green-800';
                                    else if ($bayar->status_pembayaran == 'ditolak') $paymentStatusColor = 'bg-red-200 text-red-800';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $paymentStatusColor }}">
                                    {{ ucfirst($bayar->status_pembayaran) }}
                                </span>
                            </td>
                            <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($bayar->tanggal_bayar)->translatedFormat('d F Y H:i') }}</td>
                            <td class="py-3 px-6 text-left">
                                @if($bayar->bukti_transfer_path)
                                    <a href="{{ Storage::url($bayar->bukti_transfer_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat Bukti</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-600 text-lg">Belum ada data pembayaran untuk pendaftaran ini.</p>
        @endif
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('ppdb.cek-status') }}" class="inline-flex items-center bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300 font-semibold">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z"></path></svg>
            Cek Nomor Lain
        </a>
        <a href="{{ route('ppdb.index') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold ml-4">
            Kembali ke Halaman PPDB
        </a>
    </div>

</div>
@endsection