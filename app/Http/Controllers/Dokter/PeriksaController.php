<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Periksa;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function riwayat()
    {
        $dokter = Auth::user()->dokter;
        $riwayat = Periksa::with([
            'daftarPoli.pasien',
            'detailPeriksa.obat',
        ])
            ->whereHas('daftarPoli.jadwalPeriksa', function ($query) use ($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->get();
        return view('dokter.riwayat.index', compact('dokter', 'riwayat'));
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
            'obat_ids' => 'nullable|array',
            'obat_ids.*' => 'exists:obats,id',
        ]);

        $biayaDefaultPemeriksaan = 150000;

        $totalBiayaObat = 0;
        if (!empty($request->obat_ids)) {
            $obatsTerpilih = Obat::whereIn('id', $request->obat_ids)->get();
            foreach ($obatsTerpilih as $obat) {
                $totalBiayaObat += $obat->harga;
            }
        }

        $biayaPeriksaFinal = $biayaDefaultPemeriksaan + $totalBiayaObat;

        DB::beginTransaction();

        try {
            $periksa = Periksa::create([
                'id_daftar_poli' => $request->id_daftar_poli,
                'tgl_periksa' => $request->tgl_periksa,
                'catatan' => $request->catatan,
                'biaya_periksa' => $biayaPeriksaFinal,
            ]);

            if (!empty($request->obat_ids)) {
                foreach ($request->obat_ids as $obatId) {
                    DetailPeriksa::create([
                        'id_periksa' => $periksa->id,
                        'id_obat' => $obatId,
                    ]);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Pemeriksaan berhasil disimpan dengan total biaya: Rp ' . number_format($biayaPeriksaFinal, 0, ',', '.'));
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan pemeriksaan: ' . $e->getMessage());
        }
    }
}
