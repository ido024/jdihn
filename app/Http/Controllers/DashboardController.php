<?php

namespace App\Http\Controllers;

use App\Models\ArsipPerkara;
use App\Models\Sidang;
use Carbon\Carbon;
use Illuminate\Http\Request;


use App\Models\Dokumen;
use App\Models\JenisDokumen;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total dokumen
        $totalDokumen = Dokumen::count();

        // Mengambil total ukuran dokumen (dalam satuan KB, bisa disesuaikan jika Anda menggunakan ukuran lain)
        $totalSizeDokumen = Dokumen::sum('size_document') + Dokumen::sum('size_abstrak'); // Menjumlahkan ukuran dokumen dan abstrak

        // Mengambil jumlah dokumen berdasarkan kategori jenis dokumen
        $dokumenKategoriCount = Dokumen::whereHas('jenisDokumen', function ($query) {
            $query->where('nama', 'Kategori Nama');  // Sesuaikan dengan kategori yang ingin dihitung
        })->count();

        // Mengambil jumlah dokumen pelaporan (menyesuaikan tipe konten)
        $dokumenPelaporanCount = Dokumen::where('type_document', 'pelaporan')->count();  // Sesuaikan dengan tipe konten yang diinginkan

        // Mengambil data sidang untuk hari ini
        $date = Carbon::today();
       

        // Mengambil semua jenis dokumen untuk ditampilkan di tampilan
        $jenisDokumen = JenisDokumen::all();

        return view('dashboard', compact(
            'totalDokumen',
            'totalSizeDokumen',
            'dokumenKategoriCount',
            'dokumenPelaporanCount',
          
            'jenisDokumen'
        ));
    }
}
