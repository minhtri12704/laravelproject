<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudProduct;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $wishlist = session()->get('wishlist', []);

    $productIds = array_keys($wishlist);
    $products = \App\Models\CrudProduct::whereIn('id', $productIds)->get();

    return view('wishlist.show_wishlist', compact('products', 'wishlist'));
    }

    // thêm sản phẩm yêu thíchthích
    public function add($id)
    {
        $wishlist = session()->get('wishlist', []);
    $wishlist[$id] = ($wishlist[$id] ?? 0) + 1;
    session()->put('wishlist', $wishlist);

    return back()->with('success', 'Đã thêm vào yêu thích!');
    }
}