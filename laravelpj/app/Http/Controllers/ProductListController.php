<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\CrudProduct;
use App\Models\ChiTietSanPham;

class ProductListController extends Controller
{
    public function index()
    {
        $sanPhams = CrudProduct::with('category')->paginate(10); // Hoặc 8/16 tuỳ bạn
        return view('page.ProductList', compact('sanPhams'));
    }
    //hiển thị danh mục chính trên thanh navbar
    public function showByCategory($id)
    {
        $sanPhams = \App\Models\CrudProduct::where('category_id', $id)->paginate(12);
        return view('page.ProductList', compact('sanPhams'));
    }
    
}