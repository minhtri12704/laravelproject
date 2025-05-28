<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudProduct;
use App\Models\KhuyenMai;

class CartController extends Controller
{
    // ===== Thêm sản phẩm vào giỏ hàng =====
    protected function addProductToCart(CrudProduct $product)
    {
        if ($product->quantity <= 0) {
            session()->flash('error', 'Sản phẩm đã hết hàng!');
            return false;
        }

        $cart = session()->get('cart', []);
        $id = $product->id;

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] < $product->quantity) {
                $cart[$id]['quantity']++;
            } else {
                session()->flash('error', 'Không thể thêm vượt quá số lượng tồn kho!');
                return false;
            }
        } else {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'price' => $product->gia_km ?? $product->price,
                'image' => $product->image,
                'quantity' => 1,
                'max_quantity' => $product->quantity,
            ];
        }

        session()->put('cart', $cart);
        return true;
    }

    // ===== Thêm sản phẩm bằng product_id =====
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = CrudProduct::findOrFail($productId);

        if (!$this->addProductToCart($product)) {
            return redirect()->back()->with('error', session('error'));
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    // ===== Thêm sản phẩm theo ID (không cần form) =====
    public function addProductById($id)
    {
        $product = CrudProduct::findOrFail($id);

        if (!$this->addProductToCart($product)) {
            return redirect()->back()->with('error', session('error'));
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }

    // ===== Hiển thị giỏ hàng =====
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('page.CartProduct', compact('cart'));
    }

    // ===== Xóa sản phẩm khỏi giỏ =====
    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.view')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // ===== Cập nhật giỏ hàng (tăng / giảm / thanh toán) =====
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Tăng số lượng
        if ($request->has('increase')) {
            $id = $request->input('increase');
            if (isset($cart[$id])) {
                $product = CrudProduct::find($id);
                if ($product && $cart[$id]['quantity'] < $product->quantity) {
                    $cart[$id]['quantity']++;
                } else {
                    return redirect()->route('cart.view')->with('error', 'Không thể tăng vượt quá tồn kho!');
                }
            }
        }

        // Giảm số lượng
        if ($request->has('decrease')) {
            $id = $request->input('decrease');
            if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
        }

        // Thanh toán
        if ($request->has('checkout')) {
            $selected = $request->input('selected', []);
            session(['selected_items' => $selected]);

            $total = 0;
            foreach ($selected as $id) {
                if (isset($cart[$id])) {
                    $total += $cart[$id]['price'] * $cart[$id]['quantity'];
                }
            }

            session()->put('cart_total', $total);
            return redirect()->route('payment.form', [
                'total' => $total,
            ])->with('selected_items', collect($selected)->map(fn($id) => $cart[$id] ?? [])->filter());
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.view');
    }

    // ===== Kiểm tra mã giảm giá =====
    public function checkDiscount(Request $request)
    {
        $code = $request->query('code');

        $phieu = KhuyenMai::where('ma_phieu', $code)
            ->where('ngay_ket_thuc', '>=', now())
            ->first();

        if ($phieu) {
            return response()->json([
                'valid' => true,
                'type' => $phieu->loai_giam,
                'amount' => $phieu->gia_tri
            ]);
        }

        return response()->json(['valid' => false]);
    }
}
