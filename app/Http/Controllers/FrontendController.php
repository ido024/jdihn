<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\JenisDokumen;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $jenisDokumen = JenisDokumen::all();

        // Inisialisasi query dokumen
        $dokumenQuery = Dokumen::with('jenisDokumen');

        // Cek apakah ada input untuk filter jenis dokumen
        if ($request->filled('area') && $request->area !== 'Jenis Dokumen') {
            $dokumenQuery->whereHas('jenisDokumen', function ($query) use ($request) {
                $query->where('nama', $request->area);
            });
        }

        // Cek apakah ada input untuk filter nomor dokumen
        if ($request->filled('nomor')) {
            $dokumenQuery->where('nomor', 'like', '%' . $request->nomor . '%');
        }

        // Cek apakah ada input untuk filter tahun dokumen
        if ($request->filled('tahun') && $request->tahun !== 'Tahun') {
            $dokumenQuery->where('tahun', $request->tahun);
        }

        // Ambil hasil pencarian
        $searchResults = $dokumenQuery->get();

        // Kembalikan ke tampilan dengan hasil pencarian
        return view('pages.frontend.index', compact('searchResults', 'jenisDokumen'));
    }





    public function profile() {}

    public function products()
    {
        $jenisDocuments = JenisDokumen::with('documents')->get(); // eager load dokumen per jenis
        return view('pages.frontend.product', compact('jenisDocuments'));
    }

    public function productDetails($id)
    {
        $dokumen = Dokumen::with('jenisDokumen')->findOrFail($id);
        $jenisDocuments = JenisDokumen::where('id', $dokumen->jenis_dokuemn_id)->first(); // eager load dokumen per jenis
        return view('pages.frontend.product-detail', compact('dokumen', 'jenisDocuments'));
    }

    public function documents() {}

    public function dasarHukum() {}

    public function visiMisi() {}

    public function strukturOrganisasi() {}

    public function strukturJDH() {}
}
