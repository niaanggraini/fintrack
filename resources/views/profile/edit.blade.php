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
        
        .navbar {
            background-color: #1e3a5f;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        
        .navbar-left {
            display: flex;
            …
[4:54 PM, 12/17/2025] nadiaa sayank: view edit profile :
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - FinTrack</title>
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
        
        .navbar {
            background-color: #1e3a5f;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }
        
        .navbar-left {
            display: flex;
            align-items: center;
            gap: 40px;
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
            gap: 30px;
        }
        
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 14px;
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
        }
        
        .user-icon {
            width: 25px;
            height: 25px;
            background-color: #1e3a5f;
            border-radius: 50%;
        }
        
        .container {
            max-width: 650px;
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
        
        .form-content {
            display: flex;
            gap: 30px;
        }
        
        .profile-photo-section {
            flex-shrink: 0;
        }
        
        .profile-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #9BB8D3;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            cursor: pointer;
        }
        
        .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .form-fields {
            flex: 1;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
            color: #333;
        }
        
        .required {
            color: red;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d1d1;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #1e3a5f;
        }
        
        .address-section h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        
        .address-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .btn-back {
            background-color: #d1d1d1;
            color: #333;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-save {
            background-color: #1e3a5f;
            color: white;
        }
        
        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        #photo-upload {
            display: none;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-left">
            <div class="logo">
                <div class="logo-icon"></div>
                <span>FinTrack</span>
            </div>
            <div class="nav-links">
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <a href="{{ url('/dompet') }}">Dompet</a>
                <a href="{{ url('/tabungan') }}">Tabungan</a>
            </div>
        </div>
        <div class="navbar-right">
            <div class="user-icon"></div>
            <span>User</span>
        </div>
    </nav>

    <div class="container">
        <div class="profile-header">
            <div class="profile-header-icon"></div>
            <h2>Profile</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-content">
                <div class="profile-photo-section">
                    <div class="profile-photo" onclick="document.getElementById('photo-upload').click()">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile" id="preview-photo">
                        @else
                            <img src="" alt="" id="preview-photo" style="display: none;">
                        @endif
                    </div>
                    <input type="file" id="photo-upload" name="profile_photo" accept="image/*" onchange="previewImage(event)">
                </div>

                <div class="form-fields">
                    <div class="form-group">
                        <label>Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat Email <span class="required">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Nomor Telepon <span class="required">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required>
                    </div>
                </div>
            </div>

            <div class="address-section">
                <h3>Alamat Domisili</h3>
                
                <div class="address-row">
                    <div class="form-group">
                        <label>Negara</label>
                        <input type="text" name="negara" value="{{ old('negara', $user->negara) }}">
                    </div>
                    <div class="form-group">
                        <label>Kota</label>
                        <input type="text" name="kota" value="{{ old('kota', $user->kota) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $user->alamat) }}">
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('profile.index') }}" class="btn btn-back">
                    ← Kembali
                </a>
                <button type="submit" class="btn btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-photo');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>