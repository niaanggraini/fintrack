<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            💸 Daftar Pengeluaran
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header dengan tombol tambah -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">💸 Daftar Pengeluaran</h2>
                <a href="{{ route('pengeluaran.create') }}"
                   class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 font-semibold">
                    ➕ Tambah Pengeluaran
                </a>
            </div>

            <!-- Ringkasan Harian -->
            <div class="bg-gradient-to-r from-red-500 to-pink-600 rounded-lg shadow-lg p-6 mb-6">
                <div class="text-white">
                    <p class="text-sm font-semibold uppercase">Pengeluaran Hari Ini</p>
                    <p class="text-4xl font-bold mt-2">
                        Rp {{ number_format($ringkasanHarian, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            <!-- Filter Cepat -->
            <div class="bg-white rounded-lg shadow p-4 mb-6">
                <p class="text-sm font-semibold text-gray-700 mb-3">🔍 Filter Cepat:</p>
                <div class="flex space-x-3">
                    <a href="{{ route('pengeluaran.index') }}"
                       class="px-4 py-2 rounded-lg {{ !request('filter') ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Semua
                    </a>
                    <a href="{{ route('pengeluaran.index', ['filter' => 'today']) }}"
                       class="px-4 py-2 rounded-lg {{ request('filter') == 'today' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Hari Ini
                    </a>
                    <a href="{{ route('pengeluaran.index', ['filter' => 'week']) }}"
                       class="px-4 py-2 rounded-lg {{ request('filter') == 'week' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Minggu Ini
                    </a>
                    <a href="{{ route('pengeluaran.index', ['filter' => 'month']) }}"
                       class="px-4 py-2 rounded-lg {{ request('filter') == 'month' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Bulan Ini
                    </a>
                </div>
            </div>

            <!-- Pesan Success -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Pengeluaran -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    @if($pengeluarans->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($pengeluarans as $pengeluaran)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm">
                                            {{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            {{ $pengeluaran->kategori->nama }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            {{ $pengeluaran->keterangan }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-semibold">
                                            Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('pengeluaran.edit', $pengeluaran->id) }}"
                                                   class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                    Edit
                                                </a>
                                                <form action="{{ route('pengeluaran.destroy', $pengeluaran->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                                            onclick="return confirm('Yakin mau hapus?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500">Belum ada pengeluaran.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
