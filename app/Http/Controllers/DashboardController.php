<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

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

    // Edit form anggota
    public function editMember($id)
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('login');
        }

        $member = Siswa::findOrFail($id);
        return view('dashboard.edit_anggota', ['member' => $member]);
    }

    // Update anggota
    public function updateMember(Request $request, $id)
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('login');
        }

        $member = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nis' => 'required|string|unique:siswa,nis,' . $id . ',id_anggota',
            'nama_lengkap' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'username' => 'required|string|unique:siswa,username,' . $id . ',id_anggota',
            'password' => 'nullable|string|min:6',
        ]);

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $member->update($validated);

        return redirect()->route('admin.anggota')->with('success', 'Data anggota berhasil diubah');
    }

    // Delete anggota
    public function deleteMember($id)
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('login');
        }

        Siswa::findOrFail($id)->delete();

        return redirect()->route('admin.anggota')->with('success', 'Data anggota berhasil dihapus');
    }

    // Create form anggota baru
    public function createMember()
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('login');
        }

        return view('dashboard.create_anggota');
    }

    // Store anggota baru
    public function storeMember(Request $request)
    {
        if (session('user_type') !== 'admin') {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'nis' => 'required|string|unique:siswa,nis',
            'nama_lengkap' => 'required|string',
            'kelas' => 'required|string',
            'jurusan' => 'required|string',
            'username' => 'required|string|unique:siswa,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Siswa::create($validated);

        return redirect()->route('admin.anggota')->with('success', 'Data anggota berhasil ditambahkan');
    }
}
