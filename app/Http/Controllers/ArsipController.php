<?php

namespace App\Http\Controllers;

use App\Models\ArsipPerkara;
use App\Models\Perkara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arsips = ArsipPerkara::all();
        return view('pages.arsip.index', compact('arsips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perkaras = Perkara::all();
        return view('pages.arsip.create', compact('perkaras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'perkara_id' => 'nullable',
            'tgl_arsip' => 'nullable',
            'file_1' => 'required|file|mimes:doc,docx,xls,xlsx,pdf|max:10000',
            'file_2' => 'file|mimes:doc,docx,xls,xlsx,pdf|max:10000',
            'file_3' => 'file|mimes:doc,docx,xls,xlsx,pdf|max:10000',
            'file_4' => 'file|mimes:doc,docx,xls,xlsx,pdf|max:10000',
            'file_5' => 'file|mimes:doc,docx,xls,xlsx,pdf|max:10000',
        ]);

        // Mengambil nilai tgl_arsip dari permintaan
        $tgl_arsip = $request->tgl_arsip;

        // Inisialisasi array untuk menyimpan data file
        $filesData = [
            'tgl_arsip' => $tgl_arsip
        ];

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("file_$i")) {
                $file = $request->file("file_$i");
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public', $fileName);
                $filesData["file_$i"] = $fileName;
                $filesData["type_$i"] = $file->getClientMimeType();
                $filesData["size_$i"] = $file->getSize();
            }
        }

        $filesData['perkara_id'] = $validatedData['perkara_id'] ?? null;

        ArsipPerkara::create($filesData);

        return redirect()->route('dashboard.arsip.index')->with('success', 'Data Arsip Telah Di Tambahkan');
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
        // Hapus data arsip
        $arsip = ArsipPerkara::findOrFail($id);
        $arsip->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.arsip.index')->with('success', 'Data arsip berhasil dihapus');
    }
}
