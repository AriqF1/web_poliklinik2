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
use Carbon\Carbon;


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
        $jadwals = JadwalPeriksa::with('dokter.user', 'dokter.poli')
            ->where('is_aktif', true)
            ->get()
            ->filter(function ($jadwal) {
                $hariJadwal = $jadwal->hari;
                $jamMulaiJadwal = Carbon::parse($jadwal->jam_mulai);

                $today = Carbon::now();
                $currentDayInIndonesian = $today->isoFormat('dddd');
                $currentTime = $today->copy();
                $hariMap = [
                    'Minggu' => 0,
                    'Senin' => 1,
                    'Selasa' => 2,
                    'Rabu' => 3,
                    'Kamis' => 4,
                    'Jumat' => 5,
                    'Sabtu' => 6
                ];
                $todayOrder = $hariMap[$currentDayInIndonesian] ?? -1;
                $jadwalOrder = $hariMap[$hariJadwal] ?? -1;
                if ($jadwalOrder === -1) {
                    return false;
                }
                if ($jadwalOrder < $todayOrder) {
                    return false;
                }
                if ($jadwalOrder === $todayOrder) {
                    return $jamMulaiJadwal->format('H:i') > $currentTime->format('H:i');
                }
                return true;
            })
            ->values();
        $poliact = Poli::with('dokter.user')->get();
        return view('pasien.poli.index', compact('pasien', 'polis', 'totalPoli', 'jadwals', 'poliact'));
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
        $pasien = $user->pasien;

        DB::beginTransaction();

        try {
            $jumlahPendaftar = DaftarPoli::where('id_jadwal', $request->id_jadwal)
                ->count();

            $noAntrian = $jumlahPendaftar + 1;

            DaftarPoli::create([
                'id_pasien' => $pasien->id,
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
