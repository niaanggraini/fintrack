<x-guest-layout>
    <div class="auth-card">

        <h1 class="auth-title">Daftar</h1>
        <p class="auth-subtitle">Buat akun baru</p>

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <input
                type="text"
                name="name"
                placeholder="Nama Lengkap"
                value="{{ old('name') }}"
                required
                class="auth-input"
            >

            <input
                type="email"
                name="email"
                placeholder="Email"
                value="{{ old('email') }}"
                required
                class="auth-input"
            >

            <input
                type="password"
                name="password"
                placeholder="Kata Sandi (Min. 5 karakter)"
                required
                class="auth-input"
            >

            <input
                type="password"
                name="password_confirmation"
                placeholder="Konfirmasi Kata Sandi"
                required
                class="auth-input"
            >

            <button type="submit" class="auth-button">
                Daftar
            </button>
        </form>

        <div class="text-center mt-6">
            Sudah Memiliki Akun? 
            <a href="{{ route('login') }}" class="auth-link">
                Masuk
            </a>
        </div>

    </div>
</x-guest-layout>
