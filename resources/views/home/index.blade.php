@extends('layouts.public')

{{-- Optional: Override default title for this specific page --}}
@section('title', 'Beranda - Portal Resmi [Nama Sekolah Anda]')

{{-- Optional: Override default description for this specific page --}}
@section('description', 'Selamat datang di portal resmi [Nama Sekolah Anda]. Temukan informasi PPDB, berita terbaru, program unggulan, dan galeri sekolah kami.')

{{-- Optional: Add page-specific styles if any. These will be appended to the <head> section of layouts.app --}}
@section('styles')
    {{-- Example: <link rel="stylesheet" href="{{ asset('css/home-specific.css') }}"> --}}
@endsection

{{-- Main Content Section --}}
@section('content')
    <section class="hero-banner relative h-[500px] md:h-[650px] flex items-end justify-center text-center px-4 py-8 overflow-hidden">
        <div class="gradient-overlay absolute inset-0"></div>
        <div class="relative z-10 text-white max-w-5xl">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold leading-tight drop-shadow-2xl animate-fade-in-up">
                Selamat Datang di <span class="text-blue-300">Sekolah [Nama Sekolah Anda]</span> 👋
            </h1>
            <p class="mt-4 text-lg md:text-xl lg:text-2xl drop-shadow-lg animate-fade-in-up animation-delay-300">
                Mencetak Generasi Unggul, Berkarakter, dan Berprestasi di Era Digital untuk Masa Depan Bangsa.
            </p>
            <div class="mt-10 space-y-4 sm:space-y-0 sm:space-x-6 flex flex-col sm:flex-row justify-center animate-fade-in-up animation-delay-600">
                <a href="{{ route('ppdb.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-full text-lg md:text-xl shadow-xl transform hover:scale-105 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Daftar Sekarang! ✨
                </a>
                <a href="{{ route('tentangkami.profil') }}" class="border-2 border-white hover:bg-white hover:text-blue-600 text-white font-semibold px-8 py-4 rounded-full text-lg md:text-xl shadow-xl transform hover:scale-105 transition duration-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-75">
                    Pelajari Lebih Lanjut →
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-10">
            <div class="md:w-1/2 order-2 md:order-1 text-center md:text-left">
                <h2 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-6 leading-tight animate-fade-in-up">Sambutan Hangat dari Kepala Sekolah Kami</h2>
                <p class="text-gray-700 leading-relaxed mb-6 text-lg animate-fade-in-up animation-delay-100">
                    Assalamu'alaikum Warahmatullahi Wabarakatuh.
                </p>
                <p class="text-gray-700 leading-relaxed mb-6 text-lg animate-fade-in-up animation-delay-200">
                    Dengan bangga kami menyambut Anda di portal resmi **[Nama Sekolah Anda]**. Kami berkomitmen untuk menyediakan pendidikan terbaik yang tidak hanya fokus pada kecerdasan akademis, tetapi juga pengembangan karakter, keterampilan, dan spiritualitas siswa.
                </p>
                <p class="text-gray-700 leading-relaxed mb-8 text-lg animate-fade-in-up animation-delay-300">
                    Di sini, kami berupaya menciptakan lingkungan belajar yang inspiratif, inklusif, dan inovatif, di mana setiap siswa dapat tumbuh dan berkembang menjadi individu yang mandiri, kreatif, dan berakhlak mulia. Kami percaya bahwa setiap anak memiliki potensi luar biasa, dan tugas kami adalah membantu mereka meraihnya.
                </p>
                <a href="{{ route('tentangkami.sambutan') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg hover:bg-blue-700 transform hover:scale-105 transition duration-300 animate-fade-in-up animation-delay-400">
                    Baca Sambutan Lengkap →
                </a>
            </div>
            <div class="md:w-1/2 order-1 md:order-2 flex justify-center animate-fade-in-right animation-delay-200">
                <img src="{{ asset('storage/sekolah/kepala-sekolah.jpg') }}" alt="Foto Kepala Sekolah" class="rounded-xl shadow-2xl max-w-full h-auto object-cover border-4 border-blue-200 transform hover:scale-105 transition duration-300" style="max-height: 450px; aspect-ratio: 3/4;">
            </div>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-gray-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-12 animate-fade-in-up">Jenjang Pendidikan & Program Unggulan Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-xl card-hover-effect p-8 flex flex-col items-center animate-fade-in-up animation-delay-100">
                    <div class="p-4 bg-blue-100 rounded-full mb-6">
                        <img src="{{ asset('storage/sekolah/icon-sd.png') }}" alt="SD Icon" class="h-16 w-16 object-contain">
                    </div>
                    <h3 class="text-2xl font-bold text-blue-700 mb-3">Sekolah Dasar (SD)</h3>
                    <p class="text-gray-600 text-base leading-relaxed mb-5">Pendidikan dasar yang membangun fondasi karakter dan pengetahuan anak dengan kurikulum inovatif.</p>
                    <a href="{{ route('akademik.kurikulum') }}#sd" class="inline-block mt-auto text-blue-600 hover:text-blue-800 font-semibold border-b-2 border-blue-600 hover:border-blue-800 pb-1 transition duration-300">Lihat Detail →</a>
                </div>
                <div class="bg-white rounded-xl card-hover-effect p-8 flex flex-col items-center animate-fade-in-up animation-delay-200">
                    <div class="p-4 bg-green-100 rounded-full mb-6">
                        <img src="{{ asset('storage/sekolah/icon-smp.png') }}" alt="SMP Icon" class="h-16 w-16 object-contain">
                    </div>
                    <h3 class="text-2xl font-bold text-green-700 mb-3">Sekolah Menengah Pertama (SMP)</h3>
                    <p class="text-gray-600 text-base leading-relaxed mb-5">Pengembangan potensi akademis dan sosial di masa remaja melalui pendekatan pembelajaran yang dinamis.</p>
                    <a href="{{ route('akademik.kurikulum') }}#smp" class="inline-block mt-auto text-green-600 hover:text-green-800 font-semibold border-b-2 border-green-600 hover:border-green-800 pb-1 transition duration-300">Lihat Detail →</a>
                </div>
                <div class="bg-white rounded-xl card-hover-effect p-8 flex flex-col items-center animate-fade-in-up animation-delay-300">
                    <div class="p-4 bg-yellow-100 rounded-full mb-6">
                        <img src="{{ asset('storage/sekolah/icon-sma.png') }}" alt="SMA Icon" class="h-16 w-16 object-contain">
                    </div>
                    <h3 class="text-2xl font-bold text-yellow-700 mb-3">Sekolah Menengah Atas (SMA)</h3>
                    <p class="text-gray-600 text-base leading-relaxed mb-5">Persiapan matang menuju jenjang perguruan tinggi dengan berbagai pilihan jurusan dan bimbingan karir.</p>
                    <a href="{{ route('akademik.kurikulum') }}#sma" class="inline-block mt-auto text-yellow-600 hover:text-yellow-800 font-semibold border-b-2 border-yellow-600 hover:border-yellow-800 pb-1 transition duration-300">Lihat Detail →</a>
                </div>
                <div class="bg-white rounded-xl card-hover-effect p-8 flex flex-col items-center animate-fade-in-up animation-delay-400">
                    <div class="p-4 bg-purple-100 rounded-full mb-6">
                        <img src="{{ asset('storage/sekolah/icon-smk-ponpes.png') }}" alt="SMK/Ponpes Icon" class="h-16 w-16 object-contain">
                    </div>
                    <h3 class="text-2xl font-bold text-purple-700 mb-3">SMK / Pondok Pesantren</h3>
                    <p class="text-gray-600 text-base leading-relaxed mb-5">Pendidikan vokasi siap kerja dengan keahlian relevan atau pendalaman ilmu agama dan tahfidz Al-Qur'an.</p>
                    <a href="{{ route('akademik.program-unggulan') }}" class="inline-block mt-auto text-purple-600 hover:text-purple-800 font-semibold border-b-2 border-purple-600 hover:border-purple-800 pb-1 transition duration-300">Lihat Detail →</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-extrabold text-blue-800 mb-12 text-center animate-fade-in-up">Berita & Pengumuman Terbaru</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($beritaTerbaru as $berita)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 hover:border-blue-300 card-hover-effect animate-fade-in-up animation-delay-100">
                    <img src="{{ $berita->thumbnail_url ?? asset('images/default-news.jpg') }}" alt="{{ $berita->judul }}" class="w-full h-56 object-cover object-center">
                    <div class="p-6">
                        <span class="text-sm text-gray-500 font-medium block mb-2">{{ $berita->published_at->format('d F Y') }} | {{ $berita->kategoriBerita->nama ?? 'Umum' }}</span>
                        <h3 class="text-2xl font-bold text-gray-800 mt-2 mb-3 leading-snug hover:text-blue-700 transition duration-300 line-clamp-2">{{ $berita->judul }}</h3>
                        <p class="text-gray-600 text-base leading-relaxed mb-5 line-clamp-3">{{ Str::limit(strip_tags($berita->konten), 120) }}</p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold group">
                            Baca Selengkapnya
                            <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                @empty
                <p class="col-span-full text-center text-gray-600 text-lg">Belum ada berita terbaru saat ini. Kunjungi halaman berita untuk informasi lebih lanjut.</p>
                @endforelse
            </div>
            <div class="text-center mt-12 space-y-4 md:space-y-0 md:space-x-4">
                <a href="{{ route('berita.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Lihat Semua Berita 📰
                </a>
                <a href="{{ route('pengumuman.index') }}" class="inline-block border-2 border-blue-600 hover:bg-blue-600 hover:text-white text-blue-600 font-semibold px-8 py-3 rounded-full shadow-lg transform hover:scale-105 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                    Lihat Semua Pengumuman 📢
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-blue-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold mb-12 animate-fade-in-up">Apa Kata Mereka Tentang Kami?</h2>
            <div class="swiper mySwiper max-w-5xl mx-auto rounded-xl shadow-2xl overflow-hidden">
                <div class="swiper-wrapper">
                    <div class="swiper-slide p-8 bg-blue-800 flex flex-col items-center justify-center min-h-[300px] md:min-h-[350px]">
                        <img src="{{ asset('images/placeholder-avatar.png') }}" alt="Avatar Siswa" class="w-28 h-28 rounded-full border-4 border-blue-300 mb-6 object-cover shadow-md">
                        <p class="text-xl md:text-2xl italic leading-relaxed mb-6">"Sekolah ini bukan hanya tempat belajar, tapi juga rumah kedua. Guru-gurunya sangat suportif dan program-programnya sangat membantu saya mengembangkan potensi diri sepenuhnya."</p>
                        <p class="font-bold text-blue-200 text-lg">- Budi Santoso, Alumni SMA Angkatan 2023</p>
                    </div>
                    <div class="swiper-slide p-8 bg-blue-800 flex flex-col items-center justify-center min-h-[300px] md:min-h-[350px]">
                        <img src="{{ asset('images/placeholder-avatar.png') }}" alt="Avatar Orang Tua" class="w-28 h-28 rounded-full border-4 border-blue-300 mb-6 object-cover shadow-md">
                        <p class="text-xl md:text-2xl italic leading-relaxed mb-6">"Kami sangat puas dengan pendidikan di [Nama Sekolah Anda]. Anak kami menunjukkan perkembangan signifikan dalam akademis dan karakternya, terima kasih atas dedikasi para pengajar."</p>
                        <p class="font-bold text-blue-200 text-lg">- Ibu Siti, Orang Tua Siswa SMP</p>
                    </div>
                    <div class="swiper-slide p-8 bg-blue-800 flex flex-col items-center justify-center min-h-[300px] md:min-h-[350px]">
                        <img src="{{ asset('images/placeholder-avatar.png') }}" alt="Avatar Santri" class="w-28 h-28 rounded-full border-4 border-blue-300 mb-6 object-cover shadow-md">
                        <p class="text-xl md:text-2xl italic leading-relaxed mb-6">"Lingkungan pondok pesantrennya sangat kondusif untuk menghafal Al-Qur'an dan memperdalam ilmu agama. Alhamdulillah banyak kemajuan yang saya rasakan di sini."</p>
                        <p class="font-bold text-blue-200 text-lg">- Ahmad Fauzi, Santri Pondok Pesantren</p>
                    </div>
                </div>
                <div class="swiper-pagination mt-8"></div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-20 bg-gradient-to-r from-blue-600 to-blue-800 text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 animate-fade-in-up animation-delay-100">
                Pendaftaran Peserta Didik Baru Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }} Telah Dibuka!
            </h2>
            <p class="text-xl md:text-2xl mb-10 leading-relaxed animate-fade-in-up animation-delay-200">
                Bergabunglah bersama kami dan wujudkan masa depan cerah anak Anda! Jangan lewatkan kesempatan ini.
            </p>
            <a href="{{ route('ppdb.index') }}" class="inline-block bg-white text-blue-700 hover:bg-gray-100 font-bold px-12 py-5 rounded-full text-xl md:text-2xl shadow-2xl transform hover:scale-105 transition duration-300 animate-pulse-once focus:outline-none focus:ring-4 focus:ring-white focus:ring-opacity-50">
                Daftar Sekarang! 🎉
            </a>
        </div>
    </section>
@endsection

{{-- Optional: Page-specific scripts can be put here. These will be appended before </body> of layouts.app --}}
@section('scripts')
    {{-- Example: <script src="{{ asset('js/home-swiper-init.js') }}"></script> --}}
    <script>
        // Any specific script for home page that needs to run after global scripts
        // (Swiper initialization is already in layouts.app, so no need to repeat unless custom per page)
    </script>
@endsection