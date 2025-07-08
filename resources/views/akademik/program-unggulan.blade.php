 
@extends('layouts.public') {{-- Menggunakan layout publik utama Anda --}}

{{-- Bagian untuk mengatur judul dan deskripsi halaman spesifik --}}
@section('title', 'Program Unggulan & Ekstrakurikuler - [Nama Sekolah Anda]')
@section('description', 'Jelajahi program unggulan dan beragam kegiatan ekstrakurikuler di [Nama Sekolah Anda] untuk mengembangkan minat dan bakat siswa.')

{{-- Bagian untuk CSS spesifik halaman ini jika ada --}}
@section('styles')
    {{-- Contoh: <link rel="stylesheet" href="{{ asset('css/program-unggulan.css') }}"> --}}
@endsection

{{-- Bagian konten utama halaman --}}
@section('content')
    <section class="relative py-16 bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 animate-fade-in-up">
                Program Unggulan & Ekstrakurikuler
            </h1>
            <p class="text-lg md:text-xl opacity-90 animate-fade-in-up animation-delay-100">
                Wadah Mengembangkan Minat, Bakat, dan Potensi
            </p>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            {{-- Bagian Program Unggulan (jika ada, bisa dari halaman statis atau custom) --}}
            <div class="max-w-4xl mx-auto text-center mb-16 animate-fade-in-up">
                <h2 class="text-3xl md:text-4xl font-extrabold text-purple-800 mb-8 border-b-2 border-purple-300 pb-3">
                    Program Unggulan Sekolah
                </h2>
                <p class="text-lg text-gray-700 leading-relaxed mb-6">
                    **[Nama Sekolah Anda]** memiliki beberapa program unggulan yang dirancang untuk memberikan nilai tambah dan keunggulan kompetitif bagi setiap siswa. Program-program ini fokus pada pengembangan aspek akademik, non-akademik, karakter, serta keterampilan yang relevan dengan masa depan.
                </p>
                <ul class="text-xl text-blue-700 font-semibold space-y-3">
                    <li class="flex items-center justify-center"><i class="fas fa-check-circle text-green-500 mr-3"></i>Program Bahasa Inggris Interaktif</li>
                    <li class="flex items-center justify-center"><i class="fas fa-check-circle text-green-500 mr-3"></i>Robotika & Coding Club</li>
                    <li class="flex items-center justify-center"><i class="fas fa-check-circle text-green-500 mr-3"></i>Kelas Tahfidz Al-Qur'an (khusus Ponpes/sekolah Islam)</li>
                    <li class="flex items-center justify-center"><i class="fas fa-check-circle text-green-500 mr-3"></i>Entrepreneurship & Leadership Training</li>
                    <li class="flex items-center justify-center"><i class="fas fa-check-circle text-green-500 mr-3"></i>Bimbingan Karir & Studi Lanjut</li>
                </ul>
                <p class="text-gray-700 leading-relaxed mt-6">
                    Setiap program dirancang dengan cermat untuk memaksimalkan potensi unik setiap siswa.
                </p>
            </div>

            {{-- Bagian Ekstrakurikuler --}}
            <div class="animate-fade-in-up animation-delay-300">
                <h2 class="text-3xl md:text-4xl font-extrabold text-indigo-800 mb-10 text-center border-b-2 border-indigo-300 pb-3">
                    Kegiatan Ekstrakurikuler
                </h2>

                @if($ekstrakurikulers->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($ekstrakurikulers as $ekskul)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-indigo-300 card-hover-effect animate-fade-in-up animation-delay-{{ $loop->iteration * 100 }}">
                                @if($ekskul->gambar_ikon)
                                    <div class="p-6 bg-indigo-50 flex justify-center items-center h-48">
                                        <img src="{{ Storage::url($ekskul->gambar_ikon) }}" alt="Ikon {{ $ekskul->nama }}" class="h-32 w-32 object-contain">
                                    </div>
                                @else
                                    <div class="p-6 bg-gray-100 flex justify-center items-center h-48">
                                        <i class="fas fa-running text-8xl text-gray-400"></i> {{-- Default icon --}}
                                    </div>
                                @endif
                                <div class="p-6">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3 leading-snug">{{ $ekskul->nama }}</h3>
                                    <p class="text-gray-600 text-base leading-relaxed mb-4 line-clamp-3">{{ Str::limit(strip_tags($ekskul->deskripsi), 120) }}</p>
                                    @if($ekskul->pembimbing)
                                        <p class="text-sm text-gray-500 mb-2"><i class="fas fa-user-tie mr-2"></i> Pembimbing: {{ $ekskul->pembimbing }}</p>
                                    @endif
                                    @if($ekskul->jadwal)
                                        <p class="text-sm text-gray-500"><i class="fas fa-calendar-alt mr-2"></i> Jadwal: {{ $ekskul->jadwal }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 bg-blue-50 text-blue-700 rounded-lg p-6">
                        <p class="text-xl font-semibold mb-4">Belum ada data ekstrakurikuler yang tersedia saat ini.</p>
                        <p class="text-lg">Kami sedang dalam proses mengunggah daftar kegiatan ekstrakurikuler terbaru kami. Nantikan informasi selanjutnya!</p>
                        <i class="fas fa-puzzle-piece text-blue-500 text-5xl mt-6"></i>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

{{-- Bagian untuk JavaScript spesifik halaman ini jika ada --}}
@section('scripts')
    {{-- Contoh: <script src="{{ asset('js/program-unggulan-script.js') }}"></script> --}}
@endsection