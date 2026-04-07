<!DOCTYPE html>
<html>
<head>
    <title>Login - Pengaduan Sekolah</title>
</head>
<body style="background:#fdf2f8; text-align:center; margin-top:100px; font-family:sans-serif;">

    <h1 style="color:#ec4899;">🌸 Pengaduan Sekolah</h1>
    <p style="color:#666; margin-bottom:5px;">Masuk ke akun Anda</p>
    <p style="color:#999; font-size:14px; max-width:400px; margin:0 auto 20px auto;">Gunakan NIS untuk siswa, atau Nama/Email untuk admin.</p>

    <div style="background:white; max-width:400px; margin:30px auto; padding:30px; border-radius:15px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        @if ($errors->any())
            <div style="background:#fee2e2; color:#dc2626; padding:10px; border-radius:8px; margin-bottom:15px; text-align:left;">
                @foreach ($errors->all() as $error)
                    <p style="margin:5px 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="text-align:left; margin-bottom:15px;">
                <label for="nis" style="display:block; font-weight:bold; margin-bottom:5px; color:#333;">NIS / Nama</label>
                <input type="text" id="nis" name="nis" value="{{ old('nis') }}" required autofocus style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; box-sizing:border-box; font-size:14px;">
            </div>

            <div style="text-align:left; margin-bottom:20px;">
                <label for="password" style="display:block; font-weight:bold; margin-bottom:5px; color:#333;">Password</label>
                <input type="password" id="password" name="password" required style="width:100%; padding:10px; border:1px solid #ddd; border-radius:8px; box-sizing:border-box; font-size:14px;">
            </div>

            <button type="submit" style="background:#ec4899; color:white; padding:12px 30px; border:none; border-radius:8px; font-size:16px; font-weight:bold; cursor:pointer; width:100%; margin-bottom:15px;">
                Login
            </button>
        </form>

        <p style="color:#666; margin:15px 0;">Belum punya akun? <a href="{{ route('register') }}" style="color:#ec4899; text-decoration:none; font-weight:bold;">Daftar di sini</a></p>
    </div>

</body>
</html>
