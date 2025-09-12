<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\BuktiKerusakan;
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
            'role' => 'required|in:Admin,Kepala Seksi,Staff Pelaksana,Direktur,Kepala Bidang,Deputi,Tata Usaha',
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
    // Hitung jumlah kerusakan berdasarkan tipe yang baru
    $buktiKerusakanFurniture = BuktiKerusakan::where('tipe_kerusakan', 'Furniture')->count();
    $buktiKerusakanFireSystem = BuktiKerusakan::where('tipe_kerusakan', 'Fire System')->count();
    $buktiKerusakanGedungBangunan = BuktiKerusakan::where('tipe_kerusakan', 'Gedung & Bangunan')->count();
    $buktiKerusakanMekanikalElektrikal = BuktiKerusakan::where('tipe_kerusakan', 'Mekanikal Elektrikal')->count();
    $buktiKerusakanIT = BuktiKerusakan::where('tipe_kerusakan', 'IT')->count();
    $buktiKerusakanJalananJembatan = BuktiKerusakan::where('tipe_kerusakan', 'Jalanan & Jembatan')->count();
    $buktiKerusakanJaringanAir = BuktiKerusakan::where('tipe_kerusakan', 'Jaringan Air')->count();
    $buktiKerusakanDrainase = BuktiKerusakan::where('tipe_kerusakan', 'Drainase')->count();

    // Kode lainnya tetap sama...
    $hitungFeedbackSangatBaik = Feedback::where('predikat_rating_pelayanan', 'Sangat Baik')->count();
    $hitungFeedbackBaik = Feedback::where('predikat_rating_pelayanan', 'Baik')->count();
    $hitungFeedbackKurangBaik = Feedback::where('predikat_rating_pelayanan', 'Kurang Baik')->count();
    $hitungFeedbackTidakBaik = Feedback::where('predikat_rating_pelayanan', 'Tidak Baik')->count();

    $jumlahStaffPelaksana = User::where('role', 'Staff Pelaksana')->count();
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
        'hitungFeedbackBaik' => $hitungFeedbackBaik,
        'hitungFeedbackKurangBaik' => $hitungFeedbackKurangBaik,
        'hitungFeedbackTidakBaik' => $hitungFeedbackTidakBaik,

        // Data tipe kerusakan yang baru
        'buktiKerusakanFurniture'=> $buktiKerusakanFurniture,
        'buktiKerusakanFireSystem'=> $buktiKerusakanFireSystem,
        'buktiKerusakanGedungBangunan'=> $buktiKerusakanGedungBangunan,
        'buktiKerusakanMekanikalElektrikal'=> $buktiKerusakanMekanikalElektrikal,
        'buktiKerusakanIT'=> $buktiKerusakanIT,
        'buktiKerusakanJalananJembatan'=> $buktiKerusakanJalananJembatan,
        'buktiKerusakanJaringanAir'=> $buktiKerusakanJaringanAir,
        'buktiKerusakanDrainase' => $buktiKerusakanDrainase,
        'jumlahStaffPelaksana' => $jumlahStaffPelaksana,
    ]);
}




    protected function buildDateRange($year, $month, $week)
    {
        if (!$year && !$month && !$week) {
            return [null, null];
        }

        // jika year kosong tapi month ada -> jangan terima. Namun client hanya mengirim month jika year ada. 
        // Kita tetap handle month tanpa year: gunakan currentYear.
        if ($month && !$year) $year = Carbon::now()->year;

        if ($year && !$month) {
            // filter seluruh tahun
            $start = Carbon::create($year, 1, 1)->startOfDay();
            $end = Carbon::create($year, 12, 31)->endOfDay();
            return [$start, $end];
        }

        // sekarang year & month ada (atau hanya month but we set year)
        $month = (int)$month;
        $year = (int)$year;

        // minggu 1 => 1-7, 2 => 8-14, 3 => 15-21, 4 => 22 - end of month
        if (!$week) {
            $start = Carbon::create($year, $month, 1)->startOfDay();
            $end = Carbon::create($year, $month, Carbon::create($year, $month, 1)->daysInMonth)->endOfDay();
            return [$start, $end];
        }

        $week = (int)$week;
        if ($week === 1) {
            $start = Carbon::create($year, $month, 1)->startOfDay();
            $end = Carbon::create($year, $month, 7)->endOfDay();
        } elseif ($week === 2) {
            $start = Carbon::create($year, $month, 8)->startOfDay();
            $end = Carbon::create($year, $month, 14)->endOfDay();
        } elseif ($week === 3) {
            $start = Carbon::create($year, $month, 15)->startOfDay();
            $end = Carbon::create($year, $month, 21)->endOfDay();
        } else { // week 4
            $start = Carbon::create($year, $month, 22)->startOfDay();
            $end = Carbon::create($year, $month, Carbon::create($year, $month, 1)->daysInMonth)->endOfDay();
        }

        return [$start, $end];
    }

    // endpoint POST untuk filter umum -> mengembalikan json untuk statistik + feedback + repair
    public function filterDashboard(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
        $week = $request->input('week');

        [$startDate, $endDate] = $this->buildDateRange($year, $month, $week);

        // helper closure to apply created_at range if present
        $applyDateRange = function($query, $dateField = 'created_at') use ($startDate, $endDate) {
            if ($startDate && $endDate) {
                $query->whereBetween($dateField, [$startDate, $endDate]);
            }
            return $query;
        };

        // Feedback counts
        $feedbackQuery = Feedback::query();
        if ($startDate && $endDate) $feedbackQuery->whereBetween('created_at', [$startDate, $endDate]);
        $hitungFeedbackSangatBaik = (clone $feedbackQuery)->where('predikat_rating_pelayanan', 'Sangat Baik')->count();
        $hitungFeedbackBaik = (clone $feedbackQuery)->where('predikat_rating_pelayanan', 'Baik')->count();
        $hitungFeedbackKurangBaik = (clone $feedbackQuery)->where('predikat_rating_pelayanan', 'Kurang Baik')->count();
        $hitungFeedbackTidakBaik = (clone $feedbackQuery)->where('predikat_rating_pelayanan', 'Tidak Baik')->count();
        $indeksRatingPelayananRataRata = $feedbackQuery->avg('indeks_rating_pelayanan');
        $indeksRatingPelayananRataRata = $indeksRatingPelayananRataRata ? round($indeksRatingPelayananRataRata, 2) : 0;

        // Bukti kerusakan counts (apply date on bukti_kerusakan.created_at)
        $buktiKerusakanQuery = BuktiKerusakan::query();
        if ($startDate && $endDate) $buktiKerusakanQuery->whereBetween('created_at', [$startDate, $endDate]);
        $totalKerusakan = $buktiKerusakanQuery->count();

        // bukti perbaikan (distinct id_bukti_kerusakan) - gunakan tanggal pada bukti_perbaikan jika filtering
        $buktiPerbaikanQuery = DB::table('bukti_kerusakan')
            ->join('bukti_perbaikan', 'bukti_kerusakan.id', '=', 'bukti_perbaikan.id_bukti_kerusakan');

        if ($startDate && $endDate) {
            // kita apply filter ke bukti_perbaikan.created_at OR bukti_kerusakan.created_at (pilih policy)
            // di sini kita filter berdasarkan bukti_perbaikan.created_at supaya "perbaikan yang dilakukan di rentang ini"
            $buktiPerbaikanQuery->whereBetween('bukti_perbaikan.created_at', [$startDate, $endDate]);
        }

        $buktiPerbaikanPenutupKerusakan = $buktiPerbaikanQuery
            ->select(DB::raw('DISTINCT bukti_perbaikan.id_bukti_kerusakan'))
            ->get()->count();

        // bukti kerusakan yang belum diperbaiki: bukti_kerusakan tanpa relasi buktiPerbaikan.
        $buktiKerusakanYangBelumDiperbaikiQuery = BuktiKerusakan::doesntHave('buktiPerbaikan');
        if ($startDate && $endDate) $buktiKerusakanYangBelumDiperbaikiQuery->whereBetween('created_at', [$startDate, $endDate]);
        $buktiKerusakanYangBelumDiperbaiki = $buktiKerusakanYangBelumDiperbaikiQuery->count();

        // jumlah inspeksi (filter created_at jika ada)
        $inspeksiQuery = InspeksiGedung::where('status_keseluruhan_inspeksi', 'Terbuka');
        if ($startDate && $endDate) $inspeksiQuery->whereBetween('created_at', [$startDate, $endDate]);
        $jumlahInspeksi = $inspeksiQuery->count();

        // jumlah staff pelaksana (tidak terfilter per tanggal, tetap global)
        $jumlahStaffPelaksana = User::where('role', 'Staff Pelaksana')->count();

        return response()->json([
            'hitungFeedbackSangatBaik' => $hitungFeedbackSangatBaik,
            'hitungFeedbackBaik' => $hitungFeedbackBaik,
            'hitungFeedbackKurangBaik' => $hitungFeedbackKurangBaik,
            'hitungFeedbackTidakBaik' => $hitungFeedbackTidakBaik,
            'indeksRatingPelayananRataRata' => $indeksRatingPelayananRataRata,
            'totalKerusakan' => $totalKerusakan,
            'buktiPerbaikanPenutupKerusakan' => $buktiPerbaikanPenutupKerusakan,
            'buktiKerusakanYangBelumDiperbaiki' => $buktiKerusakanYangBelumDiperbaiki,
            'jumlahInspeksi' => $jumlahInspeksi,
            'jumlahStaffPelaksana' => $jumlahStaffPelaksana,
        ]);
    }

    // endpoint POST khusus tipe kerusakan (return counts per tipe)
public function filterDamageType(Request $request)
{
    $year = $request->input('year');
    $month = $request->input('month');
    $week = $request->input('week');

    [$startDate, $endDate] = $this->buildDateRange($year, $month, $week);

    $applyRange = function($query) use ($startDate, $endDate) {
        if ($startDate && $endDate) $query->whereBetween('created_at', [$startDate, $endDate]);
        return $query;
    };

    // Update query untuk tipe kerusakan yang baru
    $buktiKerusakanFurniture = $applyRange(BuktiKerusakan::where('tipe_kerusakan', 'Furniture'))->count();
    $buktiKerusakanFireSystem = $applyRange(BuktiKerusakan::where('tipe_kerusakan', 'Fire System'))->count();
    $buktiKerusakanGedungBangunan = $applyRange(BuktiKerusakan::where('tipe_kerusakan', 'Gedung & Bangunan'))->count();
    $buktiKerusakanMekanikalElektrikal = $applyRange(BuktiKerusakan::where('tipe_kerusakan', 'Mekanikal Elektrikal'))->count();
    $buktiKerusakanIT = $applyRange(BuktiKerusakan::where('tipe_kerusakan', 'IT'))->count();
    $buktiKerusakanJalananJembatan = $applyRange(BuktiKerusakan::where('tipe_kerusakan', 'Jalanan & Jembatan'))->count();
    $buktiKerusakanJaringanAir = $applyRange(BuktiKerusakan::where('tipe_kerusakan', 'Jaringan Air'))->count();
    $buktiKerusakanDrainase = $applyRange(BuktiKerusakan::where('tipe_kerusakan', 'Drainase'))->count();

    return response()->json([
        'buktiKerusakanFurniture' => $buktiKerusakanFurniture,
        'buktiKerusakanFireSystem' => $buktiKerusakanFireSystem,
        'buktiKerusakanGedungBangunan' => $buktiKerusakanGedungBangunan,
        'buktiKerusakanMekanikalElektrikal' => $buktiKerusakanMekanikalElektrikal,
        'buktiKerusakanIT' => $buktiKerusakanIT,
        'buktiKerusakanJalananJembatan' => $buktiKerusakanJalananJembatan,
        'buktiKerusakanJaringanAir' => $buktiKerusakanJaringanAir,
        'buktiKerusakanDrainase' => $buktiKerusakanDrainase,
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
