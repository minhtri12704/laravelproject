<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CrudProduct;


class HomePageController extends Controller
{
     public function index(Request $request)
    {

         $query = CrudProduct::query();

    // Lọc theo tìm kiếm
    // if ($request->filled('search')) {
    //     $query->where('name', 'like', '%' . $request->search . '%');
    // }

    // Lọc theo danh mục
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $products = $query->paginate(6);
    $categories = Category::all();

    $categories = Category::with('products')->get();
    $bestSellers = CrudProduct::orderBy('price', 'desc')->take(5)->get(); 

    return view('page.homepage', compact('products', 'categories', 'bestSellers'));
    }
}