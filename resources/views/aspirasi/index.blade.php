<!DOCTYPE html>
<html>
<head>
    <title>Aspirasi Saya - Pengaduan Sekolah</title>
</head>
<body style="background:#fdf2f8; padding:20px; font-family:sans-serif;">

    <div style="max-width:800px; margin:0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <div>
                <h1 style="color:#ec4899; margin:0;">🌸 Histori Aspirasi</h1>
                <p style="color:#6b7280; margin:5px 0 0 0;">Lihat status, feedback, dan detail perbaikan aspirasi.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:#ec4899; color:white; padding:8px 15px; border:none; border-radius:8px; cursor:pointer; font-size:14px;">
                    Logout
                </button>
            </form>
        </div>

        <a href="/aspirasi/create" style="background:#ec4899; color:white; padding:12px 20px; border-radius:8px; text-decoration:none; display:inline-block; margin-bottom:20px; font-weight:bold;">
            + Tambah Aspirasi
        </a>

        <div style="display:flex; flex-direction:column; gap:15px;">
            @foreach($data as $a)
            <div style="background:white; padding:20px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                <h3 style="color:#ec4899; margin:0 0 10px 0; font-size:18px;">{{ $a->judul }}</h3>
                <p style="color:#666; margin:0 0 10px 0; line-height:1.5;">{{ $a->isi }}</p>
                
                <div style="display:flex; gap:20px; margin:10px 0; font-size:13px; flex-wrap:wrap;">
                    <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($a->tanggal)->format('d-m-Y H:i') }}</div>
                    <div><strong>Lokasi:</strong> {{ $a->lokasi ?? 'Tidak diisi' }}</div>
                    <div><strong>Kategori:</strong> {{ $a->kategori->nama_kategori }}</div>
                    <div><strong>Status:</strong> 
                        <span style="color:#ec4899; font-weight:bold;">{{ ucfirst($a->status) }}</span>
                    </div>
                </div>

                @if($a->feedback)
                <div style="background:#fce7f3; padding:10px; border-radius:8px; margin:10px 0; border-left:4px solid #ec4899;">
                    <strong style="color:#ec4899;">💬 Feedback:</strong><br>
                    <p style="margin:5px 0; color:#666;">{{ $a->feedback->isi_feedback }}</p>
                </div>
                @endif

                <div style="display:flex; gap:10px; margin-top:15px;">
                    <a href="/aspirasi/{{ $a->id }}" style="color:#3b82f6; text-decoration:none; font-weight:bold;">Detail</a>
                    <span style="color:#ccc;">|</span>
                    <a href="/aspirasi/{{ $a->id }}/edit" style="color:#f59e0b; text-decoration:none; font-weight:bold;">Edit</a>
                    <span style="color:#ccc;">|</span>
                    <form action="/aspirasi/{{ $a->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:#ef4444; text-decoration:none; font-weight:bold; background:none; border:none; cursor:pointer; padding:0;">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        @if(count($data) == 0)
        <div style="text-align:center; padding:40px; background:white; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <p style="color:#999; font-size:16px;">Belum ada aspirasi. <a href="/aspirasi/create" style="color:#ec4899; text-decoration:none; font-weight:bold;">Buat sekarang</a></p>
        </div>
        @endif
    </div>

</body>
</html>