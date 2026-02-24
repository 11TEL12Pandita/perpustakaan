<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('login');
        }

        // Ambil semua data dari tabel 'siswa' sebagai anggota
        $members = Siswa::all();

        return view('dashboard.admin', [
            'members' => $members,
            'members_count' => $members->count(),
        ]);
    }

    public function membersList()
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('login');
        }

        $members = Siswa::all();
        return view('dashboard.anggota', ['members' => $members]);
    }

    public function siswaDashboard()
    {
        if (session('user_type') !== 'siswa') {
            return redirect()->route('login');
        }

        $userData = session('user_data');
        return view('dashboard.siswa', ['user' => $userData]);
    }
}
