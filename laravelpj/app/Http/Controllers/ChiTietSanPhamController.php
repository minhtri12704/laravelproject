<?php

namespace App\Http\Controllers;

use App\Models\CrudProduct;
use Illuminate\Http\Request;

class ChiTietSanPhamController extends Controller
{
    public function show($id)
    {
        // Lấy sản phẩm chi tiết
        $chiTietSanPham = CrudProduct::findOrFail($id);

        // Từ khóa liên quan
        $tuKhoa = $this->layTuKhoaLienQuan($chiTietSanPham->name);

        // Tìm sản phẩm liên quan (trừ chính nó)
        $sanPhamLienQuan = CrudProduct::where('name', 'like', "%$tuKhoa%")
            ->where('id', '!=', $chiTietSanPham->id)
            ->take(4)
            ->get();

        return view('page.ProductDetail', compact('chiTietSanPham', 'sanPhamLienQuan'));
    }

    /**
     * Tách từ khóa đơn giản từ tên sản phẩm (2 từ đầu)
     */
    private function layTuKhoaLienQuan($ten)
    {
        $tu = explode(' ', strtolower($ten));
        return implode(' ', array_slice($tu, 0, 2));
    }
}
