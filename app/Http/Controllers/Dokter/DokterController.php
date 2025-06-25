<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Poli;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function update()
    {
        $dokter = Auth::user();
        $polis = Poli::all();
        return view('dokter.update', compact('dokter', 'polis'));
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:6|confirmed',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'poli_id' => 'nullable|exists:polis,id',
        ]);

        $user = Auth::user();
        $dokter = $user->dokter;

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = $request->password;
        }
        $user->save();

        $dokter->update([
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'poli_id' => $request->poli_id,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
