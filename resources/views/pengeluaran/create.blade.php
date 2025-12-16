<x-app-layout>
    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mt-2 text-center"><strong>Tambah Pengeluaran</strong></h2>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="p-6">

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                            <div class="flex">
                                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('pengeluaran.store') }}" method="POST">
                        @csrf

                        <!-- Kategori -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Kategori
                            </label>
                            <select name="kategori_id" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B365C] focus:border-transparent @error('kategori_id') border-red-500 @enderror">
                                
                                <option value="">Pilih kategori</option>

                                {{-- Favorit --}}
                                @if($favoriteCategory)
                                    @foreach($kategoris as $kategori)
                                        @if($kategori->nama == $favoriteCategory)
                                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                ★ {{ $kategori->nama }} (Favorit)
                                            </option>
                                        @endif
                                    @endforeach
                                @endif

                                {{-- Kategori lain --}}
                                @foreach($kategoris as $kategori)
                                    @if($kategori->nama != $favoriteCategory)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Keterangan
                            </label>
                            <input type="text"
                                name="keterangan"
                                value="{{ old('keterangan') }}"
                                placeholder="Contoh: Beli pulsa"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B365C] focus:border-transparent @error('keterangan') border-red-500 @enderror">
                            @error('keterangan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nominal -->
                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nominal (Rp)
                            </label>
                            <input type="number"
                                name="nominal"
                                value="{{ old('nominal') }}"
                                placeholder="50000"
                                required
                                min="0"
                                step="1"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B365C] focus:border-transparent @error('nominal') border-red-500 @enderror">
                            @error('nominal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal
                            </label>
                            <input type="date"
                                name="tanggal"
                                value="{{ old('tanggal', date('Y-m-d')) }}"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#1B365C] focus:border-transparent @error('tanggal') border-red-500 @enderror">
                            @error('tanggal')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end gap-3 pt-4">
                            <a href="{{ route('pengeluaran.index') }}"
                            class="px-6 py-2.5 rounded-lg font-medium border border-gray-300 text-gray-700 hover:bg-gray-50 transition text-center">
                                Batal
                            </a>

                            <button type="submit"
                                class="bg-[#1B365C] text-white px-6 py-2.5 rounded-lg font-medium hover:bg-[#152949] transition">
                                Simpan
                            </button>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>