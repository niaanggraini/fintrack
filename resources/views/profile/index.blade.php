<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - FinTrack</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }
        
        /* NAVBAR - LOGO KIRI, MENU TENGAH, USER KANAN */
        .navbar {
            background-color: #1e3a5f;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 600;
        }
        
        .logo-icon {
            width: 30px;
            height: 30px;
            background-color: white;
            border-radius: 4px;
        }
        
        .nav-links {
            display: flex;
            gap: 40px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            padding-bottom: 5px;
            border-bottom: 2px solid transparent;
        }
        
        .nav-links a.active {
            border-bottom: 2px solid white;
        }
        
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: white;
            padding: 8px 15px;
            border-radius: 8px;
            color: #1e3a5f;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        
        .navbar-right:hover {
            opacity: 0.9;
        }
        
        .user-icon {
            width: 25px;
            height: 25px;
            background-color: #1e3a5f;
            border-radius: 50%;
        }
        
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .profile-header-icon {
            width: 24px;
            height: 24px;
            border: 2px solid #333;
            border-radius: 50%;
        }
        
        .profile-header h2 {
            font-size: 18px;
            font-weight: 600;
        }
        
        .profile-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 25px;
        }
        
        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #9BB8D3;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .user-name {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }
        
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 220px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            transition: opacity 0.2s;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .btn-edit {
            background-color: #d1d1d1;
            color: #333;
        }
        
        .btn-logout {
            background-color: #1e3a5f;
            color: white;
        }
    </style>
</head>
<body>
    <!-- NAVBAR: LOGO KIRI - MENU TENGAH - USER KANAN -->
    <nav class="navbar">
        <!-- LOGO KIRI -->
        <div class="logo">
            <div class="logo-icon"></div>
            <span>FinTrack</span>
        </div>
        
        <!-- MENU TENGAH -->
        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('pengeluaran.index') }}">Pengeluaran</a>
            <a href="#">Tabungan</a>
        </div>
        
        <!-- USER KANAN -->
        <a href="{{ route('profile.index') }}" class="navbar-right">
            <div class="user-icon"></div>
            <span>{{ Auth::user()->name }}</span>
        </a>
    </nav>

    <!-- PROFILE CONTENT -->
    <div class="container">
        <div class="profile-header">
            <div class="profile-header-icon"></div>
            <h2>Profile</h2>
        </div>

        <div class="profile-content">
            <div class="profile-photo">
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo">
                @endif
            </div>

            <div class="user-name">{{ $user->name }}</div>

            <div class="button-group">
                <a href="{{ route('profile.edit') }}" class="btn btn-edit">Edit Profile</a>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-logout" style="width: 100%;">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>