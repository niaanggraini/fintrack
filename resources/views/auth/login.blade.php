<x-guest-layout>
    <div class="auth-card">

        <h1 class="auth-title">Login</h1>
        <p class="auth-subtitle">Masuk ke akun kamu</p>

        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                placeholder="Password"
                required
                class="auth-input"
            >

            <button type="submit" class="auth-button">
                Login
            </button>
        </form>

        <div class="text-center mt-6">
            Don’t have an account? 
            <a href="{{ route('register') }}" class="auth-link">
                Register
            </a>
        </div>

    </div>
</x-guest-layout>
