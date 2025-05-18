<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudProduct;

class CartController extends Controller
{
    // Hàm thêm sản phẩm vào giỏ hàng (dùng lại nhiều nơi)
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

    // Nhận request thêm sản phẩm vào giỏ hàng theo product_id
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = CrudProduct::findOrFail($productId);

        $this->addProductToCart($product);

        return redirect()->route('cart.view')->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    // Bạn có thể dùng hàm này ở những chỗ khác cũng được:
    public function addProductById($id)
    {
        $product = CrudProduct::findOrFail($id);
        $this->addProductToCart($product);
        // Ví dụ redirect về trang hiện tại hoặc trang giỏ hàng
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    // Phần còn lại giữ nguyên
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('page.CartProduct', compact('cart'));
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.view')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

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

        if ($request->has('checkout')) {
            session()->forget('cart');
            return redirect()->route('cart.view')->with('success', 'Thanh toán thành công!');
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.view');
    }
}
