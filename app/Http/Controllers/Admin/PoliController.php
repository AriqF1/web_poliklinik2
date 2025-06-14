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
        $jadwals = JadwalPeriksa::with('dokter.user', 'dokter.poli')->get();
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
            'id_jadwal' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required|string',
        ]);

        $user = Auth::user();
        $idPasien = $user->id;

        DB::beginTransaction();

        try {
            // Lock semua baris daftar_polis untuk jadwal ini
            $jumlahPendaftar = DaftarPoli::where('id_jadwal', $request->id_jadwal)
                ->lockForUpdate()
                ->count();

            $noAntrian = $jumlahPendaftar + 1;

            DaftarPoli::create([
                'id_pasien' => $idPasien,
                'id_jadwal' => $request->id_jadwal,
                'keluhan' => $request->keluhan,
                'no_antrian' => $noAntrian,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mendaftar ke poli.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mendaftar: ' . $e->getMessage());
        }
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
