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
    $user = Auth::user();
    return view('pages.dashboard',[
        'user' => $user,
        'buktiKerusakanYangBelumDiperbaiki' => $buktiKerusakanYangBelumDiperbaiki,
        'jumlahInspeksi' => $jumlahInspeksi,
    ]);
}


    public function halamanManageUser()
    {
        $users = User::all();
        return view('auth.user-manage', compact('users'));
    }

    public function hapusUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manage-user')->with('success', 'User berhasil dihapus!');
    }





        public function halamanEditProfile($id)
    {
        $user = User::findOrFail($id);
        return view('auth.user-edit', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|max:50',
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Update data
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('manage-user')->with('success', 'User berhasil diperbarui!');
    }


}
