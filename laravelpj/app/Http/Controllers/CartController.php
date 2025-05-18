<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudProduct;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = CrudProduct::findOrFail($id);
        $cart = session()->get('cart', []);

        $cart[$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1,
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng thành công!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('page.CartProduct', compact('cart'));
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->route('cart.view')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Tăng số lượng
        if ($request->has('increase')) {
            $id = $request->input('increase');
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            }
        }

        // Giảm số lượng
        if ($request->has('decrease')) {
            $id = $request->input('decrease');
            if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
        }

        // Thanh toán (checkout)
        if ($request->has('checkout')) {
            $selected = $request->input('selected', []);
            session(['selected_items' => $selected]);

            $cart = session()->get('cart', []);
            $total = 0;
            foreach ($selected as $id) {
                if (isset($cart[$id])) {
                    $total += $cart[$id]['price'] * $cart[$id]['quantity'];
                }
            }

            return redirect()->route('payment.form', ['total' => $total]);
        }
        

        session()->put('cart', $cart);
        return redirect()->route('cart.view');
        
    }
    
}
