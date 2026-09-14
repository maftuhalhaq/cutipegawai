<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses autentikasi login
    // Proses autentikasi login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'], // Ubah email jadi username
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Selamat datang di SI-CUTE BNNK Malang!');
        }

        return back()->withErrors([
            'username' => 'Username atau Password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda berhasil keluar dari sistem.');
    }

    // Menampilkan halaman profil
    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    // Memproses update Email, Password, atau PIN
    // Memproses update Profil, Password, atau PIN
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // 1. Update Profil Akun (Nama & Username)
        if ($request->action == 'update_profile') {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:users,username,' . $user->id,
            ]);
            $user->update([
                'name' => $request->name,
                'username' => $request->username
            ]);
            return back()->with('success', 'Informasi akun berhasil diperbarui!');
        }

        // 2. Update Kata Sandi
        if ($request->action == 'update_password') {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:6|confirmed'
            ]);
            if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
                return back()->with('error', 'Gagal! Kata sandi lama tidak sesuai.');
            }
            $user->update(['password' => bcrypt($request->new_password)]);
            return back()->with('success', 'Kata sandi berhasil diperbarui!');
        }

        // 3. Update PIN Atur Hak Cuti
        if ($request->action == 'update_pin_cuti') {
            $request->validate([
                'password_verify' => 'required',
                'pin_cuti' => 'required|digits:6|confirmed'
            ]);
            if (!\Illuminate\Support\Facades\Hash::check($request->password_verify, $user->password)) {
                return back()->with('error', 'Gagal! Kata sandi tidak sesuai.');
            }
            $user->update(['pin_cuti' => bcrypt($request->pin_cuti)]);
            return back()->with('success', 'PIN Atur Hak Cuti berhasil diperbarui!');
        }

        // 4. Update PIN Hapus Pegawai
        if ($request->action == 'update_pin_hapus') {
            $request->validate([
                'password_verify' => 'required',
                'pin_hapus' => 'required|digits:6|confirmed'
            ]);
            if (!\Illuminate\Support\Facades\Hash::check($request->password_verify, $user->password)) {
                return back()->with('error', 'Gagal! Kata sandi tidak sesuai.');
            }
            $user->update(['pin_hapus' => bcrypt($request->pin_hapus)]);
            return back()->with('success', 'PIN Hapus Pegawai berhasil diperbarui!');
        }

        return back();
    }
}