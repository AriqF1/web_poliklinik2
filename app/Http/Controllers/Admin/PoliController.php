<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Poli;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pasien = User::where('id', Auth::id())->first();
        $polis = Poli::withCount('dokter')->get();
        $totalPoli = Poli::count();
        $jadwals = JadwalPeriksa::all();
        return view('pasien.poli.index', compact('pasien', 'polis', 'totalPoli', 'jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string',
        ]);

        $idPasien = Auth::user()->pasien->id;

        $jumlahPendaftar = DaftarPoli::where('id_jadwal', $request->id_jadwal)->count();
        $noAntrian = $jumlahPendaftar + 1;

        DaftarPoli::create([
            'id_pasien' => $idPasien,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);
        return redirect()->back()->with('success', 'Berhasil mendaftar ke poli.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Poli $poli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poli $poli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poli $poli)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poli $poli)
    {
        //
    }
}
