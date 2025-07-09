<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dokumen;
use App\Models\JenisDokumen;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{

    public function index(Request $request)
    {
        $jenisDokumen = JenisDokumen::all();

        // Query filter pencarian
        $dokumenQuery = Dokumen::with('jenisDokumen');

        if ($request->filled('area') && $request->area !== 'Jenis Dokumen') {
            $dokumenQuery->whereHas('jenisDokumen', function ($query) use ($request) {
                $query->where('nama', $request->area);
            });
        }

        if ($request->filled('nomor')) {
            $dokumenQuery->where('nomor', 'like', '%' . $request->nomor . '%');
        }

        if ($request->filled('tahun') && $request->tahun !== 'Tahun') {
            $dokumenQuery->where('tahun', $request->tahun);
        }

        if ($request->filled('kata_kunci') && $request->kata_kunci !== 'kata_kunci') {
            $dokumenQuery->where('kata_kunci', $request->kata_kunci);
        }

        $searchResults = $dokumenQuery->get();

        // 🔍 Ambil data untuk grafik: jumlah dokumen per jenis per tahun
        $years = range(date('Y'), 2021); // Ubah sesuai range tahun yang diinginkan
        $jenisList = JenisDokumen::pluck('nama'); // ["Perda", "Perwal", "SK Wali", dll]

        $chartData = [];

        foreach ($jenisList as $jenis) {
            $dataPerTahun = [];

            foreach ($years as $year) {
                $count = Dokumen::where('tahun', $year)
                    ->whereHas('jenisDokumen', function ($q) use ($jenis) {
                        $q->where('nama', $jenis);
                    })->count();

                $dataPerTahun[] = $count;
            }

            $chartData[] = [
                'label' => $jenis,
                'data' => $dataPerTahun,
                'backgroundColor' => '#' . substr(md5($jenis), 0, 6) // warna random dari nama
            ];
        }
        $statistik = [
            'Peraturan Gubernur' => Dokumen::whereHas('jenisDokumen', function ($q) {
                $q->where('nama', 'Peraturan Gubernur');
            })->count(),

            'Peraturan Daerah' => Dokumen::whereHas('jenisDokumen', function ($q) {
                $q->where('nama', 'Peraturan Daerah');
            })->count(),

            'Naskah Akademik' => Dokumen::whereHas('jenisDokumen', function ($q) {
                $q->where('nama', 'Naskah Akademik');
            })->count(),
        ];

        $total = array_sum($statistik);

        $dokumenTerbaru = Dokumen::with('jenisDokumen')
            ->orderBy('created_at', 'desc')
            ->paginate(3); // paginate 6 per halaman

        $beritaTerbaru = Berita::latest()->paginate(3);


        return view('pages.frontend.index', compact('beritaTerbaru', 'searchResults', 'jenisDokumen', 'chartData', 'years', 'statistik', 'total', 'dokumenTerbaru'));
    }

    public function showBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('pages.frontend.berita', compact('berita'));
    }



    public function send(Request $request)
    {
        $request->validate(['message' => 'required|string', 'receiver_id' => 'required|exists:users,id']);

        $message = Message::create([
            'sender_id' => auth()->id() ?? session()->getId(),
            'receiver_id' => $request->receiver_id,  // Menambahkan receiver_id
            'message' => $request->message,
            'is_admin' => auth()->check() && auth()->user()->roles === 'ADMIN',
        ]);

        return response()->json([
            'status' => 'sent',
            'message' => $message // Kirim pesan yang baru saja disimpan
        ]);
    }



    public function getMessages()
    {
        // Pastikan untuk mendapatkan pesan hanya antara pengirim dan penerima yang sesuai
        $messages = Message::where(function ($query) {
            $query->where('sender_id', auth()->id())
                ->orWhere('receiver_id', auth()->id());
        })
            ->with('sender')  // Mengambil informasi pengirim
            ->get();

        return response()->json(['messages' => $messages]);
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
