<x-app-layout>

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Total Pemasukan: Rp {{ number_format($total, 0, ',', '.') }}</h1>
        <a href="{{ route('pemasukan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Pemasukan</a>

        <table class="min-w-full mt-4 border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Keterangan</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemasukan as $item)
                <tr>
                    <td class="px-4 py-2 border">{{ $item->nama }}</td>
                    <td class="px-4 py-2 border">{{ number_format($item->jumlah,0,',','.') }}</td>
                    <td class="px-4 py-2 border">{{ $item->tanggal }}</td>
                    <td class="px-4 py-2 border">{{ $item->keterangan }}</td>
                    <td class="px-4 py-2 border">
                        <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>