<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="space-y-6">
        <!-- START: Kartu Statistik Utama -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            
            {{-- Card Pendaftar PPDB --}}
            <div class="flex items-start p-6 bg-white rounded-lg shadow-sm">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                    <i class="fas fa-user-graduate fa-fw"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Pendaftar PPDB</p>
                    <p class="text-2xl font-bold text-slate-700">{{ $totalPendaftarPpdb }}</p>
                </div>
            </div>

            {{-- Card Berita --}}
            <div class="flex items-start p-6 bg-white rounded-lg shadow-sm">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                    <i class="fas fa-newspaper fa-fw"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Berita</p>
                    <p class="text-2xl font-bold text-slate-700">{{ $totalBerita }}</p>
                </div>
            </div>

            {{-- Card Guru & Staf --}}
            <div class="flex items-start p-6 bg-white rounded-lg shadow-sm">
                <div class="p-3 mr-4 text-amber-500 bg-amber-100 rounded-full">
                    <i class="fas fa-chalkboard-teacher fa-fw"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Guru & Staf</p>
                    <p class="text-2xl font-bold text-slate-700">{{ $totalGuru + $totalStaf }}</p>
                </div>
            </div>

            {{-- Card Pengguna Sistem --}}
            <div class="flex items-start p-6 bg-white rounded-lg shadow-sm">
                <div class="p-3 mr-4 text-indigo-500 bg-indigo-100 rounded-full">
                    <i class="fas fa-users-cog fa-fw"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Pengguna Sistem</p>
                    <p class="text-2xl font-bold text-slate-700">{{ $totalUser }}</p>
                </div>
            </div>
        </div>
        <!-- END: Kartu Statistik Utama -->

        <!-- START: Grafik dan Aktivitas Terbaru -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            
            {{-- Grafik Pendaftar --}}
            <div class="p-6 bg-white rounded-lg shadow-sm lg:col-span-2">
                <h3 class="mb-4 text-lg font-semibold text-slate-700">Grafik Pendaftar PPDB (7 Hari Terakhir)</h3>
                <div class="h-80">
                    <canvas id="pendaftarChart"></canvas>
                </div>
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="space-y-6">
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="mb-4 font-semibold text-slate-700">Pendaftar Terbaru</h3>
                    <div class="space-y-4">
                        @forelse ($pendaftarTerbaru as $pendaftar)
                            <div class="flex items-center">
                                <div class="w-10 h-10 mr-3 text-white bg-sky-500 rounded-full flex items-center justify-center font-bold flex-shrink-0">
                                    {{ substr($pendaftar->nama_lengkap, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-800">{{ Str::limit($pendaftar->nama_lengkap, 25) }}</p>
                                    <p class="text-xs text-slate-500">{{ $pendaftar->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-center text-slate-500 py-4">Belum ada pendaftar baru.</p>
                        @endforelse
                    </div>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="mb-4 font-semibold text-slate-700">Berita Terbaru</h3>
                    <div class="space-y-3">
                        @forelse ($beritaTerbaru as $berita)
                            <div>
                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="font-medium text-slate-800 hover:text-sky-600 transition-colors">{{ $berita->judul }}</a>
                                <p class="text-xs text-slate-500">Oleh {{ $berita->user->name }} - {{ $berita->created_at->format('d M Y') }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-center text-slate-500 py-4">Belum ada berita baru.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Grafik dan Aktivitas Terbaru -->

        <!-- START: Statistik Google Analytics -->
        @if ($analyticsData)
            <div>
                <h2 class="mb-4 text-xl font-bold text-slate-800">Statistik Website (28 Hari Terakhir)</h2>
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <!-- Peta Pengunjung -->
                    <div class="p-6 bg-white rounded-lg shadow-sm">
                        <h3 class="mb-4 text-lg font-semibold text-slate-700">Peta Pengunjung</h3>
                        <div id="world-map" class="w-full h-80 bg-slate-100 rounded-md"></div>
                    </div>

                    <!-- Detail Statistik -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div class="p-6 bg-white rounded-lg shadow-sm">
                                <h4 class="text-sm font-medium text-slate-500">Total Pengunjung</h4>
                                <p class="mt-1 text-3xl font-bold text-slate-700">{{ $analyticsData->sum('totalUsers') }}</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-sm">
                                <h4 class="text-sm font-medium text-slate-500">Total Page Views</h4>
                                <p class="mt-1 text-3xl font-bold text-slate-700">{{ $analyticsData->sum('screenPageViews') }}</p>
                            </div>
                        </div>
                        <div class="p-6 bg-white rounded-lg shadow-sm">
                             <h4 class="mb-3 font-semibold text-slate-700">Sumber Trafik Teratas</h4>
                            <ul class="space-y-2">
                                @forelse ($topReferrers as $referrer)
                                    <li class="flex justify-between text-sm">
                                        <span class="text-slate-600 truncate pr-4">{{ $referrer['pageReferrer'] === '(direct)' ? 'Langsung' : $referrer['pageReferrer'] }}</span>
                                        <span class="font-semibold text-slate-800">{{ number_format($referrer['screenPageViews']) }}</span>
                                    </li>
                                @empty
                                     <p class="text-sm text-center text-slate-500 py-4">Data tidak ditemukan.</p>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="p-6 text-center bg-yellow-100 border-l-4 border-yellow-500 rounded-r-lg">
                <p class="text-yellow-800">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Data Google Analytics tidak tersedia. Mohon konfigurasikan di menu <a href="{{ route('admin.pengaturan.index') }}" class="font-bold underline hover:text-yellow-900">Pengaturan</a> untuk menampilkannya.
                </p>
            </div>
        @endif
        <!-- END: Statistik Google Analytics -->

    </div>

    @push('scripts')
    {{-- CDN untuk Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    {{-- CDN untuk jVectorMap --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.css" type="text/css" media="screen"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/jquery-jvectormap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.5/maps/jquery-jvectormap-world-mill-en.js"></script>


    <script>
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
            @if($topCities)
                // NOTE: Controller Anda mengirim 'topCities'. Untuk peta dunia, data per negara lebih ideal.
                // Anda bisa mengubah `Analytics::fetchTopCities` menjadi `Analytics::fetchTopCountries` di controller.
                // Kode di bawah ini mengasumsikan Anda akan mengirim data negara dengan `countryIsoCode`.
                // Jika tetap menggunakan kota, peta tidak akan menampilkan data.
                const visitorsData = {
                    @foreach($topCities as $city)
                        // 'countryIsoCode' adalah kunci yang dibutuhkan jVectorMap.
                        // Jika Anda menggunakan fetchTopCountries, kunci ini akan tersedia.
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
                            scale: ['#C8EEFF', '#0071A4'], // Gradasi warna dari biru muda ke biru tua
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
