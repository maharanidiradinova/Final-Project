<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ])->with('hideNavbar', true);
    }

    public function auth(Request $request)
    {
        // Validasi input email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah kredensial valid
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek status verifikasi pengguna
            if (Auth::user()->email_verified_at !== null) {
                return redirect()->intended('/dashboard');
            } else {
                Auth::logout();
                return back()->with('loginError', 'Akun Anda belum diverifikasi oleh admin.');
            }
        } else {
            return back()->with('loginError', 'Login gagal, periksa kembali email dan password.');
        }
    }

    // Method untuk logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Menghapus session dan regenerasi
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }
}
