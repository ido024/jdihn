<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'message' => 'required|string',
                'receiver_id' => 'required|integer',
            ]);

            // Menyimpan pesan ke database
            $message = Message::create([
                'message' => $request->message,
                'sender_id' => auth()->user()->id, // ID pengirim (user)
                'receiver_id' => 1, // ID penerima (admin)

            ]);

            return response()->json([
                'status' => 'sent',
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangani dan kirimkan respons error
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengirim pesan: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function getMessages()
    {
        // Ambil semua pesan yang sesuai dengan receiver_id
        $messages = Message::where(function ($query) {
            $query->where('receiver_id', auth()->user()->id)
                ->orWhere('sender_id', auth()->user()->id);
        })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'messages' => $messages,
        ]);
    }
}
