<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="space-y-6">
        <!-- START: Kartu Statistik Utama -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            
            {{-- Card Pendaftar PPDB --}}
            <div class="flex items-center p-6 bg-white rounded-lg shadow-sm">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full">
                    <i class="fas fa-user-graduate fa-2x"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Pendaftar PPDB</p>
                    <p class="text-2xl font-bold text-slate-700">{{ $totalPendaftarPpdb }}</p>
                </div>
            </div>

            {{-- Card Berita --}}
            <div class="flex items-center p-6 bg-white rounded-lg shadow-sm">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full">
                    <i class="fas fa-newspaper fa-2x"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Berita</p>
                    <p class="text-2xl font-bold text-slate-700">{{ $totalBerita }}</p>
                </div>
            </div>

            {{-- Card Guru & Staf --}}
            <div class="flex items-center p-6 bg-white rounded-lg shadow-sm">
                <div class="p-3 mr-4 text-amber-500 bg-amber-100 rounded-full">
                    <i class="fas fa-chalkboard-teacher fa-2x"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Guru & Staf</p>
                    <p class="text-2xl font-bold text-slate-700">{{ $totalGuru + $totalStaf }}</p>
                </div>
            </div>

            {{-- Card Pengguna Sistem --}}
            <div class="flex items-center p-6 bg-white rounded-lg shadow-sm">
                <div class="p-3 mr-4 text-indigo-500 bg-indigo-100 rounded-full">
                    <i class="fas fa-users-cog fa-2x"></i>
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
                <canvas id="pendaftarChart"></canvas>
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="space-y-6">
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="mb-4 font-semibold text-slate-700">Pendaftar Terbaru</h3>
                    <div class="space-y-4">
                        @forelse ($pendaftarTerbaru as $pendaftar)
                            <div class="flex items-center">
                                <div class="w-10 h-10 mr-3 text-white bg-sky-500 rounded-full flex items-center justify-center font-bold">
                                    {{ substr($pendaftar->nama_lengkap, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-800">{{ Str::limit($pendaftar->nama_lengkap, 20) }}</p>
                                    <p class="text-xs text-slate-500">{{ $pendaftar->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada pendaftar baru.</p>
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
                            <p class="text-sm text-slate-500">Belum ada berita baru.</p>
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
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                    {{-- Visitors --}}
                    <div class="p-6 bg-white rounded-lg shadow-sm">
                        <h4 class="text-sm font-medium text-slate-500">Total Pengunjung</h4>
                        <p class="mt-1 text-3xl font-bold text-slate-700">{{ $analyticsData->sum('totalUsers') }}</p>
                    </div>
                    {{-- Pageviews --}}
                    <div class="p-6 bg-white rounded-lg shadow-sm">
                        <h4 class="text-sm font-medium text-slate-500">Total Page Views</h4>
                        <p class="mt-1 text-3xl font-bold text-slate-700">{{ $analyticsData->sum('screenPageViews') }}</p>
                    </div>
                    {{-- Top Cities --}}
                    <div class="p-6 bg-white rounded-lg shadow-sm md:col-span-1">
                        <h4 class="mb-3 font-semibold text-slate-700">Kota Teratas</h4>
                        <ul class="space-y-2">
                            @foreach ($topCities as $city)
                                <li class="flex justify-between text-sm">
                                    <span class="text-slate-600">{{ $city['city'] }}</span>
                                    <span class="font-semibold text-slate-800">{{ $city['totalUsers'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- Top Referrers --}}
                    <div class="p-6 bg-white rounded-lg shadow-sm md:col-span-1">
                        <h4 class="mb-3 font-semibold text-slate-700">Sumber Trafik Teratas</h4>
                        <ul class="space-y-2">
                            @foreach ($topReferrers as $referrer)
                                <li class="flex justify-between text-sm">
                                    <span class="text-slate-600">{{ $referrer['pageReferrer'] === '(direct)' ? 'Langsung' : $referrer['pageReferrer'] }}</span>
                                    <span class="font-semibold text-slate-800">{{ $referrer['screenPageViews'] }}</span>
                                </li>
                            @endforeach
                        </ul>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('pendaftarChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($pendaftarLabels),
                        datasets: [{
                            label: 'Jumlah Pendaftar',
                            data: @json($pendaftarData),
                            fill: true,
                            backgroundColor: 'rgba(14, 165, 233, 0.1)', // sky-500
                            borderColor: 'rgb(14, 165, 233)', // sky-500
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
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    // Pastikan hanya integer yang ditampilkan di sumbu Y
                                    stepSize: 1,
                                    callback: function(value) {
                                        if (Math.floor(value) === value) {
                                            return value;
                                        }
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        interaction: {
                            intersect: false,
                            mode: 'index',
                        },
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>