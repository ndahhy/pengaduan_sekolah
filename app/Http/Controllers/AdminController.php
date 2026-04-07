<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Aspirasi::with('user','kategori','feedback');

        // 🔎 FILTER KATEGORI
        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // � FILTER SISWA/USER
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // 📅 FILTER TANGGAL
        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // 📆 FILTER BULAN / TAHUN
        if ($request->bulan && $request->tahun) {
            $query->whereMonth('tanggal', $request->bulan)
                  ->whereYear('tanggal', $request->tahun);
        } elseif ($request->tahun) {
            $query->whereYear('tanggal', $request->tahun);
        } elseif ($request->bulan) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        // 🔍 SEARCH JUDUL
        if ($request->keyword) {
            $query->where('judul', 'like', '%' . $request->keyword . '%');
        }

        // Ambil data
        $data = $query->latest()->get();

        // Ambil kategori untuk dropdown
        $kategori = Kategori::all();

        // Ambil semua user untuk dropdown
        $users = \App\Models\User::all();

        return view('admin.index', compact('data','kategori','users'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai'
        ]);

        $a = Aspirasi::findOrFail($id);
        $a->status = $request->status;
        $a->save();

        return back()->with('success', 'Status berhasil diupdate');
    }
}