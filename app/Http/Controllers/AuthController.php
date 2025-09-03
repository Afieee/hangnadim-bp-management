<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\BuktiKerusakan;
use App\Models\Feedback;
use App\Models\InspeksiGedung;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

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
            'nip_atau_nup' => 'required|string|max:255',
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Kepala Seksi,Staff Pelaksana,Direktur,Kepala Bidang,Deputi',
        ]);

        User::create([
            'nip_atau_nup' => $request->nip_atau_nup,
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
            'nip_atau_nup' => 'required|string|max:50',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // regenerate session
            return redirect()->route('dashboard')->with('success', 'Anda Berhasil Login.');
        }

        return back()->withErrors([
            'error' => 'NIP/NUP atau Password salah.',
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

        $buktiKerusakanFurniture = BuktiKerusakan::where('tipe_kerusakan', 'Furniture')->count();
        $buktiKerusakanFireSystem = BuktiKerusakan::where('tipe_kerusakan', 'Fire System')->count();
        $buktiKerusakanBangunan = BuktiKerusakan::where('tipe_kerusakan', 'Bangunan')->count();
        $buktiKerusakanMekanikalElektrikal = BuktiKerusakan::where('tipe_kerusakan', 'Mekanikal Elektrikal')->count();
        $buktiKerusakanIT = BuktiKerusakan::where('tipe_kerusakan', 'IT')->count();
        $buktiKerusakanInterior = BuktiKerusakan::where('tipe_kerusakan', 'Interior')->count();
        $buktiKerusakanEksterior = BuktiKerusakan::where('tipe_kerusakan', 'Eksterior')->count();
        $buktiKerusakanSanitasi = BuktiKerusakan::where('tipe_kerusakan', 'Sanitasi')->count();
        










        $hitungFeedbackSangatBaik = Feedback::where('predikat_rating_pelayanan', 'Sangat Baik')->count();
        $hitungFeedbackBaik = Feedback::where('predikat_rating_pelayanan', 'Baik')->count();
        $hitungFeedbackKurangBaik = Feedback::where('predikat_rating_pelayanan', 'Kurang Baik')->count();
        $hitungFeedbackTidakBaik = Feedback::where('predikat_rating_pelayanan', 'Tidak Baik')->count();




        $indeksRatingPelayananRataRata = round(Feedback::avg('indeks_rating_pelayanan'), 2);

        $totalKerusakan = BuktiKerusakan::all()->count();

        $buktiPerbaikanPenutupKerusakan = DB::table('bukti_kerusakan')
        ->select(
            DB::raw('DISTINCT bukti_perbaikan.id_bukti_kerusakan'),
            'bukti_kerusakan.judul_bukti_kerusakan',
            'bukti_kerusakan.id'
        )
        ->from('bukti_kerusakan')
        ->join('bukti_perbaikan', 'bukti_kerusakan.id', '=', 'bukti_perbaikan.id_bukti_kerusakan')
        ->get()->count();


        $buktiKerusakanYangBelumDiperbaiki = BuktiKerusakan::whereDoesntHave('buktiPerbaikan')->count();
        $jumlahInspeksi = InspeksiGedung::where('status_keseluruhan_inspeksi', 'Terbuka')->count();
        $user = Auth::user();
        return view('pages.dashboard',[
            'user' => $user,
            'buktiPerbaikanPenutupKerusakan' => $buktiPerbaikanPenutupKerusakan,
            'buktiKerusakanYangBelumDiperbaiki' => $buktiKerusakanYangBelumDiperbaiki,
            'jumlahInspeksi' => $jumlahInspeksi,
            'totalKerusakan' => $totalKerusakan,
            'indeksRatingPelayananRataRata' => $indeksRatingPelayananRataRata,
            'hitungFeedbackSangatBaik'=> $hitungFeedbackSangatBaik,
            'hitungFeedbackBaik' => $hitungFeedbackBaik ,
            'hitungFeedbackKurangBaik' => $hitungFeedbackKurangBaik ,
            'hitungFeedbackTidakBaik' => $hitungFeedbackTidakBaik ,

            'buktiKerusakanFurniture'=> $buktiKerusakanFurniture,
            'buktiKerusakanFireSystem'=> $buktiKerusakanFireSystem,
            'buktiKerusakanBangunan'=> $buktiKerusakanBangunan,
            'buktiKerusakanMekanikalElektrikal'=> $buktiKerusakanMekanikalElektrikal,
            'buktiKerusakanIT'=> $buktiKerusakanIT,
            'buktiKerusakanInterior'=> $buktiKerusakanInterior,
            'buktiKerusakanEksterior'=> $buktiKerusakanEksterior,
            'buktiKerusakanEksterior'=> $buktiKerusakanEksterior,
            'buktiKerusakanSanitasi' => $buktiKerusakanSanitasi,
        ]);
    }
    




// AuthController.php

public function filterDamageType(Request $request)
{
    $year = $request->input('year');
    
    // Query untuk BuktiKerusakan dengan filter created_at
    $buktiKerusakanQuery = BuktiKerusakan::query();
    if ($year) {
        $buktiKerusakanQuery->whereYear('created_at', $year);
    }
    
    $buktiKerusakanFurniture = (clone $buktiKerusakanQuery)->where('tipe_kerusakan', 'Furniture')->count();
    $buktiKerusakanFireSystem = (clone $buktiKerusakanQuery)->where('tipe_kerusakan', 'Fire System')->count();
    $buktiKerusakanBangunan = (clone $buktiKerusakanQuery)->where('tipe_kerusakan', 'Bangunan')->count();
    $buktiKerusakanMekanikalElektrikal = (clone $buktiKerusakanQuery)->where('tipe_kerusakan', 'Mekanikal Elektrikal')->count();
    $buktiKerusakanIT = (clone $buktiKerusakanQuery)->where('tipe_kerusakan', 'IT')->count();
    $buktiKerusakanInterior = (clone $buktiKerusakanQuery)->where('tipe_kerusakan', 'Interior')->count();
    $buktiKerusakanEksterior = (clone $buktiKerusakanQuery)->where('tipe_kerusakan', 'Eksterior')->count();
    $buktiKerusakanSanitasi = (clone $buktiKerusakanQuery)->where('tipe_kerusakan', 'Sanitasi')->count();

    return response()->json([
        'buktiKerusakanFurniture' => $buktiKerusakanFurniture,
        'buktiKerusakanFireSystem' => $buktiKerusakanFireSystem,
        'buktiKerusakanBangunan' => $buktiKerusakanBangunan,
        'buktiKerusakanMekanikalElektrikal' => $buktiKerusakanMekanikalElektrikal,
        'buktiKerusakanIT' => $buktiKerusakanIT,
        'buktiKerusakanInterior' => $buktiKerusakanInterior,
        'buktiKerusakanEksterior' => $buktiKerusakanEksterior,
        'buktiKerusakanSanitasi' => $buktiKerusakanSanitasi,
    ]);
}















public function filterDashboard(Request $request)
{
    $year = $request->input('year');
    $month = $request->input('month');
    
    // Query untuk Feedback dengan filter created_at
    $feedbackQuery = Feedback::query();
    if ($year) {
        $feedbackQuery->whereYear('created_at', $year);
    }
    if ($month && $month !== 'all') {
        $feedbackQuery->whereMonth('created_at', $month);
    }
    
    $hitungFeedbackSangatBaik = (clone $feedbackQuery)->where('predikat_rating_pelayanan', 'Sangat Baik')->count();
    $hitungFeedbackBaik = (clone $feedbackQuery)->where('predikat_rating_pelayanan', 'Baik')->count();
    $hitungFeedbackKurangBaik = (clone $feedbackQuery)->where('predikat_rating_pelayanan', 'Kurang Baik')->count();
    $hitungFeedbackTidakBaik = (clone $feedbackQuery)->where('predikat_rating_pelayanan', 'Tidak Baik')->count();
    $indeksRatingPelayananRataRata = round((clone $feedbackQuery)->avg('indeks_rating_pelayanan'), 2);

    // Query untuk BuktiKerusakan dengan filter created_at
    $buktiKerusakanQuery = BuktiKerusakan::query();
    if ($year) {
        $buktiKerusakanQuery->whereYear('created_at', $year);
    }
    if ($month && $month !== 'all') {
        $buktiKerusakanQuery->whereMonth('created_at', $month);
    }
    
    $totalKerusakan = $buktiKerusakanQuery->count();

    // Query untuk BuktiPerbaikan dengan filter created_at
    $buktiPerbaikanQuery = DB::table('bukti_kerusakan')
        ->select(
            DB::raw('DISTINCT bukti_perbaikan.id_bukti_kerusakan'),
            'bukti_kerusakan.judul_bukti_kerusakan',
            'bukti_kerusakan.id'
        )
        ->from('bukti_kerusakan')
        ->join('bukti_perbaikan', 'bukti_kerusakan.id', '=', 'bukti_perbaikan.id_bukti_kerusakan');
    
    if ($year) {
        $buktiPerbaikanQuery->whereYear('bukti_kerusakan.created_at', $year);
    }
    if ($month && $month !== 'all') {
        $buktiPerbaikanQuery->whereMonth('bukti_kerusakan.created_at', $month);
    }
    
    $buktiPerbaikanPenutupKerusakan = $buktiPerbaikanQuery->count();

    // Query untuk BuktiKerusakan yang belum diperbaiki dengan filter created_at
    $buktiKerusakanBelumDiperbaikiQuery = BuktiKerusakan::whereDoesntHave('buktiPerbaikan');
    if ($year) {
        $buktiKerusakanBelumDiperbaikiQuery->whereYear('created_at', $year);
    }
    if ($month && $month !== 'all') {
        $buktiKerusakanBelumDiperbaikiQuery->whereMonth('created_at', $month);
    }
    
    $buktiKerusakanYangBelumDiperbaiki = $buktiKerusakanBelumDiperbaikiQuery->count();

    // Query untuk InspeksiGedung dengan filter created_at
    $inspeksiQuery = InspeksiGedung::where('status_keseluruhan_inspeksi', 'Terbuka');
    if ($year) {
        $inspeksiQuery->whereYear('created_at', $year);
    }
    if ($month && $month !== 'all') {
        $inspeksiQuery->whereMonth('created_at', $month);
    }
    
    $jumlahInspeksi = $inspeksiQuery->count();

    return response()->json([
        'buktiPerbaikanPenutupKerusakan' => $buktiPerbaikanPenutupKerusakan,
        'buktiKerusakanYangBelumDiperbaiki' => $buktiKerusakanYangBelumDiperbaiki,
        'jumlahInspeksi' => $jumlahInspeksi,
        'totalKerusakan' => $totalKerusakan,
        'indeksRatingPelayananRataRata' => $indeksRatingPelayananRataRata,
        'hitungFeedbackSangatBaik' => $hitungFeedbackSangatBaik,
        'hitungFeedbackBaik' => $hitungFeedbackBaik,
        'hitungFeedbackKurangBaik' => $hitungFeedbackKurangBaik,
        'hitungFeedbackTidakBaik' => $hitungFeedbackTidakBaik,
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





    public function halamanEditProfile($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId); // Balikin ke ID asli
        $user = User::findOrFail($id);
        return view('auth.user-edit', compact('user'));
    }


    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nip_atau_nup' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|max:50',
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Update data
        $user->nip_atau_nup = $validated['nip_atau_nup'];
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
















    public function halamanEditProfilePribadi($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId); // Ubah kembali ke ID asli
        $user = User::findOrFail($id);

        // Pastikan yang bisa akses hanya user yang login sendiri
        if ($user->id !== Auth::id()) {
            abort(403, 'Akses ditolak');
        }

        return view('auth.user-edit', compact('user'));
    }


    public function updateProfilePribadi(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nip_atau_nup' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|max:50',
            'password' => 'nullable|min:6|confirmed'
        ]);

        // Update data
        $user->nip_atau_nup = $validated['nip_atau_nup'];
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
