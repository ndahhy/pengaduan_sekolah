<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori - Pengaduan Sekolah</title>
</head>
<body style="background:#fdf2f8; padding:20px; font-family:sans-serif;">

    <div style="max-width:600px; margin:0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <h1 style="color:#ec4899; margin:0;">🏷️ Tambah Kategori</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:#ec4899; color:white; padding:8px 15px; border:none; border-radius:8px; cursor:pointer; font-size:14px;">
                    Logout
                </button>
            </form>
        </div>

        <form action="{{ route('kategori.store') }}" method="POST" style="background:white; padding:30px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1); display:flex; flex-direction:column; gap:15px;">
            @csrf

            @if ($errors->any())
                <div style="background:#fee2e2; color:#dc2626; padding:12px; border-radius:8px;">
                    @foreach ($errors->all() as $error)
                        <p style="margin:5px 0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div>
                <label for="nama_kategori" style="display:block; font-weight:bold; margin-bottom:8px; color:#333;">Nama Kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori" placeholder="Masukkan nama kategori" value="{{ old('nama_kategori') }}" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px; box-sizing:border-box; font-size:14px;">
            </div>

            <div style="display:flex; gap:10px;">
                <button type="submit" style="background:#ec4899; color:white; padding:12px 30px; border:none; border-radius:8px; cursor:pointer; font-weight:bold; flex:1;">
                    Simpan Kategori
                </button>
                <a href="{{ route('kategori.index') }}" style="background:#999; color:white; padding:12px 30px; border:none; border-radius:8px; text-decoration:none; font-weight:bold; text-align:center; flex:1;">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>
