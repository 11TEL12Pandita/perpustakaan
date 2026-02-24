<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\Transaksi;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'nis',
        'name',
        'kelas',
        'jurusan',
        'username',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: 1 user bisa punya banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}