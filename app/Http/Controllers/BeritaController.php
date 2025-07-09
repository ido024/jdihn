<?php
// app/Http/Controllers/BeritaController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    /**
     * Tampilkan semua berita
     */
    public function index()
    {
        $beritas = Berita::latest()->paginate(10);
        return view('pages.berita.index', compact('beritas'));
    }

    /**
     * Form tambah berita
     */
    public function create()
    {
        return view('pages.berita.create');
    }

    /**
     * Simpan berita baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul', 'isi', 'tanggal']);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '-' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads/berita'), $filename);
            $data['gambar'] = $filename;
        }

        Berita::create($data);

        return redirect()->route('dashboard.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail berita
     */
    public function show(Berita $berita)
    {
        return view('berita.show', compact('berita'));
    }

    /**
     * Form edit berita
     */
    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    /**
     * Simpan perubahan berita
     */
    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['judul', 'isi', 'tanggal']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($beritum->gambar && File::exists(public_path('uploads/berita/' . $beritum->gambar))) {
                File::delete(public_path('uploads/berita/' . $beritum->gambar));
            }

            $gambar = $request->file('gambar');
            $filename = time() . '-' . $gambar->getClientOriginalName();
            $gambar->move(public_path('uploads/berita'), $filename);
            $data['gambar'] = $filename;
        }

        $beritum->update($data);

        return redirect()->route('dashboard.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita
     */
    public function destroy(Berita $beritum)
    {
        if ($beritum->gambar && File::exists(public_path('uploads/berita/' . $beritum->gambar))) {
            File::delete(public_path('uploads/berita/' . $beritum->gambar));
        }

        $beritum->delete();

        return redirect()->route('dashboard.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
