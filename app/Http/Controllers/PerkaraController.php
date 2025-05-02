<?php

namespace App\Http\Controllers;

use App\Models\CatatanPerkara;
use App\Models\Hakim;
use App\Models\Jaksa;
use App\Models\KategoriTindakPidana;
use App\Models\Penuntut;
use App\Models\Perkara;
use Illuminate\Http\Request;

class PerkaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perkaras = Perkara::all();
        return view('pages.perkara.index', compact('perkaras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hakims = Hakim::all();
        $kategoris = KategoriTindakPidana::all();
        $jaksas = Jaksa::all();
        $catatans = CatatanPerkara::all();
        $jenistindakpidana = KategoriTindakPidana::all();
        $penuntuts =  Penuntut::all();
        return view('pages.perkara.create', [
            'penuntuts' => $penuntuts,
            'hakims' => $hakims,
            'kategoris' => $kategoris,
            'jaksas' => $jaksas,
            'catatans' => $catatans,
            'jenistindakpidana' => $jenistindakpidana,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'penuntut_id' => 'required',
            'hakim_id' => 'required',
            'jaksa_id' => 'required',
            'jenis_tindak_pidana_id' => 'required',
            'nomor_perkara' => 'required',
            'tanggal_pendaftaran' => 'required',
            'alamat_terdakwa' => 'required',
            'status_perkara' => 'required',
        ]);

        // Ambil penuntut_id dari request
        $penuntutId = $request->input('penuntut_id');

        // Cari penuntut berdasarkan ID
        $penuntut = Penuntut::find($penuntutId);

        // Pastikan penuntut ditemukan
        if ($penuntut) {
            // Set tanggal_putusan dengan nilai tgl_tuntutan dari penuntut
            $request->merge(['tanggal_putusan' => $penuntut->tgl_tuntutan]);
            $request->merge(['nama_terdakwa' => $penuntut->nama_terdakwa]);
        }

        // Buat perkara baru dengan data dari request
        $perkara = Perkara::create($request->all());

        return redirect()->route('dashboard.perkara.index')->with('success', 'Perkara created successfully');
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
    public function update(Request $request, Perkara $perkara)
    {
        // Validasi input
        $request->validate([
            'penuntut_id' => 'required',
            'hakim_id' => 'required',
            'jaksa_id' => 'required',
            'jenis_tindak_pidana_id' => 'required',
            'nomor_perkara' => 'required',
            'tanggal_pendaftaran' => 'required',
            'nama_terdakwa' => 'required',
            'tanggal_putusan' => 'required',
            'alamat_terdakwa' => 'required',
            'status_perkara' => 'required',
        ]);

        // Update perkara
        $perkara->update($request->all());

        return redirect()->route('dashboard.perkara.index')->with('success', 'Perkara updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Perkara $perkara)
    {
        // Hapus perkara
        $perkara->delete();

        return redirect()->route('dashboard.perkara.index')->with('success', 'Perkara deleted successfully');
    }
}
