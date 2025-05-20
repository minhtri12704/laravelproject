<?php

// app/Http/Controllers/GuestChatController.php

namespace App\Http\Controllers;

use App\Models\KhachHang;
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

    public function viewMessages(Request $request)
    {
        $customerId = $request->query('customer_id'); // hoặc từ session nếu đã login

        $messages = ChatMessage::where('customer_id', $customerId)
            ->orderBy('created_at', 'asc')
            ->with('user') // để lấy tên admin
            ->get();

        $khach = KhachHang::where('idKhach', $customerId)->first();

        return view('dashboardHomePage', compact('messages', 'khach'));
    }
    public function getMessages(Request $request)
    {
        return ChatMessage::with('user:id,name') // chỉ lấy name của user để nhẹ hơn
    ->where('customer_id', $request->customer_id)
    ->orderBy('created_at')
    ->get(['id', 'user_id', 'message', 'created_at']); // thêm id


    }
}
