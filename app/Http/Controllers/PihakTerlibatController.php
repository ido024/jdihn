<?php

namespace App\Http\Controllers;

use App\Models\Perkara;
use App\Models\PihakTerlibat;
use Illuminate\Http\Request;

class PihakTerlibatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pts = PihakTerlibat::all();
        return view('pages.pihakterlibat.index', compact('pts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perkaras = Perkara::all();
        return view('pages.pihakterlibat.create', compact('perkaras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'perkara_id' => 'nullable',
            'no_pihak_t' => 'nullable',
            'nama_pihak' => 'required',
            'alamat' => 'nullable',
            'tipe_pihak' => 'nullable',
            'no_hp_pihak_terlibat' => 'nullable',
            'file_1' => 'required|mimes:doc,docx,pdf|max:10240', // maksimal 2MB
        ]);

        // Upload file
        $file1 = $request->file('file_1')->store('pihak_terlibat', 'public');

        // Buat pihak terlibat baru
        $pihakTerlibat = PihakTerlibat::create([
            'perkara_id' => $request->perkara_id,
            'no_pihak_t' => $request->no_pihak_t,
            'nama_pihak' => $request->nama_pihak,
            'alamat' => $request->alamat,
            'tipe_pihak' => $request->tipe_pihak,
            'no_hp_pihak_terlibat' => $request->no_hp_pihak_terlibat,
            'file_1' => $file1,
            'type_1' => $request->file('file_1')->getClientOriginalExtension(),
            'size_1' => $request->file('file_1')->getSize(),
        ]);

        return redirect()->route('dashboard.pihakterlibat.index')->with('success', 'Pihak Terlibat berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PihakTerlibat $pihakterlibat)
    {
        // Validasi input
        $request->validate([
            'nama_pihak' => 'required',
            'alamat' => 'nullable',
            'tipe_pihak' => 'nullable',
            'no_hp_pihak_terlibat' => 'nullable',
        ]);

        // Update pihak terlibat
        $pihakterlibat->update([
            'nama_pihak' => $request->nama_pihak,
            'alamat' => $request->alamat,
            'tipe_pihak' => $request->tipe_pihak,
            'no_hp_pihak_terlibat' => $request->no_hp_pihak_terlibat,
        ]);

        return redirect()->route('dashboard.pihakterlibat.index')->with('success', 'Pihak Terlibat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(PihakTerlibat $pihakterlibat)
    {
        // Hapus pihak terlibat
        $pihakterlibat->delete();

        return redirect()->route('dashboard.pihakterlibat.index')->with('success', 'Pihak Terlibat berhasil dihapus');
    }
}
