<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Pesan Success --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($tracker)
                {{-- Card Target Tracker --}}
                <div class="bg-gradient-to-r from-blue-100 to-blue-200 shadow rounded-lg p-6 mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">
                        {{ $tracker->nama }}
                    </h2>
                    <p class="text-4xl font-bold text-blue-600 mb-2">
                        Rp. {{ number_format($tracker->target, 0, ',', '.') }}
                    </p>
                    <p class="text-red-500 font-medium">
                        {{ $tracker->tanggal_target->format('d F Y') }}
                    </p>
                </div>

                {{-- Progress Bar --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold mb-4">Progress</h3>
                    
                    {{-- Bar Progress --}}
                    <div class="w-full bg-gray-200 rounded-full h-8 mb-2">
                        <div class="bg-blue-600 h-8 rounded-full flex items-center justify-end pr-3"
                             style="width: {{ $tracker->progress }}%">
                            <span class="text-white font-bold text-sm">{{ $tracker->progress }}%</span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-600">
                        Rp. {{ number_format($tracker->terkumpul, 0, ',', '.') }} / 
                        Rp. {{ number_format($tracker->target, 0, ',', '.') }}
                    </p>

                    {{-- Form Tambah Saldo --}}
                    <form method="POST" action="{{ route('tracker.tambah') }}" class="mt-4 flex gap-2">
                        @csrf
                        <input type="number" name="jumlah" placeholder="Masukkan jumlah"
                               class="flex-1 border rounded p-2" min="0" required>
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium">
                            + Tambah Tabungan
                        </button>
                    </form>
                </div>

                {{-- Info Sisa --}}
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 text-sm">Terkumpul</p>
                            <p class="text-2xl font-bold text-green-600">
                                Rp {{ number_format($tracker->terkumpul, 0, ',', '.') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Sisa Target</p>
                            <p class="text-2xl font-bold text-red-600">
                                Rp {{ number_format($tracker->sisa, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Tombol Hapus --}}
                <form method="POST" action="{{ route('tracker.destroy', $tracker) }}" 
                      onsubmit="return confirm('Yakin ingin menghapus tracker ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Hapus Tracker
                    </button>
                </form>

            @else
                {{-- Belum ada tracker --}}
                <div class="bg-white shadow rounded-lg p-12 text-center">
                    <h3 class="text-xl font-bold mb-4">Belum Ada Target Tabungan</h3>
                    <p class="text-gray-600 mb-6">Buat target tabungan pertama kamu sekarang!</p>
                    <a href="{{ route('tracker.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded font-medium inline-block">
                        + Buat Target Baru
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>