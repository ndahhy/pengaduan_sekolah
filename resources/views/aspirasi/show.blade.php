<!DOCTYPE html>
<html>
<head>
    <title>{{ $data->judul }} - Pengaduan Sekolah</title>
</head>
<body style="background:#fdf2f8; padding:20px; font-family:sans-serif;">

    <div style="max-width:800px; margin:0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <a href="/aspirasi" style="color:#ec4899; text-decoration:none; font-weight:bold; font-size:18px;">← Kembali ke Aspirasi</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" style="background:#ec4899; color:white; padding:8px 15px; border:none; border-radius:8px; cursor:pointer; font-size:14px;">
                    Logout
                </button>
            </form>
        </div>

        <div style="background:white; padding:30px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <h1 style="color:#ec4899; margin:0 0 20px 0; font-size:28px;">{{ $data->judul }}</h1>

            <p style="color:#666; line-height:1.6; margin:0 0 20px 0; font-size:16px;">{{ $data->isi }}</p>

            <div style="background:#f3f4f6; padding:15px; border-radius:8px; margin:20px 0;">
                <div style="display:flex; gap:30px; flex-wrap:wrap;">
                    <div>
                        <strong style="color:#333;">Tanggal:</strong>
                        <p style="color:#666; margin:5px 0;">{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y H:i') }}</p>
                    </div>
                    <div>
                        <strong style="color:#333;">Lokasi:</strong>
                        <p style="color:#666; margin:5px 0;">{{ $data->lokasi ?? 'Tidak diisi' }}</p>
                    </div>
                    <div>
                        <strong style="color:#333;">Kategori:</strong>
                        <p style="color:#666; margin:5px 0;">{{ $data->kategori->nama_kategori }}</p>
                    </div>
                    <div>
                        <strong style="color:#333;">Status:</strong>
                        <p style="color:#ec4899; margin:5px 0; font-weight:bold;">{{ ucfirst($data->status) }}</p>
                    </div>
                </div>
            </div>

            @if($data->ket)
            <div style="background:#eef2ff; padding:15px; border-radius:8px; margin-bottom:20px;">
                <strong style="color:#333;">Keterangan:</strong>
                <p style="color:#666; margin:10px 0;">{{ $data->ket }}</p>
            </div>
            @endif

            @if($data->feedback)
            <div style="background:#fce7f3; padding:15px; border-radius:8px; border-left:4px solid #ec4899; margin:20px 0;">
                <strong style="color:#ec4899;">💬 Feedback dari Admin:</strong>
                <p style="margin:10px 0; color:#666; line-height:1.5;">{{ $data->feedback->isi_feedback }}</p>
            </div>
            @else
            <div style="background:#e5e7eb; padding:15px; border-radius:8px; margin:20px 0;">
                <p style="color:#666; margin:0;">Belum ada feedback dari admin.</p>
            </div>
            @endif
        </div>
    </div>

</body>
</html>