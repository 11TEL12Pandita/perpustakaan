<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    // tampilkan semua buku
    public function index()
    {
        if (!session('user_type')) {
            return redirect()->route('login');
        }

        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    // tampil form tambah
    public function create()
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('siswa.dashboard');
        }

        return view('buku.create');
    }

    // simpan buku
    public function store(Request $request)
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('siswa.dashboard');
        }

        $validated = $request->validate([
            'kode_buku' => 'required|string',
            'judul_buku' => 'required|string',
            'pengarang' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'nullable|integer',
            'stok' => 'required|integer',
        ]);

        Buku::create($validated);

        return redirect('/buku')->with('success','Buku berhasil ditambahkan');
    }

    // tampil form edit
    public function edit($id)
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('siswa.dashboard');
        }

        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    // update buku
    public function update(Request $request, $id)
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('siswa.dashboard');
        }

        $buku = Buku::find($id);

        $validated = $request->validate([
            'kode_buku' => 'required|string',
            'judul_buku' => 'required|string',
            'pengarang' => 'required|string',
            'penerbit' => 'required|string',
            'tahun_terbit' => 'nullable|integer',
            'stok' => 'required|integer',
        ]);

        $buku->update($validated);

        return redirect('/buku')->with('success','Buku berhasil diubah');
    }

    // hapus buku
    public function destroy($id)
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('siswa.dashboard');
        }

        Buku::find($id)->delete();

        return redirect('/buku')->with('success','Buku berhasil dihapus');
    }
}