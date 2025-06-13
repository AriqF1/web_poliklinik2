<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PeriksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokter = Auth::user();
        $userId = $dokter->id;
        $obats = Obat::all();
        $pasienPoli = DaftarPoli::with([
            'pasien.user',
            'jadwalPeriksa.dokter.user',
        ])
            ->whereHas('jadwalPeriksa.dokter', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
        return view('dokter.periksa.index', compact('dokter', 'pasienPoli', 'obats'));
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
            'id_daftar_poli' => 'required|exists:daftar_polis,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat_ids' => 'required|array|min:1',
            'obat_ids.*' => 'exists:obats,id',
        ]);

        $periksa = Periksa::create([
            'id_daftar_poli' => $request->id_daftar_poli,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
        ]);

        // Simpan obat-obat yang dipilih ke detail_periksas
        foreach ($request->obat_ids as $obatId) {
            DetailPeriksa::create([
                'id_periksa' => $periksa->id,
                'id_obat' => $obatId,
            ]);
        }

        return redirect()->back()->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periksa $periksa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periksa $periksa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periksa $periksa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periksa $periksa)
    {
        //
    }
}
