<x-app-layout>
    <style>
        .form-container {
            max-width: 700px;
            margin: 2rem auto;
            background-color: white;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .form-header h2 {
            font-size: 1.5rem;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group label .required {
            color: #dc3545;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1e3a5f;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
        }

        .input-with-prefix {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .input-with-prefix span {
            padding: 0.75rem;
            background-color: #f8f9fa;
            color: #666;
            border-right: 1px solid #ddd;
        }

        .input-with-prefix input {
            border: none;
            flex: 1;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #d0d0d0;
        }

        .btn-primary {
            background-color: #1e3a5f;
            color: white;
        }

        .btn-primary:hover {
            background-color: #152d47;
        }

        .error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="form-container">
                <div class="form-header">
                    <h2>💰 Tambah Tabungan</h2>
                </div>

                <form action="{{ route('tabungan.store-history', $tabungan->id) }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Nominal Tabungan <span class="required">*</span></label>
                        <div class="input-with-prefix">
                            <span>Rp</span>
                            <input type="number" name="nominal" placeholder="0" value="{{ old('nominal') }}" required>
                        </div>
                        @error('nominal')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal <span class="required">*</span></label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        @error('tanggal')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Catatan <span class="required">*</span></label>
                        <input type="text" name="catatan" placeholder="Contoh: Gajian" value="{{ old('catatan') }}" required>
                        @error('catatan')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('tabungan.index') }}" class="btn btn-secondary">← Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Tabungan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>