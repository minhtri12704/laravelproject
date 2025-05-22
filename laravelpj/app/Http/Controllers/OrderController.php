<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('crud_order.crud_Order', compact('orders'));
    }

    // Lưu đơn hàng mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_don_hang' => 'required|string|max:255',
            'ten_khach_hang' => 'required|string|max:255',
            'tong_tien' => 'nullable|numeric',
            'phuong_thuc_thanh_toan' => 'required|string',
            'trang_thai' => 'required|string',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        Order::create($validated);
        return redirect()->route('orders.index');
    }
}