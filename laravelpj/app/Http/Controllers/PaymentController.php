<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Order;
use App\Models\KhachHang;

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
        $request->validate([
        'name'            => ['required', 'string', 'max:50', 'regex:/^[\p{L}\s\-]+$/u'],
        'email'           => ['required', 'email'],
        'address'         => ['required', 'string', 'max:50'],
        'amount'          => ['required', 'string'],
        'payment_method'  => ['required', 'in:cash,bank'],
    ], [
        'name.regex' => 'Họ và tên không được chứa số hoặc khoảng trắng.',
    ]);

    $amount = (float) str_replace(',', '', $request->amount);

    Payment::create([
        'name'           => $request->name,
        'email'          => $request->email,
        'address'        => $request->address,
        'amount'         => $amount,
        'payment_method' => $request->payment_method,
    ]);

    $cart = session()->get('cart', []);
    $selected = session('selected_items', []);

    // Kiểm tra đăng nhập khách hàng
    $khach = Auth::guard('khach')->user();
    if (!$khach) {
        return redirect('/login')->with('error', 'Vui lòng đăng nhập trước khi thanh toán.');
    }

    Order::create([
        'ten_don_hang'           => 'ĐH-' . now()->format('YmdHis'),
        'khach_hang_id'         => $khach->idKhach,
        'tong_tien'             => $amount,
        'phuong_thuc_thanh_toan' => $request->payment_method,
        'trang_thai'            => 'Chưa xử lý',
        'ghi_chu'               => 'Tạo từ form thanh toán',
    ]);

    foreach ($selected as $id) {
        unset($cart[$id]);
    }

    // Xóa session giỏ hàng sau khi thanh toán
    session()->forget('cart');
    session()->forget('selected_items');
    session()->forget('cart_total');

    return redirect()->route('cart.view')->with('success', 'Thanh toán thành công, giỏ hàng đã được xóa!');
    }
}
