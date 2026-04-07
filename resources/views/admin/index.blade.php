<!DOCTYPE html>
<html>
<head>
    <title>Admin - Pengaduan Sekolah</title>
</head>
<body style="background:#fdf2f8; padding:20px; font-family:sans-serif;">

    <div style="max-width:900px; margin:0 auto;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
            <h1 style="color:#ec4899; margin:0;">🌸 Dashboard Admin</h1>
            <div style="display:flex; gap:10px;">
                <a href="{{ route('kategori.index') }}" style="background:#10b981; color:white; padding:8px 15px; border:none; border-radius:8px; text-decoration:none; cursor:pointer; font-size:14px; font-weight:bold;">
                    🏷️ Manajemen Kategori
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:#ec4899; color:white; padding:8px 15px; border:none; border-radius:8px; cursor:pointer; font-size:14px;">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <form method="GET" style="display:flex; gap:10px; margin-bottom:20px; flex-wrap:wrap; align-items:center;">
            <input type="search" name="keyword" placeholder="Cari judul aspirasi..." value="{{ request('keyword') }}" style="padding:10px; border:1px solid #ddd; border-radius:8px; font-size:14px; min-width:220px;">

            <select name="kategori_id" style="padding:10px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
                <option value="">Semua Kategori</option>
                @foreach($kategori as $k)
                <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                @endforeach
            </select>

            <select name="user_id" style="padding:10px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
                <option value="">Semua Siswa</option>
                @foreach($users as $u)
                <option value="{{ $u->id }}" {{ request('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>

            <input type="date" name="tanggal" style="padding:10px; border:1px solid #ddd; border-radius:8px; font-size:14px;" placeholder="Tanggal" value="{{ request('tanggal') }}">

            <select name="bulan" style="padding:10px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
                <option value="">Semua Bulan</option>
                @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                </option>
                @endforeach
            </select>

            <select name="tahun" style="padding:10px; border:1px solid #ddd; border-radius:8px; font-size:14px;">
                <option value="">Semua Tahun</option>
                @foreach(range(date('Y')-2, date('Y')) as $y)
                <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>

            <button type="submit" style="background:#ec4899; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; font-weight:bold;">
                Filter
            </button>
            <a href="{{ url()->current() }}" style="background:#9ca3af; color:white; padding:10px 20px; border:none; border-radius:8px; text-decoration:none; display:inline-flex; align-items:center; justify-content:center; font-weight:bold;">
                Reset
            </a>
        </form>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:15px; margin-bottom:20px;">
            <div style="background:white; padding:20px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size:14px; color:#6b7280;">Total Aspirasi</div>
                <div style="font-size:28px; font-weight:bold; color:#ec4899;">{{ $data->count() }}</div>
            </div>
            <div style="background:white; padding:20px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size:14px; color:#6b7280;">Pending</div>
                <div style="font-size:28px; font-weight:bold; color:#f59e0b;">{{ $data->where('status','pending')->count() }}</div>
            </div>
            <div style="background:white; padding:20px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size:14px; color:#6b7280;">Proses</div>
                <div style="font-size:28px; font-weight:bold; color:#10b981;">{{ $data->where('status','proses')->count() }}</div>
            </div>
            <div style="background:white; padding:20px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                <div style="font-size:14px; color:#6b7280;">Selesai</div>
                <div style="font-size:28px; font-weight:bold; color:#3b82f6;">{{ $data->where('status','selesai')->count() }}</div>
            </div>
        </div>

        <div style="display:flex; flex-direction:column; gap:15px;">
            @foreach($data as $a)
            <div style="background:white; padding:20px; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                <h3 style="color:#ec4899; margin:0 0 10px 0; font-size:18px;">{{ $a->judul }}</h3>
                <p style="color:#666; margin:0 0 10px 0; line-height:1.5;">{{ $a->isi }}</p>
                
                <div style="display:flex; gap:20px; margin:10px 0; font-size:14px; flex-wrap:wrap;">
                    <div><strong>Siswa:</strong> {{ $a->user->name }}</div>
                    <div><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($a->tanggal)->format('d-m-Y H:i') }}</div>
                    <div><strong>Status:</strong> <span style="color:#ec4899; font-weight:bold;">{{ $a->status }}</span></div>
                </div>

                <form action="/admin/status/{{ $a->id }}" method="POST" style="margin:15px 0; display:flex; gap:10px;">
                    @csrf
                    <select name="status" style="padding:8px; border:1px solid #ddd; border-radius:6px; font-size:14px;">
                        <option value="pending" {{ $a->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ $a->status == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" style="background:#f59e0b; color:white; padding:8px 15px; border:none; border-radius:6px; cursor:pointer; font-weight:bold;">
                        Update Status
                    </button>
                </form>

                @if(!$a->feedback)
                <div style="background:#fce7f3; padding:15px; border-radius:8px; margin:15px 0; border-left:4px solid #ec4899;">
                    <strong style="color:#ec4899;">💬 Kirim Feedback:</strong>
                    <form action="/feedback" method="POST" style="margin-top:10px; display:flex; flex-direction:column; gap:10px;">
                        @csrf
                        <input type="hidden" name="aspirasi_id" value="{{ $a->id }}">
                        <textarea name="isi_feedback" placeholder="Tulis feedback Anda..." style="padding:10px; border:1px solid #ddd; border-radius:6px; font-family:sans-serif; font-size:14px; resize:vertical; min-height:80px;"></textarea>
                        <button type="submit" style="background:#10b981; color:white; padding:10px 15px; border:none; border-radius:6px; cursor:pointer; font-weight:bold; align-self:flex-start;">
                            Kirim Feedback
                        </button>
                    </form>
                </div>
                @else
                <div style="background:#f3f4ff; padding:15px; border-radius:8px; margin:15px 0; border-left:4px solid #4f46e5;">
                    <strong style="color:#4f46e5;">💬 Ubah Feedback:</strong>
                    <form action="/feedback/{{ $a->feedback->id }}" method="POST" style="margin-top:10px; display:flex; flex-direction:column; gap:10px;">
                        @csrf
                        @method('PUT')
                        <textarea name="isi_feedback" style="padding:10px; border:1px solid #ddd; border-radius:6px; font-family:sans-serif; font-size:14px; resize:vertical; min-height:80px;">{{ $a->feedback->isi_feedback }}</textarea>
                        <button type="submit" style="background:#3b82f6; color:white; padding:10px 15px; border:none; border-radius:6px; cursor:pointer; font-weight:bold; align-self:flex-start;">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
                <div style="background:#e0e7ff; padding:12px; border-radius:8px; border-left:4px solid #6366f1;">
                    <strong style="color:#4f46e5;">Feedback sebelumnya:</strong>
                    <p style="margin:5px 0; color:#666;">{{ $a->feedback->isi_feedback }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @if(count($data) == 0)
        <div style="text-align:center; padding:40px; background:white; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
            <p style="color:#999; font-size:16px;">Tidak ada aspirasi yang cocok dengan filter.</p>
        </div>
        @endif
    </div>

</body>
</html>