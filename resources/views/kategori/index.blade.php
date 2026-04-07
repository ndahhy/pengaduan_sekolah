<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kategori - Pengaduan Sekolah</title>
</head>
<body style="background:#fdf2f8; padding:20px; font-family:sans-serif;">

    <div style="max-width:800px; margin:0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <h1 style="color:#ec4899; margin:0;">🏷️ Manajemen Kategori</h1>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:#ec4899; color:white; padding:8px 15px; border:none; border-radius:8px; cursor:pointer; font-size:14px;">
                    Logout
                </button>
            </form>
        </div>

        <div style="text-align:left; margin-bottom:20px;">
            <a href="{{ route('kategori.create') }}" style="background:#ec4899; color:white; padding:12px 20px; border-radius:8px; text-decoration:none; display:inline-block; font-weight:bold;">
                + Tambah Kategori
            </a>
            <a href="/admin" style="background:#666; color:white; padding:12px 20px; border-radius:8px; text-decoration:none; display:inline-block; font-weight:bold; margin-left:10px;">
                ← Kembali ke Admin
            </a>
        </div>

        @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:12px; border-radius:8px; margin-bottom:20px; border-left:4px solid #10b981;">
            {{ session('success') }}
        </div>
        @endif

        <div style="background:white; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1); overflow:hidden;">
            @if(count($data) > 0)
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#f3f4f6; border-bottom:2px solid #ddd;">
                        <th style="padding:15px; text-align:left; color:#333; font-weight:bold;">No</th>
                        <th style="padding:15px; text-align:left; color:#333; font-weight:bold;">Nama Kategori</th>
                        <th style="padding:15px; text-align:center; color:#333; font-weight:bold;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:15px; color:#666;">{{ $loop->iteration }}</td>
                        <td style="padding:15px; color:#666;">{{ $k->nama_kategori }}</td>
                        <td style="padding:15px; text-align:center;">
                            <a href="{{ route('kategori.edit', $k->id) }}" style="color:#f59e0b; text-decoration:none; font-weight:bold; margin-right:10px;">Edit</a>
                            <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color:#ef4444; background:none; border:none; cursor:pointer; text-decoration:none; font-weight:bold;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div style="padding:40px; text-align:center;">
                <p style="color:#999; font-size:16px;">Belum ada kategori. <a href="{{ route('kategori.create') }}" style="color:#ec4899; text-decoration:none; font-weight:bold;">Buat sekarang</a></p>
            </div>
            @endif
        </div>
    </div>

</body>
</html>
