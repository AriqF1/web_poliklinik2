<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasien = User::where('id', Auth::id())->first();
        $totalDokter = User::where('role', 'dokter')->count();
        return view('pasien.index', compact('pasien', 'totalDokter'));
    }
}
