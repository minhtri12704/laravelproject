<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudProduct;
use App\Models\KhuyenMai;


class CartController extends Controller
{
    // Hàm thêm sản phẩm vào giỏ hàng
    protected function addProductToCart(CrudProduct $product)
    {
        $cart = session()->get('cart', []);
        $id = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
    }

    // Thêm sản phẩm bằng product_id
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = CrudProduct::findOrFail($productId);
        $this->addProductToCart($product);

        return redirect()->route('cart.view')->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    // Gọi theo id (không cần qua form)
    public function addProductById($id)
    {
        $product = CrudProduct::findOrFail($id);
        $this->addProductToCart($product);
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    // Hiển thị giỏ hàng
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('page.CartProduct', compact('cart'));
    }

    // Xóa sản phẩm khỏi giỏ
    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.view')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // Cập nhật giỏ hàng (tăng/giảm)
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if ($request->has('increase')) {
            $id = $request->input('increase');
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            }
        }

        if ($request->has('decrease')) {
            $id = $request->input('decrease');
            if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
        }

        // Giả sử bạn xử lý thanh toán ở đây luôn (sau khi nhấn "Mua hàng")
        if ($request->has('checkout')) {
            session()->forget('cart');
            return redirect()->route('cart.view')->with('success', 'Thanh toán thành công!');
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.view');
    }

    public function checkDiscount(Request $request)
{
    $code = $request->query('code');

    $phieu = \App\Models\KhuyenMai::where('ma_phieu', $code)
        ->where('ngay_ket_thuc', '>=', now())
        ->first();

    if ($phieu) {
        return response()->json([
            'valid' => true,
            'type' => $phieu->loai_giam, // 'percent' hoặc 'fixed'
            'amount' => $phieu->gia_tri
        ]);
    }

    return response()->json(['valid' => false]);
}

}
