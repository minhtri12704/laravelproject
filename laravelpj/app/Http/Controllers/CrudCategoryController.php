<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CrudCategoryController extends Controller

{
    public function index()
    {
        $categories = Category::all();
        return view('crud_user.crud_category', compact('categories'));
    }

    public function create()
    {
        return view('crud_user.Crud_CategoryCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function editCategory($id)
{
    $categories = Category::find($id);

    if (!$categories) {
        return redirect()->route('categories.index')
                         ->with('error', 'Danh mục không tồn tại hoặc đã bị xoá. Vui lòng tải lại trang.');
    }

    return view('crud_user.Crud_CategoryEdit', compact('categories'));
}


    // Xoá danh mục
    public function deleteCategory($id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->route('categories.index')
                         ->with('error', 'Không tìm thấy danh mục cần xoá.');
    }

    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Đã xoá danh mục thành công!');
}


public function update(Request $request, $id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->route('categories.index')
                         ->with('error', 'Danh mục không tồn tại hoặc đã bị xoá. Vui lòng tải lại trang.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category->update([
        'name' => $request->name,
    ]);

    return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công!');
}

}