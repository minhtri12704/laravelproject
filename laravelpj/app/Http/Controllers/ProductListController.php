<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrudProduct;
use App\Models\Category;

class ProductListController extends Controller
{
    public function index(Request $request)
    {
        $query = CrudProduct::query();

        // Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Lọc theo khoảng giá
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case 1:
                    $query->where('price', '<', 500000);
                    break;
                case 2:
                    $query->whereBetween('price', [500000, 1000000]);
                    break;
                case 3:
                    $query->where('price', '>', 1000000);
                    break;
            }
        }

        $sanPhams = $query->with('category')->paginate(10)->appends($request->query());
        $categories = Category::all();

        return view('page.ProductList', compact('sanPhams', 'categories'));
    }

    // Hiển thị sản phẩm theo danh mục từ navbar
    public function showByCategory($id)
    {
        $sanPhams = CrudProduct::where('category_id', $id)->paginate(12);
        $categories = Category::all(); // Để render lại dropdown trong view nếu cần

        return view('page.ProductList', compact('sanPhams', 'categories'));
    }
}
