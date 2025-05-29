<?php

namespace App\Http\Controllers;

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
        'name' => [
            'required',
            'string',
            'max:75',
            'regex:/^[\pL]+(?:\s[\pL]+)*$/u',
        ],
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'descript' => 'nullable|string|max:100',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'quantity' => 'required|integer|min:0',
    ], [
        'name.regex' => 'Tên sản phẩm không được chứa ký tự đặc biệt.',
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


    public function edit($id)
    {
        $product = CrudProduct::find($id);

        if (!$product) {
            return redirect()->route('products.index')
                             ->with('error', 'Sản phẩm không tồn tại hoặc đã bị xóa. Vui lòng tải lại trang.');
        }

        $categories = Category::all();
        return view('Crud_user.CrudProductEdit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
{
    $product = CrudProduct::find($id);

    if (!$product) {
        return redirect()->route('products.index')
                         ->with('error', 'Sản phẩm không còn tồn tại. Vui lòng tải lại trang.');
    }

    $request->validate([
        'name' => [
            'required',
            'string',
            'max:75',
            'regex:/^[\pL]+(?:\s[\pL]+)*$/u',
        ],
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'descript' => 'nullable|string|max:100',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'quantity' => 'required|integer|min:0',
    ], [
        'name.regex' => 'Tên sản phẩm không được chứa ký tự đặc biệt.',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);
        $data['image'] = $filename;
    }

    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Cập nhật thành công');
}


    public function delete($id)
    {
        $product = CrudProduct::find($id);

        if (!$product) {
            return redirect()->route('products.index')
                             ->with('error', 'Sản phẩm không tồn tại. Có thể đã bị xóa.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
    }
}