<?php

namespace App\Http\Controllers;

use App\Models\Pengacara;
use Illuminate\Http\Request;

class PengacaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengacaras = Pengacara::all();
        return view('pages.pengacara.index', compact('pengacaras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengacara.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pengacara' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_pengacara' => 'required|string|max:255',
            'email_pengacara' => 'required|email|unique:pengacaras,email_pengacara',
        ]);

        // Buat instansiasi model
        $pengacara = new Pengacara;

        // Isi model dengan data dari request
        $pengacara->nama_pengacara = $request->nama_pengacara;
        $pengacara->nomor_telepon = $request->nomor_telepon;
        $pengacara->alamat_pengacara = $request->alamat_pengacara;
        $pengacara->email_pengacara = $request->email_pengacara;

        // Simpan data ke database
        $pengacara->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.pengacara.index')->with('success', 'Data pengacara berhasil disimpan');
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
    public function edit(Pengacara $pengacara)
    {
        return view('pages.pengacara.edit', [
            'item' => $pengacara,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengacara $pengacara)
    {
        // Validasi input
        $request->validate([
            'nama_pengacara' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_pengacara' => 'required|string|max:255',
            'email_pengacara' => 'required|email|unique:pengacaras,email_pengacara,' . $pengacara->id,
        ]);

        // Update data pengacara
        $pengacara->update([
            'nama_pengacara' => $request->nama_pengacara,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat_pengacara' => $request->alamat_pengacara,
            'email_pengacara' => $request->email_pengacara,
        ]);

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.pengacara.index')->with('success', 'Data pengacara berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengacara $pengacara)
    {
        // Hapus data pengacara
        $pengacara->delete();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.pengacara.index')->with('success', 'Data pengacara berhasil dihapus');
    }
}
