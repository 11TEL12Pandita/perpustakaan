<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Siswa;
use App\Models\Buku;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    // Relasi ke siswa dengan primary key id_anggota
    public function user()
    {
    return $this->belongsTo(Siswa::class, 'user_id', 'id_anggota');
    }
    // Relasi ke buku
    public function buku()
    {
    return $this->belongsTo(Buku::class, 'buku_id', 'id');
    }
}