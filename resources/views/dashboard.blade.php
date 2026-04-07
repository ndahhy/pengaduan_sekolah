<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Pengaduan Sekolah</title>
</head>
<body style="background:#fdf2f8; text-align:center; margin-top:50px; font-family:sans-serif;">

    <div style="position:absolute; top:20px; right:30px;">
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" style="background:#ec4899; color:white; padding:8px 15px; border:none; border-radius:8px; cursor:pointer; font-size:14px;">
                Logout
            </button>
        </form>
    </div>

    <h1 style="color:#ec4899; margin:20px 0;">🌸 Dashboard</h1>
    <p style="color:#666; margin-bottom:30px;">Selamat datang, {{ Auth::user()->name }}!</p>

    <div style="display:flex; gap:20px; justify-content:center; flex-wrap:wrap; max-width:600px; margin:0 auto;">

        <a href="/aspirasi" style="background:white; color:#333; padding:30px; border-radius:15px; box-shadow:0 2px 10px rgba(0,0,0,0.1); text-decoration:none; flex:1; min-width:150px; transition:transform 0.3s;">
            <div style="font-size:40px; margin-bottom:10px;">📩</div>
            <h2 style="color:#ec4899; margin:10px 0; font-size:18px;">Aspirasi</h2>
            <p style="color:#666; font-size:14px;">Lihat & kirim aspirasi</p>
        </a>

        @if(Auth::user()->role === 'admin')
        <a href="/admin" style="background:#ec4899; color:white; padding:30px; border-radius:15px; box-shadow:0 2px 10px rgba(0,0,0,0.1); text-decoration:none; flex:1; min-width:150px; transition:transform 0.3s;">
            <div style="font-size:40px; margin-bottom:10px;">👨‍💼</div>
            <h2 style="margin:10px 0; font-size:18px;">Admin</h2>
            <p style="font-size:14px;">Kelola data aspirasi</p>
        </a>
        @endif

    </div>

</body>
</html>