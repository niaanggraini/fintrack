<x-guest-layout>
    <div class="auth-card">

        <h1 class="auth-title">Register</h1>
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
                placeholder="Full Name"
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
                placeholder="Password (Min. 5 characters)"
                required
                class="auth-input"
            >

            <input
                type="password"
                name="password_confirmation"
                placeholder="Confirm Password"
                required
                class="auth-input"
            >

            <button type="submit" class="auth-button">
                Register
            </button>
        </form>

        <div class="text-center mt-6">
            Already have an account? 
            <a href="{{ route('login') }}" class="auth-link">
                Login
            </a>
        </div>

    </div>
</x-guest-layout>
