<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\CrudProduct;
use Illuminate\Http\Request;

class CrudProductController extends Controller
{
    public function index()
    {
        $products = CrudProduct::with('category')->paginate(10);
        return view('Crud_user.CrudProduct', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('Crud_user.CrudProductCreate', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // validate ảnh
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['image'] = $filename;
        }

        CrudProduct::create($data);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
    }
}