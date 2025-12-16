<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message --> @if(session('success')) <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6"> {{ session('success') }} </div> @endif

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

                <!-- Header + Filter -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">
                            Analisis Pengeluaran
                        </h3>
                        <p class="text-xs text-gray-400">
                            Distribusi berdasarkan kategori
                        </p>
                    </div>

                    <div class="flex gap-5 text-sm">
                        @php
                            $active = 'text-[#1B365C] font-semibold border-b-2 border-[#1B365C]';
                            $inactive = 'text-gray-400 hover:text-[#1B365C]';
                        @endphp

                        <a href="{{ route('pengeluaran.index') }}"
                           class="pb-1 {{ !request('filter') ? $active : $inactive }}">
                            Semua
                        </a>

                        <a href="{{ route('pengeluaran.index', ['filter' => 'today']) }}"
                           class="pb-1 {{ request('filter') == 'today' ? $active : $inactive }}">
                            Hari Ini
                        </a>

                        <a href="{{ route('pengeluaran.index', ['filter' => 'week']) }}"
                           class="pb-1 {{ request('filter') == 'week' ? $active : $inactive }}">
                            Minggu Ini
                        </a>

                        <a href="{{ route('pengeluaran.index', ['filter' => 'month']) }}"
                           class="pb-1 {{ request('filter') == 'month' ? $active : $inactive }}">
                            Bulan Ini
                        </a>
                    </div>
                </div>

                <!-- Isi Analisis -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Donut Chart -->
                    <div class="flex justify-center">
                        <div class="relative w-64 h-64 mx-auto">
                            <canvas id="kategoriChart"></canvas>

                            <!-- Total di tengah -->
                                <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                                    <p class="text-xs text-gray-500 ">
                                        Total
                                    </p>
                                    <p class="text-sm font-semibold text-[#1B365C]  px-3 py-1 rounded-full">
                                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                                    </p>
                                </div>
                        </div>
                    </div>

                    <!-- List Kategori -->
                    <div>
                        @if($sortedKategori->count())
                            <ul class="space-y-4">
                                @foreach($sortedKategori as $nama => $nominal)
                                    @php
                                        $persen = $totalPengeluaran
                                            ? round(($nominal / $totalPengeluaran) * 100, 1)
                                            : 0;
                                    @endphp

                                    <li class="flex justify-between items-center">
                                        <div class="flex items-start gap-3">
                                            <span class="mt-1 w-3 h-3 rounded-full"
                                                  style="background-color: {{ $warnaChart[$loop->index] ?? '#ccc' }}">
                                            </span>

                                            <div>
                                                <p class="font-medium text-gray-900">
                                                    {{ $loop->iteration }}. {{ $nama }}
                                                </p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $persen }}% dari total
                                                </p>
                                            </div>
                                        </div>

                                        <p class="font-semibold text-gray-900">
                                            Rp {{ number_format($nominal, 0, ',', '.') }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">
                                Belum ada data pengeluaran
                            </p>
                        @endif
                    </div>

                </div>
            </div>

            <!-- ===================== -->
            <!-- HISTORI PENGELUARAN -->
            <!-- ===================== -->
            <h3 class="text-lg font-bold text-gray-900 mb-4">
                Histori
            </h3>

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
                                    <td class="px-6 py-4 text-sm">
                                        {{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-3 py-1 rounded text-xs font-medium"
                                              style="background-color: {{ $pengeluaran->kategori->warna }}20;
                                                     color: {{ $pengeluaran->kategori->warna }}">
                                            {{ $pengeluaran->kategori->nama }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $pengeluaran->keterangan }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-semibold text-right">
                                        - Rp {{ number_format($pengeluaran->nominal, 0, '.', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center ">
                                        <div class="flex justify-center gap-4">
                                            <a href="{{ route('pengeluaran.edit', $pengeluaran->id) }}"
                                               class="text-blue-600 text-sm font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 text-sm font-medium"
                                                        onclick="return confirm('Yakin ingin menghapus?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                                        </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 text-gray-500">
                    Belum ada pengeluaran
                </div>
            @endif

        </div>
    </div>

    <!-- ===================== -->
    <!-- CHART JS -->
    <!-- ===================== -->
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
</x-app-layout>
