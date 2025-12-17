<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($pengeluarans->count() > 0)
                <!-- ===================== -->
                <!-- CARD TOTAL + BUTTON -->
                <!-- ===================== -->
                <div class="mb-8">
                    <div class="bg-[#D4E4F7] rounded-xl p-6
                                flex flex-col md:flex-row md:justify-between md:items-center gap-4">

                        <div>
                            <p class="text-sm text-gray-700 mb-2">
                                Total Pengeluaran Hari Ini
                            </p>
                            <h2 class="text-3xl font-bold text-gray-900">
                                Rp {{ number_format($ringkasanHarian, 0, '.', '.') }}
                            </h2>
                        </div>

                        <a href="{{ route('pengeluaran.create') }}"
                           class="inline-flex items-center gap-2
                                  bg-[#1B365C] text-white px-6 py-4 rounded-lg
                                  font-medium hover:bg-[#152949] transition shadow">
                            <span class="text-xl">+</span>
                            Tambah Pengeluaran
                        </a>
                    </div>
                </div>

                <!-- ===================== -->
                <!-- ANALISIS PENGELUARAN -->
                <!-- ===================== -->
                @php
                    $totalPengeluaran = $chartKategori->sum();
                    $sortedKategori = $chartKategori->sortDesc();
                    $warnaChart = [
                        '#1B365C',
                        '#4F7CAC',
                        '#C1D3FE',
                        '#FFB703',
                        '#FB8500',
                        '#FF6B6B'
                    ];
                @endphp

                <div class="bg-white rounded-xl shadow p-6 mb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Analisis Pengeluaran</h3>
                            <p class="text-xs text-gray-400">Distribusi berdasarkan kategori</p>
                        </div>

                        <div class="flex gap-5 text-sm">
                            @php
                                $active = 'text-[#1B365C] font-semibold border-b-2 border-[#1B365C]';
                                $inactive = 'text-gray-400 hover:text-[#1B365C]';
                            @endphp
                            <a href="{{ route('pengeluaran.index') }}" class="pb-1 {{ !request('filter') ? $active : $inactive }}">Semua</a>
                            <a href="{{ route('pengeluaran.index', ['filter' => 'today']) }}" class="pb-1 {{ request('filter') == 'today' ? $active : $inactive }}">Hari Ini</a>
                            <a href="{{ route('pengeluaran.index', ['filter' => 'week']) }}" class="pb-1 {{ request('filter') == 'week' ? $active : $inactive }}">Minggu Ini</a>
                            <a href="{{ route('pengeluaran.index', ['filter' => 'month']) }}" class="pb-1 {{ request('filter') == 'month' ? $active : $inactive }}">Bulan Ini</a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Donut Chart -->
                        <div class="flex justify-center">
                            <div class="relative w-64 h-64 mx-auto">
                                <canvas id="kategoriChart"></canvas>
                                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                    <p class="text-xs text-gray-500">Total</p>
                                    <p class="text-sm font-semibold text-[#1B365C] px-3 py-1 rounded-full">
                                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- List Kategori -->
                        <div>
                            <ul class="space-y-4">
                                @foreach($sortedKategori as $nama => $nominal)
                                    @php
                                        $persen = $totalPengeluaran ? round(($nominal / $totalPengeluaran) * 100, 1) : 0;
                                    @endphp
                                    <li class="flex justify-between items-center">
                                        <div class="flex items-start gap-3">
                                            <span class="mt-1 w-3 h-3 rounded-full"
                                                  style="background-color: {{ $warnaChart[$loop->index] ?? '#ccc' }}"></span>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $loop->iteration }}. {{ $nama }}</p>
                                                <p class="text-xs text-gray-500">{{ $persen }}% dari total</p>
                                            </div>
                                        </div>
                                        <p class="font-semibold text-gray-900">
                                            Rp {{ number_format($nominal, 0, ',', '.') }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Histori Pengeluaran -->
                <h3 class="text-lg font-bold text-gray-900 mb-4">Histori</h3>
                @if($pengeluarans->count())
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Keterangan</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase">Nominal</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach($pengeluarans as $pengeluaran)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <span class="px-3 py-1 rounded text-xs font-medium"
                                                  style="background-color: {{ $pengeluaran->kategori->warna }}20; color: {{ $pengeluaran->kategori->warna }}">
                                                {{ $pengeluaran->kategori->nama }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $pengeluaran->keterangan }}</td>
                                        <td class="px-6 py-4 text-sm font-semibold text-right">- Rp {{ number_format($pengeluaran->nominal, 0, '.', '.') }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex justify-center gap-4">
                                                <a href="{{ route('pengeluaran.edit', $pengeluaran->id) }}" class="text-blue-600 text-sm font-medium">Edit</a>
                                                <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 text-sm font-medium" onclick="return confirm('Yakin ingin menghapus?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            @else
                <!-- EMPTY STATE -->
                <div class="text-center py-12 bg-white rounded-xl shadow">
                    <h2 class="text-xl font-bold mb-4">Belum ada Pengeluaran</h2>
                    <p class="mb-6 text-gray-500">Mulai dengan menambahkan pengeluaran pertama kamu.</p>
                    <a href="{{ route('pengeluaran.create') }}"
                       class="bg-[#1B365C] text-white px-6 py-3 rounded-lg font-medium hover:bg-[#152949] transition">
                        + Tambah Pengeluaran
                    </a>
                </div>
            @endif

        </div>
    </div>

    <!-- ===================== -->
    <!-- CHART JS -->
    <!-- ===================== -->
    @if($pengeluarans->count() > 0)
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            new Chart(document.getElementById('kategoriChart'), {
                type: 'doughnut',
                data: {
                    labels: @json($chartKategori->keys()),
                    datasets: [{
                        data: @json($chartKategori->values()),
                        backgroundColor: @json($warnaChart),
                        borderWidth: 2
                    }]
                },
                options: {
                    plugins: { legend: { display: false } },
                    cutout: '50%'
                }
            });
        </script>
    @endif
</x-app-layout>
