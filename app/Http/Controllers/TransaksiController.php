<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Buku;

class TransaksiController extends Controller
{
    // histori transaksi
    public function index()
    {
        if (!session('user_type')) {
            return redirect()->route('login');
        }

        if (session('user_type') === 'siswa') {
            // Siswa hanya melihat transaksi mereka sendiri
            $transaksi = Transaksi::with('buku','user')
                ->where('user_id', session('user_id'))
                ->get();
        } else {
            // Admin melihat semua transaksi
            $transaksi = Transaksi::with('buku','user')->get();
        }

        return view('transaksi.index', compact('transaksi'));
    }

    // form pinjam buku
    public function create()
    {
        if (session('user_type') !== 'siswa') {
            return redirect()->route('admin.dashboard');
        }

        $buku = Buku::where('stok', '>', 0)->get();

        return view('transaksi.create', compact('buku'));
    }

    // simpan transaksi
    public function store(Request $request)
    {
        if (session('user_type') !== 'siswa') {
            return redirect()->route('admin.dashboard');
        }

        $validated = $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::find($validated['buku_id']);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku tidak tersedia');
        }

        Transaksi::create([
            'user_id' => session('user_id'), // penting
            'buku_id' => $validated['buku_id'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => null, 
        ]);

        // kurangi stok
        $buku->decrement('stok');

        return redirect()->route('transaksi.index')
            ->with('success','Buku berhasil dipinjam');
    }

    public function kembali($id)
{
    if (!session('user_type')) {
        return redirect()->route('login');
    }

    // Hanya siswa yang bisa mengembalikan buku
    if (session('user_type') !== 'siswa') {
        return back()->with('error', 'Admin tidak dapat mengembalikan buku. Hanya siswa yang bisa mengembalikan buku.');
    }

    $transaksi = Transaksi::find($id);

    if (!$transaksi) {
        return back()->with('error', 'Transaksi tidak ditemukan');
    }

    // Cegah double return
    if ($transaksi->tanggal_kembali) {
        return back()->with('error', 'Buku sudah dikembalikan');
    }

    // Siswa hanya boleh kembalikan miliknya
    if ($transaksi->user_id != session('user_id')) {
        return back()->with('error', 'Tidak ada akses');
    }

    // tambah stok
    $buku = Buku::find($transaksi->buku_id);
    $buku->increment('stok');

    // update tanggal kembali = hari ini
    $transaksi->update([
        'tanggal_kembali' => now()
    ]);

    return redirect()->route('transaksi.index')
        ->with('success', 'Buku berhasil dikembalikan');
}
}