<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kredensial
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, perbarui session
            $request->session()->regenerate();

            // Ambil user yang sedang login
            $user = Auth::User();

            // Cek apakah user memiliki role yang sesuai
            if ($user->role) {
                // Redirect sesuai dengan role user
                return match ($user->role) {
                    'pasien' => redirect()->route('pasien.index'),
                    'dokter' => redirect()->route('dokter.index'),
                    default => redirect('/'),
                };
            }

            // Jika role kosong atau tidak valid, logout dan beri pesan error
            Auth::logout();
            return back()->withErrors([
                'role' => 'Role user tidak ditemukan atau tidak valid.',
            ]);
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
