<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BuktiKerusakan;
use App\Models\InspeksiGedung;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan halaman register
    public function halamanRegister()
    {
        return view('auth.register');
    }

    // Simpan data register
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Kepala Seksi,Staff Pelaksana,Direktur,Kepala Bidang,Deputi',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('halaman-registrasi')->with('success', 'Registrasi Pengguna Berhasil.');
    }

    // Tampilkan halaman login
    public function halamanLogin()
    {
        return view('auth.login');
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // regenerate session
            return redirect()->route('dashboard')->with('success', 'Anda Berhasil Login.');
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda Berhasil Logout.');
    }

public function dashboard()
{   
    $buktiKerusakanYangBelumDiperbaiki = BuktiKerusakan::whereDoesntHave('buktiPerbaikan')->count();
    $jumlahInspeksi = InspeksiGedung::where('status_keseluruhan_inspeksi', 'Terbuka')->count();

    // Cek isi variabel
    // dd($buktiKerusakanYangBelumDiperbaiki, $jumlahInspeksi);

    // Ambil user langsung dari Auth
    $user = Auth::user();
    return view('pages.dashboard',[
        'user' => $user,
        'buktiKerusakanYangBelumDiperbaiki' => $buktiKerusakanYangBelumDiperbaiki,
        'jumlahInspeksi' => $jumlahInspeksi,
    ]);
}
}   
