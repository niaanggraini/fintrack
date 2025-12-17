<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTrack - @yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .navbar {
            background-color: #1e3a5f;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            text-decoration: none;
        }

        .logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border-radius: 4px;
        }

        .navbar-menu {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .navbar-menu a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-bottom: 3px solid transparent;
            transition: border-color 0.3s;
        }

        .navbar-menu a.active {
            border-bottom-color: white;
        }

        .user-menu {
            background-color: white;
            color: #1e3a5f;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            background-color: #1e3a5f;
            border-radius: 50%;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5px
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        .alert {
            padding: 1rem 1.5rem;
            margin: 1.5rem 0; /* jarak atas-bawah */
            border-radius: 8px;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* biar sedikit mengambang */
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }

        /* opsional: fade out otomatis setelah beberapa detik */
        .alert.fade-out {
            opacity: 0;
            transform: translateY(-10px);
        }

        @yield('styles')
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Fintrack Logo" class="logo">
            FinTrack
        </a>
        <ul class="navbar-menu">
            <li>
                <a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('dompet.index') }}"
                class="{{ request()->routeIs('dompet.*') ? 'active' : '' }}">
                Dompet
                </a>
            </li>

            <li>
                <a href="{{ route('tabungan.index') }}"
                class="{{ request()->routeIs('tabungan.*') ? 'active' : '' }}">
                Tabungan
                </a>
            </li>
        </ul>

         <a href="{{ route('profile.index') }}" class="user-menu">
            <div class="user-avatar"></div>
            <span>{{ Auth::user()->name }}</span>
        </a>

    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>