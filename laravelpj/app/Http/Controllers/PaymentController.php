<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Hiển thị form thanh toán với tổng tiền nhận từ cart
     */
    public function showForm(Request $request)
    {
        $total = $request->query('total', 0); // ✅ Lấy từ query string
        return view('page.payment', compact('total'));
    }

    public function process(Request $request)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email',
            'address'         => 'required|string|max:255',
            'amount'          => 'required|numeric|min:0',
            'payment_method'  => 'required|in:cash,bank',
        ]);

        // Lưu thông tin thanh toán vào database
        Payment::create($validated);

        // Lấy giỏ hàng hiện tại
        $cart = session()->get('cart', []);
        $selected = session('selected_items', []);

        // Xoá các sản phẩm đã chọn
        foreach ($selected as $id) {
            unset($cart[$id]);
        }

        // Cập nhật lại session giỏ hàng
        session()->put('cart', $cart);
        session()->forget('selected_items');

        // Quay lại form thanh toán kèm thông báo
        return redirect()->route('payment.form')->with('success', 'Thanh toán thành công!');
    }
}
