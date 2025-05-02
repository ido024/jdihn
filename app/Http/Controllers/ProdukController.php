<?php

namespace App\Http\Controllers;

use App\Models\ProdukHukum;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = ProdukHukum::all();
        return view('pages.produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        ProdukHukum::create($validated);

        return redirect()->route('dashboard.produk.index')->with('success', 'Produk Hukum berhasil disimpan.');
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
        // Mencari ProdukHukum berdasarkan ID
        $produkHukum = ProdukHukum::findOrFail($id);

        // Mengembalikan view dengan data produk hukum yang ditemukan
        return view('pages.produk.edit', compact('produkHukum'));
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

        // Mencari ProdukHukum berdasarkan ID
        $produkHukum = ProdukHukum::findOrFail($id);

        // Update data produk hukum dengan data validasi
        $produkHukum->update($validated);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.produk.index')->with('success', 'Produk Hukum berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mencari ProdukHukum berdasarkan ID
        $produkHukum = ProdukHukum::findOrFail($id);

        // Menghapus produk hukum dari database
        $produkHukum->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('dashboard.produk.index')->with('success', 'Produk Hukum berhasil dihapus.');
    }
}
