<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\User;
use App\Models\DaftarPoli;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokter = Auth::user();
        $userId = $dokter->id;
        $obats = Obat::pluck('obats.id', 'obats.nama_obat');
        return view('dokter.index', compact('dokter', 'obats'));
    }
}
