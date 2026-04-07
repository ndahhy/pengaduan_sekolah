<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AspirasiController extends Controller
{
    public function index()
    {
        $data = Aspirasi::with('kategori','feedback')
            ->where('user_id', auth()->id())
            ->latest()->get();

        return view('aspirasi.index', compact('data'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('aspirasi.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'kategori_id'=>'required',
            'lokasi'=>'nullable|string',
            'ket'=>'nullable|string'
        ]);

        Aspirasi::create([
            'user_id'=>auth()->id(),
            'kategori_id'=>$request->kategori_id,
            'judul'=>$request->judul,
            'isi'=>$request->isi,
            'lokasi'=>$request->lokasi,
            'ket'=>$request->ket,
            'tanggal'=>now()
        ]);

        return redirect()->route('aspirasi.index');
    }

    public function show($id)
    {
        $data = Aspirasi::with('kategori','feedback')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('aspirasi.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Aspirasi::where('user_id', auth()->id())->findOrFail($id);
        $kategori = Kategori::all();
        return view('aspirasi.edit', compact('data','kategori'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required',
        'isi' => 'required',
        'kategori_id' => 'required',
        'lokasi' => 'nullable|string',
        'ket' => 'nullable|string'
    ]);

    $a = Aspirasi::where('user_id', auth()->id())->findOrFail($id);

    $a->update([
        'kategori_id' => $request->kategori_id,
        'judul' => $request->judul,
        'isi' => $request->isi,
        'lokasi' => $request->lokasi,
        'ket' => $request->ket,
    ]);

    return redirect('/aspirasi');
}

public function destroy($id)
{
    $a = Aspirasi::where('user_id', auth()->id())->findOrFail($id);
    $a->delete();
    return back();
}
}