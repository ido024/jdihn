<?php

namespace App\Http\Controllers;

use App\Models\ArsipPerkara;
use App\Models\CatatanPerkara;
use App\Models\Penuntut;
use App\Models\Perkara;
use App\Models\PihakTerlibat;
use App\Models\Sidang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $perkaras = Perkara::all();
        return view('pages.laporanperkara.index', compact('perkaras'));
    }

    public function details(Perkara $perkara)
    {
        $arsips = ArsipPerkara::with('perkara')->where('perkara_id', $perkara->id)->get();
        $pihaksterlibats = PihakTerlibat::with('perkara')->where('perkara_id', $perkara->id)->get();
        $penuntuts = Penuntut::where('id', $perkara->penuntut_id)->get();
        $catatanperkara = CatatanPerkara::with('perkara')->where('perkara_id', $perkara->id)->get();
        $listsidang = Sidang::with('perkara')->where('perkara_id', $perkara->id)->get();
        return view('pages.laporanperkara.show', [
            'perkara' =>  $perkara,
            'arsips' =>  $arsips,
            'pihaksterlibats' =>  $pihaksterlibats,
            'penuntuts' =>  $penuntuts,
            'catatanperkara' =>  $catatanperkara,
            'listsidang' =>  $listsidang,
        ]);
    }
}
