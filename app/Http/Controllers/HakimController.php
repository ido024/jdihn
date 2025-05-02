<?php

namespace App\Http\Controllers;

use App\Models\Hakim;
use Illuminate\Http\Request;

class HakimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hakims = Hakim::all();
        return view('pages.hakim.index', compact('hakims'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.hakim.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_hakim' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_hakim' => 'required|string|max:255',
            'email_hakim' => 'required|email|unique:hakims,email_hakim',
        ]);

        // Buat instansiasi model
        $hakim = new Hakim;

        // Isi model dengan data dari request
        $hakim->nama_hakim = $request->nama_hakim;
        $hakim->nomor_telepon = $request->nomor_telepon;
        $hakim->alamat_hakim = $request->alamat_hakim;
        $hakim->email_hakim = $request->email_hakim;

        // Simpan data ke database
        $hakim->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.hakim.index')->with('success', 'Data hakim berhasil disimpan');
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
    public function edit(Hakim $hakim)
    {
        return view('pages.hakim.edit', [
            'item' => $hakim,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hakim $hakim)
    {
        // Validasi input
        $request->validate([
            'nama_hakim' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_hakim' => 'required|string|max:255',
            'email_hakim' => 'required|email|unique:hakims,email_hakim,' . $hakim->id,
        ]);

        // Update data hakim
        $hakim->update([
            'nama_hakim' => $request->nama_hakim,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat_hakim' => $request->alamat_hakim,
            'email_hakim' => $request->email_hakim,
        ]);

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.hakim.index')->with('success', 'Data hakim berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hakim $hakim)
    {
        // Hapus data hakim
        $hakim->delete();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.hakim.index')->with('success', 'Data hakim berhasil dihapus');
    }
}
