<!DOCTYPE html>
<html>
<head>
<title>Splash</title>
</head>
<body style="background:#fdf2f8; text-align:center; margin-top:150px; font-family:sans-serif;">

<h1 style="color:#ec4899;">🌸 Pengaduan Sekolah</h1>
<p>Sampaikan aspirasi dengan mudah</p>

<br>

@guest
    <a href="{{ route('register') }}" style="background:#ec4899; color:white; padding:10px 20px; border-radius:10px;">
        Register
    </a>

    <a href="{{ route('login') }}" style="margin-left:10px;">Login</a>
@endguest

@auth
    <a href="{{ route('dashboard') }}" style="background:#ec4899; color:white; padding:10px 20px; border-radius:10px;">
        Dashboard
    </a>
@endauth

</body>
</html>