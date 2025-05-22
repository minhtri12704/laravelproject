<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\KhachHang;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng admin
    public function index()
    {
        $orders = Order::with('khachHang')->orderBy('id')->paginate(10);
        return view('crud_order.crud_Order', compact('orders'));
    }

    // Hiển thị danh sách đơn hàng của khách hàng cụ thể
    public function indexGuest($id)
    {
        $khach = KhachHang::findOrFail($id); // lấy thông tin khách
        $orders = Order::where('khach_hang_id', $id)->latest()->get(); // lấy các đơn hàng theo ID

        return view('page.OrderInform', compact('orders', 'khach'));
    }


    // Hiển thị form tạo đơn hàng
    public function create()
    {
        $khachHangs = KhachHang::all(); // Để tạo dropdown chọn khách hàng
        return view('crud_order.create_order', compact('khachHangs'));
    }

    // Lưu đơn hàng mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_don_hang' => 'required|string|max:255',
            'khach_hang_id' => 'required|exists:khach_hangs,idKhach',
            'tong_tien' => 'nullable|numeric',
            'phuong_thuc_thanh_toan' => 'required|string',
            'trang_thai' => 'required|string',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        Order::create($validated);
        return redirect()->route('orders.index')->with('success', 'Tạo đơn hàng thành công!');
    }

    // Hiển thị form chỉnh sửa đơn hàng
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $khachHangs = KhachHang::all(); // Cho phép chọn lại khách hàng
        return view('crud_order.edit_order', compact('order', 'khachHangs'));
    }

    // Cập nhật đơn hàng
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ten_don_hang' => 'required|string|max:255',
            'khach_hang_id' => 'required|exists:khach_hangs,idKhach',
            'tong_tien' => 'nullable|numeric',
            'phuong_thuc_thanh_toan' => 'required|string',
            'trang_thai' => 'required|string',
            'ghi_chu' => 'nullable|string|max:255',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }

    // Xóa đơn hàng
    public function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
        }
        return redirect()->back()->with('success', 'Xóa đơn hàng thành công!');
    }

    // Hiện chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with('khachHang')->findOrFail($id);
        return view('crud_order.show_order', compact('order'));
    }
}
