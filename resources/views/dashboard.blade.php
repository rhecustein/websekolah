<x-app-layout>
    {{-- START: Header Halaman --}}
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-2xl font-bold leading-tight text-slate-800">
                    Selamat Datang Kembali, {{ Auth::user()->name }}! 👋
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Berikut adalah ringkasan aktivitas sekolah hari ini.
                </p>
            </div>
            <div>
                <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-sky-600 rounded-lg shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 transition-all">
                    <i class="fas fa-plus-circle"></i>
                    Tulis Berita Baru
                </a>
            </div>
        </div>
    </x-slot>
    {{-- END: Header Halaman --}}

    <div class="space-y-8">
        {{-- START: Kartu Statistik Utama (Versi Inline) --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
            {{-- Card 1: Pendaftar PPDB --}}
            <div class="flex items-center p-5 bg-white rounded-xl shadow-lg transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex-shrink-0 mr-4">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full text-green-600 bg-green-100">
                        <i class="fas fa-user-graduate fa-lg"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-500">Pendaftar PPDB</p>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-bold text-slate-800">{{ $totalPendaftarPpdb }}</p>
                        {{-- <span class="ml-2 text-xs font-semibold text-green-600">+5% dari kemarin</span> --}}
                    </div>
                </div>
            </div>

            {{-- Card 2: Total Berita --}}
            <div class="flex items-center p-5 bg-white rounded-xl shadow-lg transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex-shrink-0 mr-4">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full text-blue-600 bg-blue-100">
                        <i class="fas fa-newspaper fa-lg"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-500">Total Berita</p>
                    <div class="flex items-baseline">
                        <p class="text-2xl font-bold text-slate-800">{{ $totalBerita }}</p>
                        {{-- <span class="ml-2 text-xs font-semibold text-green-600">+2 artikel minggu ini</span> --}}
                    </div>
                </div>
            </div>

            {{-- Card 3: Guru & Staf --}}
            <div class="flex items-center p-5 bg-white rounded-xl shadow-lg transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex-shrink-0 mr-4">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full text-amber-600 bg-amber-100">
                        <i class="fas fa-chalkboard-teacher fa-lg"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-500">Guru & Staf</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalGuru + $totalStaf }}</p>
                </div>
            </div>

            {{-- Card 4: Pengguna Sistem --}}
            <div class="flex items-center p-5 bg-white rounded-xl shadow-lg transform hover:-translate-y-1 transition-transform duration-300">
                <div class="flex-shrink-0 mr-4">
                    <div class="flex items-center justify-center w-14 h-14 rounded-full text-indigo-600 bg-indigo-100">
                        <i class="fas fa-users-cog fa-lg"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-500">Pengguna Sistem</p>
                    <p class="text-2xl font-bold text-slate-800">{{ $totalUser }}</p>
                </div>
            </div>
        </div>
        {{-- END: Kartu Statistik Utama --}}

        {{-- START: Grafik dan Aktivitas Terbaru --}}
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            
            {{-- Grafik Pendaftar --}}
            <div class="p-6 bg-white rounded-xl shadow-lg lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-slate-800">Grafik Pendaftar PPDB (7 Hari Terakhir)</h3>
                    <select class="px-2 py-1 text-sm border-gray-300 rounded-md shadow-sm focus:border-sky-500 focus:ring-sky-500">
                        <option>7 Hari</option>
                        <option>30 Hari</option>
                    </select>
                </div>
                <div class="h-80">
                    <canvas id="pendaftarChart"></canvas>
                </div>
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="space-y-6">
                {{-- Pendaftar Terbaru --}}
                <div class="p-6 bg-white rounded-xl shadow-lg">
                    <h3 class="mb-5 text-lg font-bold text-slate-800">Pendaftar Terbaru</h3>
                    <div class="space-y-4">
                        @forelse ($pendaftarTerbaru as $pendaftar)
                            <a href="#" class="flex items-start p-2 -m-2 rounded-lg hover:bg-slate-50 transition-colors">
                                <div class="flex items-center justify-center w-10 h-10 mr-3 font-bold text-white bg-sky-500 rounded-full flex-shrink-0">
                                    {{ substr($pendaftar->nama_lengkap, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-800">{{ Str::limit($pendaftar->nama_lengkap, 25) }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $pendaftar->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 px-4">
                                <div class="inline-block p-4 bg-slate-100 rounded-full">
                                    <i class="fas fa-user-plus fa-2x text-slate-400"></i>
                                </div>
                                <p class="mt-4 text-sm text-slate-500">Belum ada pendaftar baru.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                
                {{-- Berita Terbaru --}}
                <div class="p-6 bg-white rounded-xl shadow-lg">
                    <h3 class="mb-5 text-lg font-bold text-slate-800">Berita Terbaru</h3>
                    <div class="space-y-4">
                         @forelse ($beritaTerbaru as $berita)
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="flex items-start p-2 -m-2 rounded-lg hover:bg-slate-50 transition-colors">
                                <div class="flex items-center justify-center w-10 h-10 mr-3">
                                    <i class="far fa-newspaper fa-lg text-slate-400"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-slate-800">{{ $berita->judul }}</p>
                                    <p class="text-xs text-slate-500">Oleh {{ $berita->user->name }} - {{ $berita->created_at->format('d M Y') }}</p>
                                </div>
                            </a>
                        @empty
                            <div class="text-center py-8 px-4">
                                <div class="inline-block p-4 bg-slate-100 rounded-full">
                                    <i class="far fa-newspaper fa-2x text-slate-400"></i>
                                </div>
                                <p class="mt-4 text-sm text-slate-500">Belum ada berita baru.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Grafik dan Aktivitas Terbaru --}}

        {{-- START: Statistik Google Analytics --}}
        @if ($analyticsData)
            <div>
                <h2 class="mb-4 text-xl font-bold text-slate-800">Statistik Website (28 Hari Terakhir)</h2>
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-5">
                    
                    {{-- Peta Pengunjung --}}
                    <div class="p-6 bg-white rounded-xl shadow-lg lg:col-span-3">
                        <h3 class="mb-4 text-lg font-bold text-slate-800">Peta Pengunjung</h3>
                        <div id="world-map" class="w-full h-96 bg-slate-50 rounded-lg"></div>
                    </div>

                    {{-- Detail Statistik --}}
                    <div class="space-y-6 lg:col-span-2">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-1">
                            <div class="p-6 text-white bg-gradient-to-br from-sky-500 to-sky-700 rounded-xl shadow-lg">
                                <h4 class="text-sm font-medium text-sky-100">Total Pengunjung</h4>
                                <p class="mt-2 text-4xl font-bold">{{ $analyticsData->sum('totalUsers') }}</p>
                            </div>
                            <div class="p-6 text-white bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-xl shadow-lg">
                                <h4 class="text-sm font-medium text-indigo-100">Total Page Views</h4>
                                <p class="mt-2 text-4xl font-bold">{{ $analyticsData->sum('screenPageViews') }}</p>
                            </div>
                        </div>
                        <div class="p-6 bg-white rounded-xl shadow-lg">
                            <h4 class="mb-4 font-bold text-slate-800">Sumber Trafik Teratas</h4>
                            <ul class="space-y-3">
                                @forelse ($topReferrers as $referrer)
                                    <li class="flex items-center justify-between text-sm">
                                        <span class="text-slate-600 truncate pr-4">
                                            <i class="fas fa-link fa-sm text-slate-400 mr-2"></i>
                                            {{ $referrer['pageReferrer'] === '(direct)' ? 'Langsung' : $referrer['pageReferrer'] }}
                                        </span>
                                        <span class="font-bold text-slate-800 px-2 py-1 bg-slate-100 rounded-md">{{ number_format($referrer['screenPageViews']) }}</span>
                                    </li>
                                @empty
                                    <div class="text-center py-8 px-4">
                                        <div class="inline-block p-4 bg-slate-100 rounded-full">
                                            <i class="fas fa-chart-line fa-2x text-slate-400"></i>
                                        </div>
                                        <p class="mt-4 text-sm text-slate-500">Data trafik tidak ditemukan.</p>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            {{-- Alert: Google Analytics tidak tersedia --}}
            <div class="p-4 border-l-4 rounded-r-lg bg-yellow-100 border-yellow-500 text-yellow-800">
                <div class="flex">
                    <div class="py-1"><i class="fas fa-exclamation-triangle mr-3"></i></div>
                    <div>
                        <p class="text-sm">
                            Data Google Analytics tidak tersedia. Mohon konfigurasikan di menu <a href="{{ route('admin.pengaturan.index') }}" class="font-bold underline hover:text-yellow-900">Pengaturan</a> untuk menampilkannya.
                        </p>
                    </div>
                </div>
            </div>
        @endif
        {{-- END: Statistik Google Analytics --}}
    </div>

    @push('scripts')
        {{-- CDN dan script tidak berubah, Anda bisa biarkan seperti ini --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.css" type="text/css" media="screen"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/maps/jquery-jvectormap-world-mill-en.js"></script>

        {{-- SCRIPT LAMA ANDA --}}
        <script>
            // Paste script lama Anda di sini, tidak perlu ada perubahan.
            // ...
            document.addEventListener('DOMContentLoaded', function () {
                // Grafik Pendaftar
                const pendaftarCtx = document.getElementById('pendaftarChart');
                if (pendaftarCtx) {
                    new Chart(pendaftarCtx, {
                        type: 'line',
                        data: {
                            labels: @json($pendaftarLabels),
                            datasets: [{
                                label: 'Jumlah Pendaftar',
                                data: @json($pendaftarData),
                                fill: true,
                                backgroundColor: 'rgba(14, 165, 233, 0.1)',
                                borderColor: 'rgb(14, 165, 233)',
                                tension: 0.4,
                                pointBackgroundColor: 'rgb(14, 165, 233)',
                                pointBorderColor: '#fff',
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: 'rgb(14, 165, 233)'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: { beginAtZero: true, ticks: { stepSize: 1 } }
                            },
                            plugins: { legend: { display: false } },
                            interaction: { intersect: false, mode: 'index' },
                        }
                    });
                }
    
                // Peta Pengunjung Dunia
                @if($analyticsData && $topCities)
                    const visitorsData = {
                        @foreach($topCities as $city)
                            @if(isset($city['countryIsoCode']))
                                "{{ $city['countryIsoCode'] }}": {{ $city['totalUsers'] }},
                            @endif
                        @endforeach
                    };
    
                    $('#world-map').vectorMap({
                        map: 'world_mill_en',
                        backgroundColor: 'transparent',
                        series: {
                            regions: [{
                                values: visitorsData,
                                scale: ['#C8EEFF', '#0071A4'],
                                normalizeFunction: 'polynomial'
                            }]
                        },
                        onRegionTipShow: function(e, el, code){
                            el.html(el.html() + ' (Pengunjung: ' + (visitorsData[code] || 0) + ')');
                        }
                    });
                @endif
            });
        </script>
    @endpush
</x-app-layout>