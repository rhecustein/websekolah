<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-slate-800">
                {{ __('Detail Pembayaran') }}
            </h2>
            <a href="{{ route('admin.pembayaran-ppdb.edit', $pembayaranPpdb->id) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700">
                <i class="mr-2 fas fa-pencil-alt"></i> Edit Pembayaran
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-slate-500">Pendaftar</dt>
                            <dd class="mt-1 text-lg font-semibold text-slate-900">{{ $pembayaranPpdb->pendaftarPpdb->nama_lengkap }}</dd>
                            <dd class="text-sm text-slate-600">{{ $pembayaranPpdb->pendaftarPpdb->nomor_pendaftaran }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Jenis Pembayaran</dt>
                            <dd class="mt-1 text-sm text-slate-900">{{ $pembayaranPpdb->jenis_pembayaran }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Jumlah Bayar</dt>
                            <dd class="mt-1 text-sm font-bold text-slate-900">Rp {{ number_format($pembayaranPpdb->jumlah_bayar, 0, ',', '.') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Metode Pembayaran</dt>
                            <dd class="mt-1 text-sm text-slate-900">{{ $pembayaranPpdb->metode_pembayaran ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Status</dt>
                            <dd class="mt-1">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full capitalize {{ $pembayaranPpdb->status_pembayaran == 'terverifikasi' ? 'bg-green-100 text-green-800' : ($pembayaranPpdb->status_pembayaran == 'ditolak' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $pembayaranPpdb->status_pembayaran }}
                                </span>
                            </dd>
                        </div>
                        @if($pembayaranPpdb->status_pembayaran == 'terverifikasi')
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Diverifikasi oleh</dt>
                            <dd class="mt-1 text-sm text-slate-900">{{ $pembayaranPpdb->verifikator->name ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500">Tanggal Verifikasi</dt>
                            <dd class="mt-1 text-sm text-slate-900">{{ $pembayaranPpdb->tanggal_verifikasi ? \Carbon\Carbon::parse($pembayaranPpdb->tanggal_verifikasi)->format('d M Y, H:i') : '-' }}</dd>
                        </div>
                        @endif
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-slate-500">Bukti Pembayaran</dt>
                            <dd class="mt-2">
                                @if($pembayaranPpdb->bukti_pembayaran)
                                    <a href="{{ Storage::url($pembayaranPpdb->bukti_pembayaran) }}" target="_blank">
                                        <img src="{{ Storage::url($pembayaranPpdb->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="object-contain w-full border rounded-md max-h-96">
                                    </a>
                                @else
                                    <p class="text-sm text-slate-500 italic">Tidak ada bukti pembayaran yang diunggah.</p>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
