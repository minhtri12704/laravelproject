<?php

// app/Http/Controllers/ChatController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    public function index()
    {
        // Lấy toàn bộ tin nhắn mới nhất
        $messages = ChatMessage::with('customer', 'user')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('crud_user.ChatAdmin', compact('messages'));
    }

    public function reply(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:khach_hangs,id',
            'message' => 'required|string',
        ]);

        ChatMessage::create([
            'user_id'     => auth()->id(), // admin đang login
            'customer_id' => $request->customer_id,
            'message'     => $request->message,
            'is_bot'      => false,
        ]);

        return back()->with('success', 'Phản hồi đã được gửi!');
    }
}

