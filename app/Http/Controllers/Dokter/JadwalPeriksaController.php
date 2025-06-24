<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Poli;

class JadwalPeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $dokter = $user->dokter;
        $poli = $dokter?->poli;

        return view('dokter.poli.index', [
            'dokter' => $dokter,
            'poli' => $poli,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'is_aktif' => 'nullable|boolean'
        ]);

        $user = Auth::user();
        $dokter = $user->dokter;

        if ($request->boolean('is_aktif')) {
            JadwalPeriksa::where('id_dokter', $dokter->id)->update(['is_aktif' => false]);
        }
        JadwalPeriksa::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'is_aktif' => $request->boolean('is_aktif'),
        ]);

        return redirect()->route('dokter.poli.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }
}
