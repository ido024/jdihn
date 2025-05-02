<?php

namespace App\Http\Controllers;

use App\Models\CatatanPerkara;
use App\Models\Jaksa;
use App\Models\Perkara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatatanPerkaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cps = CatatanPerkara::all();
        return view('pages.catatanperkara.index', compact('cps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perkaras = Perkara::all();
        $jaksas = Jaksa::all();
        return view('pages.catatanperkara.create', compact('perkaras', 'jaksas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'perkara_id' => 'required',
            'no_putusan' => 'required',
            'jaksa_id' => 'required',
            'tgl_catatan' => 'required',
            'isicatatan' => 'required',
            'file_1' => 'required|mimes:doc,docx,pdf,xls,xlsx|max:12048', // maksimal 2MB
        ]);

        // Upload file
        $file1 = $request->file('file_1')->store('catatan_perkara', 'public');

        // Buat catatan baru
        $catatanPerkara = CatatanPerkara::create([
            'perkara_id' => $request->perkara_id,
            'no_putusan' => $request->no_putusan,
            'jaksa_id' => $request->jaksa_id,
            'tgl_catatan' => $request->tgl_catatan,
            'isicatatan' => $request->isicatatan,
            'file_1' => $file1,
            'type_1' => $request->file('file_1')->getClientOriginalExtension(),
            'size_1' => $request->file('file_1')->getSize(),
        ]);

        return redirect()->route('dashboard.catatanperkara.index')->with('success', 'Catatan Perkara created successfully');
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
    public function update(Request $request, CatatanPerkara $catatanperkara)
    {
        // Validasi input
        $request->validate([
            'perkara_id' => 'required',
            'jaksa_id' => 'required',
            'tgl_catatan' => 'required',
            'isicatatan' => 'required',
            'file_1' => 'nullable|mimes:doc,docx,pdf,xls,xlsx|max:2048', // maksimal 2MB
        ]);

        // Jika ada file baru yang diunggah, proses file dan hapus yang lama
        if ($request->hasFile('file_1')) {
            // Validasi file
            $request->validate([
                'file_1' => 'required|mimes:doc,docx,pdf,xls,xlsx|max:2048', // maksimal 2MB
            ]);

            // Hapus file lama
            Storage::delete($catatanperkara->file_1);

            // Upload file baru
            $file1 = $request->file('file_1')->store('catatan_perkara', 'public');

            // Update tipe dan ukuran file
            $catatanperkara->type_1 = $request->file('file_1')->getClientOriginalExtension();
            $catatanperkara->size_1 = $request->file('file_1')->getSize();
            $catatanperkara->file_1 = $file1;
        }

        // Update catatan perkara
        $catatanperkara->update([
            'perkara_id' => $request->perkara_id,
            'jaksa_id' => $request->jaksa_id,
            'tgl_catatan' => $request->tgl_catatan,
            'isicatatan' => $request->isicatatan,
        ]);

        return redirect()->route('dashboard.catatanperkara.index')->with('success', 'Catatan Perkara updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatatanPerkara $catatanperkara)
    {
        // Hapus file terkait
        Storage::delete($catatanperkara->file_1);

        // Hapus catatan perkara
        $catatanperkara->delete();

        return redirect()->route('dashboard.catatanperkara.index')->with('success', 'Catatan Perkara deleted successfully');
    }
}
