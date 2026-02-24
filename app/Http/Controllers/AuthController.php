<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // tampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // proses login
    public function prosesLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Cek login sebagai siswa
        $siswa = Siswa::where('username', $credentials['username'])->first();
        if ($siswa && Hash::check($credentials['password'], $siswa->password)) {
            session(['user_id' => $siswa->id_anggota, 'user_type' => 'siswa', 'user_data' => $siswa]);
            return redirect()->route('siswa.dashboard');
        }

        // Cek login sebagai admin
        $admin = Admin::where('username', $credentials['username'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            session(['user_id' => $admin->id, 'user_type' => 'admin', 'user_data' => $admin]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password tidak sesuai',
        ]);
    }

    // tampilkan halaman register
    public function register()
    {
        return view('auth.register');
    }

    // proses register
    public function prosesRegister(Request $request)
    {
        $role = $request->input('role', 'siswa');

        if ($role === 'siswa') {
            $validated = $request->validate([
                'nis' => 'required|unique:siswa',
                'nama' => 'required|string',
                'kelas' => 'required|string',
                'jurusan' => 'required|string',
                'username' => 'required|unique:siswa|string',
                'password' => 'required|confirmed|min:6',
            ]);

            Siswa::create([
                'nis' => $validated['nis'],
                'nama' => $validated['nama'],
                'kelas' => $validated['kelas'],
                'jurusan' => $validated['jurusan'],
                'username' => $validated['username'],
                'password' => Hash::make($validated['password']),
            ]);

        } else {
            $validated = $request->validate([
                'username' => 'required|unique:admin|string',
                'email' => 'required|unique:admin|email',
                'password' => 'required|confirmed|min:6',
            ]);

            Admin::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan login.');
    }

    // logout
    public function logout(Request $request)
    {
        session()->flush();
        return redirect()->route('login');
    }
}