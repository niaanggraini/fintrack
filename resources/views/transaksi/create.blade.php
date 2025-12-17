<x-app-layout>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6">

                    <h1 class="text-xl font-bold mb-4">
                        Buat Target Tabungan Baru
                    </h1>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tracker.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Nama Target</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                   placeholder="Misal: Tabung untuk konser"
                                   class="w-full border rounded p-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Target Nominal</label>
                            <input type="number" name="target" value="{{ old('target') }}"
                                   placeholder="5000000"
                                   class="w-full border rounded p-2" min="0" step="1000" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">Tanggal Target</label>
                            <input type="date" name="tanggal_target" value="{{ old('tanggal_target') }}"
                                   class="w-full border rounded p-2" required>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                Buat Target
                            </button>
                            
                            <a href="{{ route('tracker.index') }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
