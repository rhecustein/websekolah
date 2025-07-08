@extends('layouts.public') 

@section('title', 'PPDB - Penerimaan Peserta Didik Baru') {{-- Page title --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Penerimaan Peserta Didik Baru (PPDB)</h1>

    <p class="text-xl text-gray-700 mb-12 text-center max-w-3xl mx-auto">
        Selamat datang di halaman PPDB sekolah kami! Temukan semua informasi yang Anda butuhkan untuk mendaftarkan putra-putri Anda.
    </p>

    {{-- Call to Action Buttons --}}
    <div class="flex justify-center gap-6 mb-12 flex-wrap">
        <a href="{{ route('ppdb.daftar') }}" class="bg-blue-600 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-lg">
            Daftar Sekarang!
        </a>
        <a href="{{ route('ppdb.cek-status') }}" class="bg-green-600 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-green-700 transition duration-300 transform hover:scale-105 shadow-lg">
            Cek Status Pendaftaran
        </a>
        <a href="{{ route('ppdb.hasil') }}" class="bg-purple-600 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-purple-700 transition duration-300 transform hover:scale-105 shadow-lg">
            Pengumuman Hasil
        </a>
    </div>

    <hr class="my-12 border-gray-300">

    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Informasi PPDB</h2>

    @if($informasiPpdb->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($informasiPpdb as $info)
                <div class="bg-white rounded-lg shadow-md p-6 transform transition duration-300 hover:shadow-lg hover:translate-y-[-2px]">
                    <h3 class="text-2xl font-bold text-blue-700 mb-3">{{ $info->judul }}</h3>
                    <p class="text-gray-700 text-base mb-4">
                        {{ \Illuminate\Mail\Markdown::parse($info->konten)->toHtml() }}
                    </p>
                    <p class="text-gray-500 text-sm">
                        <i class="far fa-calendar-alt mr-1"></i> Terakhir diperbarui: {{ \Carbon\Carbon::parse($info->updated_at)->translatedFormat('d F Y') }}
                    </p>
                    {{-- Anda bisa menambahkan tombol "Baca Selengkapnya" jika konten terlalu panjang dan ingin dibuat halaman detail --}}
                    {{-- <a href="#" class="inline-block mt-4 text-blue-600 hover:underline">Baca Selengkapnya &rarr;</a> --}}
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500 mt-10 text-xl">Informasi PPDB belum tersedia saat ini. Mohon cek kembali nanti.</p>
    @endif

    {{-- Optional: Section for FAQs, Contact, etc. --}}
    <div class="mt-16 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Butuh Bantuan?</h2>
        <p class="text-lg text-gray-700 mb-4">
            Jika Anda memiliki pertanyaan lebih lanjut mengenai PPDB, jangan ragu untuk menghubungi kami.
        </p>
        <a href="/kontak" class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300 font-semibold">
            Hubungi Kami
        </a>
    </div>

</div>
@endsection