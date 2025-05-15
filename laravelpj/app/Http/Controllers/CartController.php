<?php

// app/Http/Controllers/CartController.php
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
}
