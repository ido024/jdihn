<?php

namespace App\Http\Controllers;

use App\Models\ArsipPerkara;
use App\Models\Dokumen;
use App\Models\JenisDokumen;
use App\Models\Perkara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Dokumen::all();

        return view('pages.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisDocuments = JenisDokumen::all();
        return view('pages.documents.create', compact('jenisDocuments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = Validator::make($request->all(), [
            'jenis_dokuemn_id' => 'required',
            'judul' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'subyek' => 'nullable|string|max:255',
            'tgl_penetapan' => 'nullable|date',
            'status' => 'required|in:berlaku,tidak berlaku,diperiksa',
            'penandatanganan' => 'nullable|string|max:255',
            'singkatan_jenis' => 'nullable|string|max:255',
            'tempat_terbit' => 'nullable|string|max:255',
            'asal_dokumen' => 'nullable|string|max:255',
            'sumber' => 'nullable|string|max:255',
            'bahasa' => 'nullable|string|max:255',
            'teu' => 'nullable|string|max:255',
            'kata_kunci' => 'nullable|string|max:255',
            'text_document' => 'nullable|string|max:255',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',  // Maksimal 10MB untuk file dokumen
            'abstrak' => 'nullable|file|mimes:pdf,doc,docx|max:10240',  // Maksimal 10MB untuk file abstrak
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        // Menyimpan data dokumen ke database
        $dokumen = new Dokumen();
        $dokumen->jenis_dokuemn_id = $request->jenis_dokuemn_id;
        $dokumen->judul = $request->judul;
        $dokumen->nomor = $request->nomor;
        $dokumen->tahun = $request->tahun;
        $dokumen->subyek = $request->subyek;
        $dokumen->status = $request->status;
        $dokumen->tgl_penetapan = $request->tgl_penetapan;
        $dokumen->penandatanganan = $request->penandatanganan;
        $dokumen->singkatan_jenis = $request->singkatan_jenis;
        $dokumen->tempat_terbit = $request->tempat_terbit;
        $dokumen->asal_dokumen = $request->asal_dokumen;
        $dokumen->sumber = $request->sumber;
        $dokumen->bahasa = $request->bahasa;
        $dokumen->text_document = $request->text_document;
        $dokumen->kata_kunci = $request->kata_kunci;
        $dokumen->teu = $request->teu;

        // Menyimpan file dokumen jika ada
        if ($request->hasFile('document')) {
            $fileDokumen = $request->file('document');
            $dokumen->document = $fileDokumen->storeAs('dokumen_files', time() . '_dokumen.' . $fileDokumen->getClientOriginalExtension(), 'public');
            $dokumen->type_document = $fileDokumen->getClientMimeType();
            $dokumen->size_document = $fileDokumen->getSize();
        }

        // Menyimpan file abstrak jika ada
        if ($request->hasFile('abstrak')) {
            $fileAbstrak = $request->file('abstrak');
            $dokumen->abstrak = $fileAbstrak->storeAs('dokumen_abstrak', time() . '_abstrak.' . $fileAbstrak->getClientOriginalExtension(), 'public');
            $dokumen->type_abstrak = $fileAbstrak->getClientMimeType();
            $dokumen->size_abstrak = $fileAbstrak->getSize();
        }

        // Simpan data dokumen ke database
        $dokumen->save();

        // Redirect atau beri response sukses
        return redirect()->route('dashboard.documents.index')->with('success', 'Dokumen berhasil disimpan');
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
