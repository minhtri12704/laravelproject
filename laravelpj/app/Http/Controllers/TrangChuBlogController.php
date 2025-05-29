<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;

class TrangChuBlogController extends Controller
{
    public function index()
    {
        $baiviet = BaiViet::latest()->get(); // hoặc paginate nếu bạn muốn
        return view('page.BlogTinTuc', compact('baiviet'));
    }
    public function show($id)
    {
        $bv = BaiViet::findOrFail($id);
        return view('page.BlogChiTiet', compact('bv'));
    }
}
