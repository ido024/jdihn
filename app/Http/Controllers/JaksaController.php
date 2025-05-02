<?php

namespace App\Http\Controllers;

use App\Models\Jaksa;
use Illuminate\Http\Request;

class JaksaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jaksas = Jaksa::all();
        return view('pages.jaksa.index', compact('jaksas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jaksa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_jaksa' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_jaksa' => 'required|string|max:255',
            'email_jaksa' => 'required|email|unique:jaksas,email_jaksa',
        ]);

        // Buat instansiasi model
        $jaksa = new Jaksa;

        // Isi model dengan data dari request
        $jaksa->nama_jaksa = $request->nama_jaksa;
        $jaksa->nomor_telepon = $request->nomor_telepon;
        $jaksa->alamat_jaksa = $request->alamat_jaksa;
        $jaksa->email_jaksa = $request->email_jaksa;

        // Simpan data ke database
        $jaksa->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.jaksa.index')->with('success', 'Data jaksa berhasil disimpan');
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
    public function edit(Jaksa $jaksa)
    {
        return view('pages.jaksa.edit', [
            'item' => $jaksa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jaksa $jaksa)
    {
        // Validasi input
        $request->validate([
            'nama_jaksa' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
            'alamat_jaksa' => 'required|string|max:255',
            'email_jaksa' => 'required|email|unique:jaksas,email_jaksa,' . $jaksa->id,
        ]);

        // Update data jaksa
        $jaksa->update([
            'nama_jaksa' => $request->nama_jaksa,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat_jaksa' => $request->alamat_jaksa,
            'email_jaksa' => $request->email_jaksa,
        ]);

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.jaksa.index')->with('success', 'Data jaksa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jaksa $jaksa)
    {
        // Hapus data jaksa
        $jaksa->delete();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.jaksa.index')->with('success', 'Data jaksa berhasil dihapus');
    }
}
