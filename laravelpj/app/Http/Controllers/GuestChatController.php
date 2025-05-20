<?php

// app/Http/Controllers/GuestChatController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;

class GuestChatController extends Controller
{
    public function showForm()
    {
        return view('guest.chat_form');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:khach_hangs,idKhach',
            'message' => 'required|string|max:1000',
        ]);

        ChatMessage::create([
            'customer_id' => $request->customer_id,
            'message'     => $request->message,
            'is_bot'      => false,
        ]);

        return redirect()->back()->with('success', 'Tin nhắn của bạn đã được gửi!');
    }
}
