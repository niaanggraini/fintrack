<x-app-layout>

@section('title', 'Edit Pengeluaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">

        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-3xl font-bold text-gray-800">✏️ Edit Pengeluaran</h2>
            <p class="text-gray-600 mt-2">Ubah data pengeluaran di bawah</p>
        </div>

        <!-- Error Summary -->
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <p class="font-bold">❌ Oops! Ada yang salah:</p>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form -->
        <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Kategori -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Kategori</label>
                <select name="kategori_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg
                        focus:outline-none focus:ring-2 focus:ring-blue-500
                        @error('kategori_id') border-red-500 @enderror">

                    <option value="">-- Pilih Kategori --</option>

                    {{-- Favorit --}}
                    @if($favoriteCategory)
                        @foreach($kategoris as $kategori)
                            @if($kategori->nama == $favoriteCategory)
                            <option value="{{ $kategori->id }}"
                                {{ $pengeluaran->kategori_id == $kategori->id ? 'selected' : '' }}>
                                ⭐ {{ $kategori->nama }} (Favorit)
                            </option>
                            @endif
                        @endforeach
                    @endif

                    {{-- Kategori lain --}}
                    @foreach($kategoris as $kategori)
                        @if($kategori->nama != $favoriteCategory)
                        <option value="{{ $kategori->id }}"
                            {{ $pengeluaran->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                        @endif
                    @endforeach
                </select>

                @error('kategori_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Keterangan</label>
                <input type="text"
                       name="keterangan"
                       value="{{ old('keterangan', $pengeluaran->keterangan) }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg
                       focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('keterangan') border-red-500 @enderror">
                @error('keterangan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nominal -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Nominal (Rp)</label>
                <input type="number"
                       name="nominal"
                       value="{{ old('nominal', $pengeluaran->nominal) }}"
                       required
                       min="0"
                       step="0.01"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg
                       focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('nominal') border-red-500 @enderror">
                @error('nominal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
                <input type="date"
                       name="tanggal"
                       value="{{ old('tanggal', $pengeluaran->tanggal) }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg
                       focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('tanggal') border-red-500 @enderror">
                @error('tanggal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex space-x-3">
                <button type="submit"
                        class="flex-1 bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 font-semibold">
                    💾 Update
                </button>
                <a href="{{ route('pengeluaran.index') }}"
                   class="flex-1 bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-semibold text-center">
                    ❌ Batal
                </a>
            </div>

        </form>
    </div>
</div>
@endsection

</x-app-layout>
