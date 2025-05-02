<?php

namespace App\Http\Controllers;

use App\Models\KategoriTindakPidana;
use Illuminate\Http\Request;

class KategoriPidanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = KategoriTindakPidana::all();
        return view('pages.kategoripidana.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kategoripidana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_kategori_pidana' => 'required|string|max:255',
            'nama_kategori' => 'required|string|max:15',

        ]);

        // Buat instansiasi model
        $kategori = new KategoriTindakPidana;

        // Isi model dengan data dari request
        $kategori->no_kategori_pidana = $request->no_kategori_pidana;
        $kategori->nama_kategori = $request->nama_kategori;


        // Simpan data ke database
        $kategori->save();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.kategoripidana.index')->with('success', 'Data Kategori Berhasil Di buat');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $kategori = KategoriTindakPidana::find($id);

        // Jika kategori ditemukan, hapus data tersebut
        if ($kategori) {
            $kategori->delete();
            return redirect()->route('dashboard.kategoripidana.index')->with('success', 'Kategori tindak pidana berhasil dihapus.');
        } else {
            return redirect()->route('dashboard.kategoripidana.index')->with('error', 'Kategori tindak pidana tidak ditemukan.');
        }
    }
}
