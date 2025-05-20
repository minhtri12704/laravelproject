<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;

class PaymentController extends Controller
{
    public function showForm(Request $request)
    {
        $total = $request->query('total', session('cart_total', 0));
        $selectedItems = session('selected_items', []);
        return view('page.payment', compact('total', 'selectedItems'));
    }

    public function process(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email',
            'address'         => 'required|string|max:255',
            'amount'          => 'required|string', // dùng string nếu format tiền
            'payment_method'  => 'required|in:cash,bank',
        ]);

        // Làm sạch amount (nếu có dấu phẩy)
        $amount = (float) str_replace(',', '', $request->amount);
        $validated['amount'] = $amount;

        // Ghi vào bảng payments (nếu muốn giữ lại)
        $payment = Payment::create($validated);

        // Tính tổng số lượng sản phẩm đã chọn
        $cart = session()->get('cart', []);
        $selected = session('selected_items', []);
        $totalQty = 0;

        foreach ($selected as $id) {
            if (isset($cart[$id])) {
                $totalQty += $cart[$id]['quantity'];
            }
        }

        // Ghi vào bảng đơn hàng
        Order::create([
        'ten_don_hang' => 'ĐH-' . now()->format('YmdHis'),
        'ten_khach_hang' => $validated['name'],
        'so_luong'                => count(session('selected_items', [])),
        'tong_tien' => $amount,
        'phuong_thuc_thanh_toan' => $validated['payment_method'],
        'trang_thai' => 'Chưa xử lý',
        'ghi_chu' => 'Tạo từ form thanh toán',
    ]);

        // Xóa sản phẩm đã chọn
        foreach ($selected as $id) {
            unset($cart[$id]);
        }

        // Xóa session giỏ hàng sau khi thanh toán
        session()->forget('cart');
        session()->forget('selected_items');
        session()->forget('cart_total');

        // (tuỳ bạn có thể redirect qua trang cảm ơn hoặc quay về trang giỏ hàng)
        return redirect()->route('cart.view')->with('success', 'Thanh toán thành công, giỏ hàng đã được xóa!');
    }
}