<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Halo, {{ Auth::user()->name }}! </h1>
                <p class="text-sm text-gray-600">Selamat datang ke Fintrack, semoga kamu bahagia</p>
            </div>

            {{-- Card Ringkasan --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-6 ">
                {{-- Total Pengeluaran bulan ini--}}
                <div class="bg-[#D4E4F7] rounded-xl shadow p-6 text-center text-gray-700 ">
                    <p class="text-sm mb-1">Pengeluaran Bulan ini</p>
                    <p class="text-2xl font-bold">
                        Rp {{ number_format($totalPengeluaranBulanIni, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Total Pengeluaran= hari ini --}}
                <div class="bg-[#D4E4F7]  rounded-xl shadow p-6 text-center text-gray-700">
                    <p class="text-sm mb-1">Pengeluaran Hari Ini</p>
                    <p class="text-2xl font-bold">
                        Rp {{ number_format($totalPengeluaranHariIni, 0, ',', '.') }}
                    </p>
                </div>

                {{-- pengeluaran kemarin--}}
                <div class="bg-[#D4E4F7]  rounded-xl shadow p-6 text-center text-gray-700">
                    <p class="text-sm mb-1">Jumlah Track</p>
                    <p class="text-2xl font-bold">{{ $jumlahTransaksi }}</p>
                </div>
            </div>

           {{-- Quick Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <a href="{{ route('pengeluaran.create') }}" 
                class="bg-[#152949] text-white p-4 rounded-lg shadow hover:bg-[#0f1d34] transition text-center font-medium flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                    Tambah Pengeluaran
                </a>

                <a href="{{ route('tabungan.create') }}" 
                class="bg-[#152949] text-white p-4 rounded-lg shadow hover:bg-[#0f1d34] transition text-center font-medium flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                    </svg>
                    Tambah Tabungan
                </a>
            </div>


            {{-- Info Tabungan --}}
            @if($tabungan)
            <div class="bg-gradient-to-r from-[#1B365C]/20 to-[#1B365C]/10 rounded-lg shadow p-6 mb-6 text-[#1B365C]">
                <h2 class="text-lg font-bold mb-3">Target Tabungan: {{ $tabungan->nama_tabungan }}</h2>
                
                <div class="mb-3">
                    <div class="flex justify-between text-sm mb-1">
                        <span>Progress</span>
                        <span class="font-bold">{{ $tabungan->progress_percentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-300 rounded-full h-4">
                        <div class="bg-[#1B365C] h-4 rounded-full" 
                             style="width: {{ $tabungan->progress_percentage }}%"></div>
                    </div>
                </div>

                <div class="flex justify-between text-sm">
                    <div>
                        <p class="text-gray-600">Terkumpul</p>
                        <p class="font-bold">Rp {{ number_format($tabungan->saldo_terkini, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-600">Target</p>
                        <p class="font-bold">Rp {{ number_format($tabungan->target_tabungan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Pengeluaran Terbaru --}}
            <div class=" p-6">
                <h2 class="text-lg font-bold mb-4 text-[#1B365C]">Pengeluaran Terbaru</h2>

                @if($pengeluaranTerbaru->count() > 0)
                <ul class="divide-y">
                    @foreach($pengeluaranTerbaru as $pengeluaran)
                    <li class="py-3 flex justify-between items-center">
                        <div>
                            <p class="font-medium">{{ $pengeluaran->keterangan }}</p>
                            <p class="text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}
                                • {{ $pengeluaran->kategori->nama }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-[#1B365C]">
                                - Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <div class="mt-4 text-center">
                    <a href="{{ route('pengeluaran.index') }}" 
                       class="text-[#1B365C] hover:underline text-sm">
                        Lihat Semua Pengeluaran →
                    </a>
                </div>
                @else
                <p class="text-center text-gray-500 py-8">Belum ada pengeluaran</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
