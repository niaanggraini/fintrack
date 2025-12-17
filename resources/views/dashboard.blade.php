<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- HEADER --}}
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Dashboard</h1>

                <button
                    onclick="document.getElementById('modal').classList.remove('hidden')"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    ➕ Input Transaksi
                </button>
            </div>

            {{-- CARD RINGKASAN --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded shadow">
                    <p class="text-gray-500">Saldo Akhir</p>
                    <p class="text-xl font-bold">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <p class="text-gray-500">Jumlah Transaksi</p>
                    <p class="text-xl font-bold">
                        {{ $count }}
                    </p>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <p class="text-gray-500">Rata-rata Transaksi</p>
                    <p class="text-xl font-bold">
                        Rp {{ number_format($rata, 0, ',', '.') }}
                    </p>
                </div>
            </div>

            {{-- TRANSAKSI TERBARU --}}
            <div class="bg-white p-6 rounded shadow">
                <h2 class="font-bold mb-4">Transaksi Terbaru</h2>

                @if ($transaksiTerbaru->isEmpty())
                    <p class="text-gray-400">Belum ada transaksi</p>
                @else
                    <ul class="divide-y">
                        @foreach ($transaksiTerbaru as $trx)
                            <li class="py-3 flex justify-between items-center">
                                <div>
                                    <p class="font-medium">{{ $trx->keterangan }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($trx->tanggal)->format('d M Y') }}
                                    </p>
                                </div>

                                <div class="font-semibold">
                                    Rp {{ number_format($trx->nominal, 0, ',', '.') }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>

    {{-- MODAL INPUT TRANSAKSI --}}
    <div id="modal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">

        <div class="bg-white w-full max-w-md rounded-lg p-6">
            <h2 class="text-lg font-bold mb-4">Input Transaksi</h2>

            <form method="POST" action="{{ route('transaksi.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="block">Tanggal</label>
                    <input type="date" name="tanggal"
                        class="w-full border rounded p-2"
                        value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="mb-3">
                    <label class="block">Keterangan</label>
                    <input type="text" name="keterangan"
                        class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block">Nominal</label>
                    <input type="number" name="nominal"
                        class="w-full border rounded p-2"
                        min="0" step="0.01" required>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button"
                        onclick="document.getElementById('modal').classList.add('hidden')"
                        class="px-4 py-2 border rounded">
                        Batal
                    </button>

                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

{{-- AUTO CLOSE MODAL JIKA BERHASIL --}}
@if (session('success'))
<script>
    document.getElementById('modal')?.classList.add('hidden');
</script>
@endif
