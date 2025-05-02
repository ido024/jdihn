<?php

namespace App\Http\Controllers;

use App\Models\Perkara;
use App\Models\Sidang;
use Illuminate\Http\Request;

class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sidangs = Sidang::all();
        return view('pages.sidang.index', compact('sidangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambahkan sidang baru
        $perkaras = Perkara::all();
        return view('pages.sidang.create', compact('perkaras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'perkara_id' => 'nullable|exists:perkaras,id',
            'tgl_sidang' => 'nullable|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'ruang_sidang' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        Sidang::create($request->all());

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.sidang.index')->with('success', 'Data sidang berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Menampilkan halaman detail untuk sidang tertentu
        $sidang = Sidang::findOrFail($id);
        return view('pages.sidang.show', compact('sidang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form untuk mengedit sidang
        $sidang = Sidang::findOrFail($id);
        return view('pages.sidang.edit', compact('sidang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'perkara_id' => 'nullable|exists:perkaras,id',
            'tgl_sidang' => 'nullable|date',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i',
            'ruang_sidang' => 'nullable|string|max:255',
        ]);

        // Dapatkan dan update data sidang
        $sidang = Sidang::findOrFail($id);
        $sidang->update($request->all());

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.sidang.index')->with('success', 'Data sidang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hapus data sidang
        $sidang = Sidang::findOrFail($id);
        $sidang->delete();

        // Redirect atau response sesuai kebutuhan
        return redirect()->route('dashboard.sidang.index')->with('success', 'Data sidang berhasil dihapus');
    }
}
