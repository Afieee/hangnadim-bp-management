<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InspeksiGedungController extends Controller
{
    public function jadwalkanInspeksi()
    {
        return view('pages.jadwalkan-inspeksi');
    }
}
