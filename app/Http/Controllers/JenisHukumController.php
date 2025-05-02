<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;

class JenisHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisdocuments = JenisDokumen::all();
        return view('pages.jenisdocument.index', compact('jenisdocuments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.jenisdocument.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        JenisDokumen::create($validated);

        return redirect()->route('dashboard.jenisdocument.index')->with('success', 'jenisdocument Hukum berhasil disimpan.');
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
        // Mencari JenisDokumen berdasarkan ID
        $jenisdocuments = JenisDokumen::findOrFail($id);

        // Mengembalikan view dengan data jenisdocument hukum yang ditemukan
        return view('pages.jenisdocument.edit', compact('jenisdocuments'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',

        ]);

        // Mencari JenisDokumen berdasarkan ID
        $jenisdocuments = JenisDokumen::findOrFail($id);

        // Update data jenisdocument hukum dengan data validasi
        $jenisdocuments->update($validated);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.jenisdocument.index')->with('success', 'jenisdocument Hukum berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari JenisDokumen berdasarkan ID
        $jenisdocuments = JenisDokumen::findOrFail($id);

        // Menghapus jenisdocument hukum dari database
        $jenisdocuments->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.jenisdocument.index')->with('success', 'jenisdocument Hukum berhasil dihapus.');
    }
}
