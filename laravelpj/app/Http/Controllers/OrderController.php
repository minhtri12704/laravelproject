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

    // Hiển thị form tạo mới
    public function create()
    {
        return view('crud_order.create_order');
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
    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Không tìm thấy đơn hàng.');
        }
        return view('crud_order.edit_order', compact('order'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ten_don_hang' => 'required|string|max:255',
            'ten_khach_hang' => 'required|string|max:255',
            'tong_tien' => 'nullable|numeric',
            'phuong_thuc_thanh_toan' => 'required|string',
            'trang_thai' => 'required|string',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $order = Order::find($id);
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        $order->update($validated);
        return redirect()->route('orders.index');
    }
     // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
        }
        return redirect()->back();
    }
    // hiện chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        return view('crud_order.show_order', compact('order'));
    }
}