<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Dynamic Title based on section or default --}}
    <title>@yield('title', 'Selamat Datang di [Nama Sekolah Anda] - Unggul, Berkarakter, Berprestasi')</title>
    <meta name="description" content="@yield('description', 'Portal resmi [Nama Sekolah Anda]: SD, SMP, SMA, SMK, Pondok Pesantren. Informasi PPDB, berita, galeri, dan program unggulan.')">
    <link rel="icon" href="{{ asset('storage/sekolah/favicon.png') }}" type="image/png">

    {{-- Vite for compiling CSS and JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js (defer for faster page load) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Swiper CSS (for sliders) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- FontAwesome for Icons (Optional, for social media icons) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Custom Styles from previous welcome.blade.php (add to your main CSS file for better practice) --}}
    <style>
        /* This style block should ideally be moved to resources/css/app.css or a dedicated CSS file.
           For now, kept here for immediate functionality. */
        .hero-banner {
            background-image: url('{{ asset('storage/sekolah/hero-banner-default.jpg') }}'); /* Gambar default banner */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            animation: fadeIn 1s ease-out; /* Added fade-in animation */
        }
        .gradient-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);
        }

        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulseOnce { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fade-in-left {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fade-in-right {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .animate-fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
        .animation-delay-100 { animation-delay: 0.1s; }
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }
        .animation-delay-500 { animation-delay: 0.5s; }
        .animation-delay-600 { animation-delay: 0.6s; }
        .animate-pulse-once { animation: pulseOnce 1.5s ease-in-out; }
        .animate-fade-in-down { animation: fade-in-down 0.3s ease-out forwards; }
        .animate-fade-in-left { animation: fade-in-left 0.6s ease-out forwards; }
        .animate-fade-in-right { animation: fade-in-right 0.6s ease-out forwards; }


        .card-hover-effect { @apply transform hover:scale-102 transition duration-300 ease-in-out shadow-lg; }

        .swiper-pagination-bullet { background-color: rgba(255, 255, 255, 0.5) !important; opacity: 1 !important; }
        .swiper-pagination-bullet-active { background-color: #fff !important; box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.2); }

        /* Mega Menu Specific Styles */
        .mega-menu-content {
            display: none; /* Hidden by default */
            position: absolute;
            top: 100%; /* Position below the main menu item */
            left: 50%;
            transform: translateX(-50%); /* Center the mega menu */
            background-color: white;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            border-radius: 0.5rem;
            padding: 1.5rem;
            z-index: 100;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
            min-width: 500px; /* Adjust as needed */
        }
        .mega-menu-parent:hover .mega-menu-content,
        .mega-menu-parent.active .mega-menu-content { /* .active for Alpine.js click */
            display: block;
            opacity: 1;
            visibility: visible;
        }

        /* Responsive adjustments for mega menu */
        @media (max-width: 1023px) { /* lg breakpoint for hidden lg:flex */
            .mega-menu-content {
                position: relative; /* Change positioning for mobile */
                width: 100%;
                left: 0;
                transform: translateX(0);
                box-shadow: none;
                border-radius: 0;
                padding: 0.5rem 0;
                margin-top: 0.5rem;
            }
            .mega-menu-parent:hover .mega-menu-content {
                display: none; /* Hide on hover for mobile, only show on click via Alpine */
            }
        }
    </style>

    {{-- Yield for page-specific styles --}}
    @yield('styles')
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50">

    <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50" x-data="{ open: false, dropdownAbout: false, dropdownAcademic: false }">
        <nav class="container mx-auto px-4 py-3 md:py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('storage/sekolah/logo.png') }}" alt="Logo Sekolah" class="h-10 md:h-12 w-auto animate-fade-in-left">
                <span class="text-xl md:text-2xl font-bold text-blue-700 hidden md:block animate-fade-in-right animation-delay-100">[Nama Sekolah Anda]</span>
            </a>

            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="nav-link">Beranda</a>

                {{-- Mega Menu: Tentang Kami --}}
                <div class="relative group mega-menu-parent" @mouseover="dropdownAbout = true" @mouseleave="dropdownAbout = false">
                    <button class="nav-link flex items-center">
                        Tentang Kami
                        <svg class="ml-1 w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="mega-menu-content" x-show="dropdownAbout" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-bold text-blue-800 mb-2">Profil & Sejarah</h4>
                                <ul class="space-y-1">
                                    <li><a href="{{ route('tentangkami.profil') }}" class="mega-menu-item">Profil Sekolah</a></li>
                                    <li><a href="{{ route('tentangkami.sambutan') }}" class="mega-menu-item">Sambutan Kepala Sekolah</a></li>
                                    <li><a href="{{ route('tentangkami.akreditasi-prestasi') }}" class="mega-menu-item">Akreditasi & Prestasi</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-800 mb-2">Informasi Lainnya</h4>
                                <ul class="space-y-1">
                                    <li><a href="{{ route('tentangkami.fasilitas') }}" class="mega-menu-item">Fasilitas Sekolah</a></li>
                                    <li><a href="{{ route('tentangkami.lokasi-kontak') }}" class="mega-menu-item">Lokasi & Kontak</a></li>
                                    <li><a href="{{ route('kontak.index') }}" class="mega-menu-item">Hubungi Kami</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mega Menu: Akademik --}}
                <div class="relative group mega-menu-parent" @mouseover="dropdownAcademic = true" @mouseleave="dropdownAcademic = false">
                    <button class="nav-link flex items-center">
                        Akademik
                        <svg class="ml-1 w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="mega-menu-content" x-show="dropdownAcademic" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                         <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-bold text-blue-800 mb-2">Program Studi</h4>
                                <ul class="space-y-1">
                                    <li><a href="{{ route('akademik.kurikulum') }}" class="mega-menu-item">Kurikulum & Mata Pelajaran</a></li>
                                    <li><a href="{{ route('akademik.program-unggulan') }}" class="mega-menu-item">Program Unggulan & Ekskul</a></li>
                                    <li><a href="{{ route('akademik.beasiswa') }}" class="mega-menu-item">Informasi Beasiswa</a></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-800 mb-2">Guru & Siswa</h4>
                                <ul class="space-y-1">
                                    <li><a href="{{ route('akademik.guru-staf') }}" class="mega-menu-item">Daftar Guru & Staf</a></li>
                                    <li><a href="{{ route('akademik.ujian-kelulusan') }}" class="mega-menu-item">Ujian & Kelulusan</a></li>
                                    {{-- Add more academic items like learning resources, student portal, etc. --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('berita.index') }}" class="nav-link">Berita</a>
                <a href="{{ route('pengumuman.index') }}" class="nav-link">Pengumuman</a>
                <a href="{{ route('galeri.index') }}" class="nav-link">Galeri</a>
                <a href="{{ route('ppdb.index') }}" class="text-blue-600 hover:text-blue-800 font-bold px-5 py-2 rounded-full border-2 border-blue-600 hover:border-blue-800 transform hover:scale-105 transition duration-300 shadow-md">PPDB</a>
                <a href="{{ route('unduhan.index') }}" class="nav-link">Unduhan</a>
            </div>

            <button class="lg:hidden p-2 text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md" @click="open = !open">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </nav>

        <div class="lg:hidden bg-white shadow-xl" x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4">
            <div class="px-4 py-4 space-y-2 border-t border-gray-200">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-800 hover:bg-blue-100 rounded-md">Beranda</a>

                {{-- Mobile Mega Menu: Tentang Kami --}}
                <div x-data="{ mobileDropdownAbout: false }" class="relative">
                    <button @click="mobileDropdownAbout = !mobileDropdownAbout" class="w-full flex justify-between items-center px-3 py-2 text-gray-800 hover:bg-blue-100 rounded-md">
                        Tentang Kami
                        <svg class="ml-1 w-4 h-4 transform transition-transform duration-300" :class="{'rotate-180': mobileDropdownAbout}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="mobileDropdownAbout" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-1 space-y-1 bg-gray-50 rounded-md shadow-inner py-1">
                        <a href="{{ route('tentangkami.profil') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Profil Sekolah</a>
                        <a href="{{ route('tentangkami.sambutan') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Sambutan Kepala Sekolah</a>
                        <a href="{{ route('tentangkami.fasilitas') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Fasilitas</a>
                        <a href="{{ route('tentangkami.akreditasi-prestasi') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Akreditasi & Prestasi</a>
                        <a href="{{ route('tentangkami.lokasi-kontak') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Lokasi & Kontak</a>
                    </div>
                </div>

                {{-- Mobile Mega Menu: Akademik --}}
                <div x-data="{ mobileDropdownAcademic: false }" class="relative">
                    <button @click="mobileDropdownAcademic = !mobileDropdownAcademic" class="w-full flex justify-between items-center px-3 py-2 text-gray-800 hover:bg-blue-100 rounded-md">
                        Akademik
                        <svg class="ml-1 w-4 h-4 transform transition-transform duration-300" :class="{'rotate-180': mobileDropdownAcademic}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="mobileDropdownAcademic" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" class="mt-1 space-y-1 bg-gray-50 rounded-md shadow-inner py-1">
                        <a href="{{ route('akademik.kurikulum') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Kurikulum</a>
                        <a href="{{ route('akademik.program-unggulan') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Program Unggulan & Ekstrakurikuler</a>
                        <a href="{{ route('akademik.guru-staf') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Daftar Guru & Staf</a>
                        <a href="{{ route('akademik.beasiswa') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Informasi Beasiswa</a>
                        <a href="{{ route('akademik.ujian-kelulusan') }}" class="block px-6 py-2 text-gray-700 hover:bg-blue-50">Ujian & Kelulusan</a>
                    </div>
                </div>
                <a href="{{ route('berita.index') }}" class="block px-3 py-2 text-gray-800 hover:bg-blue-100 rounded-md">Berita</a>
                <a href="{{ route('pengumuman.index') }}" class="block px-3 py-2 text-gray-800 hover:bg-blue-100 rounded-md">Pengumuman</a>
                <a href="{{ route('galeri.index') }}" class="block px-3 py-2 text-gray-800 hover:bg-blue-100 rounded-md">Galeri</a>
                <a href="{{ route('ppdb.index') }}" class="block px-3 py-2 text-blue-600 hover:bg-blue-100 font-semibold rounded-md border border-blue-600">PPDB</a>
                <a href="{{ route('unduhan.index') }}" class="block px-3 py-2 text-gray-800 hover:bg-blue-100 rounded-md">Unduhan</a>
                <a href="{{ route('kontak.index') }}" class="block px-3 py-2 text-gray-800 hover:bg-blue-100 rounded-md">Hubungi Kami</a>
            </div>
        </div>
    </header>

    {{-- CONTENT SECTION --}}
    <main class="mt-[72px]"> {{-- Adjusted margin-top for fixed header --}}
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-gray-300 py-12 md:py-16">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-10">
            <div>
                <img src="{{ asset('storage/sekolah/logo-light.png') }}" alt="Logo Sekolah Light" class="h-16 w-auto mb-5">
                <p class="text-sm leading-relaxed text-gray-400">[Nama Sekolah Anda] berkomitmen untuk menyediakan pendidikan holistik yang berkualitas tinggi, membentuk generasi berkarakter dan berdaya saing global.</p>
                <div class="flex space-x-5 mt-6">
                    <a href="#" class="text-gray-400 hover:text-white transform hover:scale-110 transition duration-300" aria-label="Facebook"><i class="fab fa-facebook-f text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transform hover:scale-110 transition duration-300" aria-label="Instagram"><i class="fab fa-instagram text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transform hover:scale-110 transition duration-300" aria-label="YouTube"><i class="fab fa-youtube text-2xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transform hover:scale-110 transition duration-300" aria-label="Twitter"><i class="fab fa-twitter text-2xl"></i></a>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-white mb-5 border-b-2 border-blue-500 pb-2 inline-block">Tautan Cepat</h3>
                <ul class="space-y-3 mt-4">
                    <li><a href="{{ route('ppdb.index') }}" class="hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-chevron-right text-blue-400 text-xs mr-2"></i> PPDB Online</a></li>
                    <li><a href="{{ route('berita.index') }}" class="hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-chevron-right text-blue-400 text-xs mr-2"></i> Berita & Artikel</a></li>
                    <li><a href="{{ route('galeri.index') }}" class="hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-chevron-right text-blue-400 text-xs mr-2"></i> Galeri Foto & Video</a></li>
                    <li><a href="{{ route('unduhan.index') }}" class="hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-chevron-right text-blue-400 text-xs mr-2"></i> Area Unduhan</a></li>
                    <li><a href="{{ route('kontak.index') }}" class="hover:text-blue-400 transition duration-200 flex items-center"><i class="fas fa-chevron-right text-blue-400 text-xs mr-2"></i> Hubungi Kami</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-xl font-bold text-white mb-5 border-b-2 border-blue-500 pb-2 inline-block">Kontak Kami</h3>
                <address class="text-sm not-italic space-y-3 mt-4">
                    <p class="flex items-start"><i class="fas fa-map-marker-alt text-blue-400 text-lg mt-1 mr-3"></i> [Alamat Lengkap Sekolah Anda], [Kota], [Provinsi], [Kode Pos]</p>
                    <p class="flex items-center"><i class="fas fa-phone-alt text-blue-400 mr-3"></i> Telepon: [Nomor Telepon Sekolah]</p>
                    <p class="flex items-center"><i class="fas fa-envelope text-blue-400 mr-3"></i> Email: [Email Sekolah]</p>
                </address>
            </div>

            <div>
                <h3 class="text-xl font-bold text-white mb-5 border-b-2 border-blue-500 pb-2 inline-block">Lokasi</h3>
                <div class="w-full h-40 bg-gray-700 rounded-lg overflow-hidden border border-gray-700 shadow-md">
                    {{-- Replace with your actual Google Maps iframe --}}
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.529813580552!2d106.82860851476882!3d-6.193231495514603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f41753c153d1%3A0xf6398b1a37c4d5!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1625055000000!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 text-center border-t border-gray-700 pt-8 mt-12">
            <p class="text-sm text-gray-500">© {{ date('Y') }} [Nama Sekolah Anda]. Semua Hak Cipta Dilindungi.</p>
            <p class="text-xs text-gray-600 mt-1">Dibuat dengan ❤️ di Indonesia.</p>
        </div>
    </footer>

    {{-- Swiper JS (move to app.js if preferred) --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Inisialisasi Swiper untuk Testimonial
        const swiper = new Swiper('.mySwiper', {
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            speed: 1000,
        });

        // Optional: Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Adjust header shadow on scroll (optional)
        const header = document.querySelector('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('shadow-lg');
            } else {
                header.classList.remove('shadow-lg');
            }
        });
    </script>
    {{-- Yield for page-specific scripts --}}
    @yield('scripts')
</body>
</html>