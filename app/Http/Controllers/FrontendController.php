<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\JenisDokumen;
use App\Models\Message;
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
