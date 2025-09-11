<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gedung;
use Illuminate\Http\Request;
use App\Models\BuktiKerusakan;
use App\Mail\LaporanPribadiMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BuktiKerusakanController extends Controller
{
    public function halamanUploadBuktiKerusakan()
    {
        return view('bukti-kerusakan.create');
    }

public function uploadBuktiKerusakan(Request $request)
{
    $userId = Auth::id(); // ambil user yang logins

    $request->validate([
        'judul_bukti_kerusakan' => 'required|string|max:255',
        'deskripsi_bukti_kerusakan' => 'required|string',
        'lokasi_bukti_kerusakan' => 'required|string|max:255',
        'tipe_kerusakan' => 'required|string|in:Furniture,Fire System,Bangunan,Mekanikal Elektrikal,IT,Interior,Eksterior,Sanitasi',
        'file_bukti_kerusakan' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
        'id_inspeksi_gedung' => 'required|exists:inspeksi_gedung,id',
    ]);

    try {
        $filePath = null;
        if ($request->hasFile('file_bukti_kerusakan')) {
            $filePath = $request->file('file_bukti_kerusakan')->store('uploaded_photo', 'public');
        }
        
        BuktiKerusakan::create([
            'judul_bukti_kerusakan' => $request->judul_bukti_kerusakan,
            'deskripsi_bukti_kerusakan' => $request->deskripsi_bukti_kerusakan,
            'lokasi_bukti_kerusakan' => $request->lokasi_bukti_kerusakan,
            'tipe_kerusakan' => $request->tipe_kerusakan,
            'file_bukti_kerusakan' => $filePath,
            'id_inspeksi_gedung' => $request->id_inspeksi_gedung,
            'tipe_pelaporan'=> 'Laporan Rutin',
            'id_user_inspektor' => $userId,
        ]);

        return back()->with('success', '✅ Bukti kerusakan berhasil diupload.');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Gagal menyimpan data: ' . $e->getMessage());
    }
}



    public function halamanManajemenKerusakan()
    {
        $userId = Auth::id(); // Ambil ID user yang login

        // Menampilkan BuktiKerusakan yang belum memiliki relasi ke BuktiPerbaikan
        $kerusakanList = BuktiKerusakan::with(['inspeksiGedung.gedung', 'gedung', 'userInspektor'])
            ->where('id_user_inspektor', $userId) // Filter sesuai user yang login
            ->whereDoesntHave('buktiPerbaikan')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.halaman-manajemen-kerusakan', compact('kerusakanList'));
    }




    public function halamanLaporanPribadi(){
        $gedungs = Gedung::all();
        return view('pages.laporan-pribadi', [
            'gedungs' => $gedungs,
        ]);
    }

















public function uploadBuktiKerusakanPribadi(Request $request)
{
    $userId = Auth::id();
    $userName = Auth::user()->name;

    $request->validate([
        'judul_bukti_kerusakan' => 'required|string|max:255',
        'deskripsi_bukti_kerusakan' => 'required|string',
        'lokasi_bukti_kerusakan' => 'required|string|max:255',
        'tipe_kerusakan' => 'required|string|in:Furniture,Fire System,Gedung & Bangunan,Mekanikal Elektrikal,IT,Jalanan & Jembatan,Jaringan Air,Drainase',
        'file_bukti_kerusakan' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
        'id_inspeksi_gedung' => 'nullable',
        'id_gedung' => 'required',
    ]);

    try {
        $filePath = null;
        if ($request->hasFile('file_bukti_kerusakan')) {
            $filePath = $request->file('file_bukti_kerusakan')->store('uploaded_photo', 'public');
        }

        $bukti = BuktiKerusakan::create([
            'judul_bukti_kerusakan' => $request->judul_bukti_kerusakan,
            'deskripsi_bukti_kerusakan' => $request->deskripsi_bukti_kerusakan,
            'lokasi_bukti_kerusakan' => $request->lokasi_bukti_kerusakan,
            'tipe_kerusakan' => $request->tipe_kerusakan,
            'file_bukti_kerusakan' => $filePath,
            'id_gedung' => $request->id_gedung,
            'id_user_inspektor' => $userId,
            'tipe_pelaporan' => 'Laporan Crash Condition',
            'id_inspeksi_gedung' => $request->id_inspeksi_gedung ?: null,
        ]);

        // 📌 Ambil semua email Kepala Seksi & Staff Pelaksana
        $recipients = User::whereIn('role', ['Admin','Kepala Seksi'])
                        ->pluck('email')
                        ->toArray();

        // Data untuk dikirim ke email
        $emailData = [
            'judul_bukti_kerusakan' => $request->judul_bukti_kerusakan,
            'deskripsi_bukti_kerusakan' => $request->deskripsi_bukti_kerusakan,
            'lokasi_bukti_kerusakan' => $request->lokasi_bukti_kerusakan,
            'tipe_kerusakan' => $request->tipe_kerusakan,
            'file_bukti_kerusakan' => $filePath,
            'id_gedung' => $request->id_gedung,
            'nama_pelapor' => $userName,
        ];

        // 📌 Kirim ke banyak penerima
        Mail::to($recipients)->send(new LaporanPribadiMail($emailData));

        return back()->with('success', '✅ Bukti kerusakan berhasil diupload & email terkirim ke semua Kepala Seksi dan Staff Pelaksana.');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Gagal menyimpan data: ' . $e->getMessage());
    }
}

















public function halamanRekapitulasiKerusakan()
{
    $buktiKerusakan = BuktiKerusakan::with(['userInspektor', 'gedung', 'buktiPerbaikan'])
        ->orderBy('created_at', 'desc')
        ->paginate(5); // 10 item per halaman

    return view('pages.halaman-rekapitulasi-kerusakan', [
        'buktiKerusakan' => $buktiKerusakan,
    ]);
}



public function exportRekapitulasiKerusakan()
{
    $buktiKerusakan = BuktiKerusakan::with(['userInspektor', 'gedung', 'buktiPerbaikan'])
        ->orderBy('created_at', 'desc')
        ->get();

    $filename = "rekapitulasi_kerusakan_" . date('Y-m-d') . ".xlsx";
    
    // XML header untuk Excel
    $xml = '<?xml version="1.0"?>
    <?mso-application progid="Excel.Sheet"?>
    <Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
              xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">
        <Styles>
            <Style ss:ID="Default" ss:Name="Normal">
                <Alignment ss:Vertical="Center"/>
                <Borders/>
                <Font ss:FontName="Calibri" ss:Size="11" ss:Color="#000000"/>
                <Interior/>
                <NumberFormat/>
                <Protection/>
            </Style>
            <Style ss:ID="Header">
                <Font ss:FontName="Calibri" ss:Size="11" ss:Color="#FFFFFF" ss:Bold="1"/>
                <Interior ss:Color="#4E73DF" ss:Pattern="Solid"/>
            </Style>
            <Style ss:ID="Number">
                <NumberFormat ss:Format="0"/>
            </Style>
        </Styles>
        <Worksheet ss:Name="Rekapitulasi Kerusakan">
            <Table>';

    // Header columns
    $headers = ['No', 'Objek Kerusakan', 'Deskripsi', 'Gedung', 'Pelapor', 
                'Lokasi', 'Tipe Kerusakan', 'Status', 'Waktu Dilaporkan', 'Tipe Pelaporan'];
    
    $xml .= '<Row>';
    foreach ($headers as $header) {
        $xml .= '<Cell ss:StyleID="Header"><Data ss:Type="String">' . htmlspecialchars($header) . '</Data></Cell>';
    }
    $xml .= '</Row>';

    // Data rows
    $no = 1;
    foreach ($buktiKerusakan as $bukti) {
        $status = $bukti->buktiPerbaikan ? 'Kasus Ditutup' : 'Menunggu Perbaikan';
        $waktu = \Carbon\Carbon::parse($bukti->created_at)->translatedFormat('d F Y H:i');
        
        $xml .= '<Row>';
        $xml .= '<Cell ss:StyleID="Number"><Data ss:Type="Number">' . $no++ . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($bukti->judul_bukti_kerusakan) . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($bukti->deskripsi_bukti_kerusakan) . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($bukti->gedung->nama_gedung) . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($bukti->userInspektor->name) . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($bukti->lokasi_bukti_kerusakan) . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($bukti->tipe_kerusakan) . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($status) . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($waktu) . '</Data></Cell>';
        $xml .= '<Cell><Data ss:Type="String">' . htmlspecialchars($bukti->tipe_pelaporan) . '</Data></Cell>';
        $xml .= '</Row>';
    }

    $xml .= '</Table>
        </Worksheet>
    </Workbook>';

    $headers = [
        'Content-Type' => 'application/vnd.ms-excel',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    return response($xml, 200, $headers);
}


}
