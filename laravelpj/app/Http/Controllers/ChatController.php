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
            'customer_id' => 'required|exists:khach_hangs,idKhach',
            'message' => 'required|string',
        ]);

        ChatMessage::create([
            'user_id'     => auth()->id(),
            'customer_id' => $request->customer_id,
            'message'     => $request->message,
            'is_bot'      => false,
        ]);
        if (!auth()->check()) {
            dd('Chưa đăng nhập, user_id = null');
        }

        dd('Đã login, user_id = ' . auth()->id());

        return back()->with('success', 'Phản hồi đã được gửi!');
    }
}
