<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class DashboardChatController extends Controller
{
    // Menampilkan daftar pesan
    public function index()
    {
        // Ambil semua pesan yang melibatkan admin
        $getallMessages = Message::with(['sender', 'receiver'])
            ->where('receiver_id', auth()->id())
            ->orWhere('sender_id', auth()->id())
            ->orderBy('created_at')
            ->get();

        // Ambil semua user yang pernah chat dengan admin
        $users = $getallMessages->map(function ($message) {
            // Jika admin sebagai receiver, ambil sender
            if ($message->receiver_id == auth()->id()) {
                return $message->sender;
            }
            // Jika admin sebagai sender, ambil receiver
            return $message->receiver;
        })->unique('id')->values();

        return view('pages.chats.index', compact('getallMessages', 'users'));
    }





    // Mendapatkan percakapan dengan user tertentu
    public function getMessages($userId)
    {
        // Ambil pesan yang relevan berdasarkan user yang dipilih
        $messages = Message::with(['sender', 'receiver'])
            ->where(function ($query) use ($userId) {
                // Ambil percakapan antara user dan admin
                $query->where('sender_id', $userId)
                    ->where('receiver_id', auth()->id());
            })
            ->orWhere(function ($query) use ($userId) {
                // Ambil percakapan admin ke user
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $userId);
            })
            ->orderBy('created_at')
            ->get();

        // Kembalikan data pesan sebagai JSON
        return response()->json(['messages' => $messages]);
    }

    // Mengirim pesan dari admin ke user
    public function sendMessage(Request $request)
    {
        // Validasi input pesan
        $validated = $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|integer',
            'receiver_id' => 'required|integer',
        ]);

        // Menyimpan pesan yang dikirim admin ke user
        $message = Message::create([
            'sender_id' => auth()->id(), // Admin sebagai pengirim
            'receiver_id' => $validated['receiver_id'], // ID user yang menerima
            'message' => $validated['message'], // Isi pesan
            'is_admin' => true, // Menandakan bahwa ini pesan dari admin
        ]);

        // Kembalikan response sukses dengan pesan yang baru dibuat
        return response()->json(['success' => true, 'message' => $message]);
    }
}
