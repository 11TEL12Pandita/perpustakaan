<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'id_anggota';
    protected $fillable = ['nis', 'nama_lengkap', 'kelas', 'jurusan', 'username', 'password'];
    public $timestamps = true;
}
