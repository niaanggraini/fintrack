<x-app-layout>
    <style>
        .tabungan-card {
            display: block;
            background-color: #DAE6F8;
            padding: 2rem;
            border-radius: 12px;
            color: #2F2F2F;
            margin-bottom: 2rem;
            max-width: 100%;
        }

        .tabungan-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #2F2F2F;
        }

        .tabungan-amount {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #2F2F2F;
        }

        .tabungan-date {
            display: inline-block;
            background-color: rgba(255, 107, 107, 0.9);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
            color: white;
        }

        .progress-section {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .progress-section h3 {
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .progress-bar-container {
            position: relative;
            width: 100%;
            height: 30px;
            background-color: #DAE6F8;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 0.5rem;
        }

        .progress-bar-fill {
            height: 100%;
            background-color: #1B365C;
            border-radius: 15px;
            transition: width 0.3s ease;
        }

        .progress-percentage {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 600;
            color: #333;
        }

        .progress-text {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .btn-add {
            background-color: #1B365C;
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            float: right;
            text-decoration: none;
            display: inline-block;
        }

        .btn-add:hover {
            background-color: #152d47;
        }

        .histori-section {
            clear: both;
            padding-top: 2rem;
        }

        .histori-section h3 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .search-box {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .search-box input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .btn-search {
            background-color: #1B365C;
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
        }

        .histori-table {
            width: 100%;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .histori-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .histori-table th {
            background-color: #f8f9fa;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #e0e0e0;
        }

        .histori-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            color: #666;
        }

        .histori-table tr:last-child td {
            border-bottom: none;
        }

        .no-data {
            text-align: center;
            padding: 3rem;
            color: #999;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .empty-state h2 {
            color: #333;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 2rem;
        }

        .btn-primary {
            background-color: #1e3a5f;
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
        }

        /* Alert Styles */
        .alert {
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .alert-success {
            background-color: #d4edda;
            border: 2px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 2px solid #f5c6cb;
            color: #721c24;
        }

        .alert-content {
            flex: 1;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .alert-icon {
            font-size: 1.5rem;
            margin-right: 1rem;
        }
    </style>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Session Messages --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <div style="display: flex; align-items: center;">
                        <span class="alert-icon">✅</span>
                        <div class="alert-content">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <div style="display: flex; align-items: center;">
                        <span class="alert-icon">⚠️</span>
                        <div class="alert-content">{{ session('error') }}</div>
                    </div>
                </div>
            @endif

            @if($tabungan)
                
                {{-- Alert Target Tercapai --}}
                @if($tabungan->saldo_terkini >= $tabungan->target_tabungan)
                    <div class="alert alert-success">
                        <div style="display: flex; align-items: center; flex: 1;">
                            <span class="alert-icon">🎉</span>
                            <div class="alert-content">
                                Selamat! Target tabungan tercapai! Hapus tabungan ini untuk membuat yang baru.
                            </div>
                        </div>
                        <form action="{{ route('tabungan.destroy', $tabungan->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Yakin ingin menghapus tabungan ini? Histori akan ikut terhapus.')">
                                Hapus & Buat Tabungan Baru
                            </button>
                        </form>
                    </div>
                @endif

                <div class="tabungan-card">
                    <div class="tabungan-title">{{ $tabungan->nama_tabungan }}</div>
                    <div class="tabungan-amount">Rp. {{ number_format($tabungan->target_tabungan, 0, ',', '.') }}</div>
                    <span class="tabungan-date">{{ $tabungan->target_tanggal->format('d F Y') }}</span>
                </div>

                <div class="progress-section">
                    <h3>Progress</h3>
                    <div class="progress-bar-container">
                        <div class="progress-bar-fill" style="width: {{ $tabungan->progress_percentage }}%"></div>
                        <span class="progress-percentage">{{ $tabungan->progress_percentage }}%</span>
                    </div>
                    <p class="progress-text">
                        Rp. {{ number_format($tabungan->saldo_terkini, 0, ',', '.') }}/Rp. {{ number_format($tabungan->target_tabungan, 0, ',', '.') }}
                    </p>
                    
                    {{-- Button tambah tabungan (disabled kalo udah tercapai) --}}
                    @if($tabungan->saldo_terkini >= $tabungan->target_tabungan)
                        <button class="btn-add" style="background-color: #6c757d; cursor: not-allowed;" disabled>
                            Target Tercapai
                        </button>
                    @else
                        <a href="{{ route('tabungan.add-history', $tabungan->id) }}" class="btn-add">+ Tambah tabungan</a>
                    @endif
                </div>

                <div class="histori-section">
                    <h3>Histori Tabungan</h3>
                    
                    <form action="{{ route('tabungan.index') }}" method="GET" class="search-box">
                        <input type="text" name="search" placeholder="Cari histori tabunganmu..." value="{{ request('search') }}">
                        <button type="submit" class="btn-search">Cari</button>
                    </form>

                    <div class="histori-table">
                        @if($histori->count() > 0)
                            <table>
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($histori as $item)
                                    <tr>
                                        <td>{{ $item->tanggal->format('d M Y') }}</td>
                                        <td>{{ $item->nominal >= 0 ? '+' : '' }} Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                        <td>{{ $item->catatan }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="no-data">
                                <p>Belum ada histori tabungan</p>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <h2>Belum Ada Tabungan</h2>
                    <p>Mulai dengan membuat goal tabungan pertama kamu!</p>
                    <a href="{{ route('tabungan.create') }}" class="btn-primary">Buat Tabungan Baru</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>