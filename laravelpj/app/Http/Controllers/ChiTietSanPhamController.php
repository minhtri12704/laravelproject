<?php

namespace App\Http\Controllers;

use App\Models\CrudProduct;
use Illuminate\Http\Request;

class ChiTietSanPhamController extends Controller
{
    public function show($id)
{
    // Tìm sản phẩm (nếu không có thì trả về null thay vì lỗi)
    $chiTietSanPham = CrudProduct::with('reviews.khachHang')->find($id);

    // Nếu không có sản phẩm, không cần xử lý tiếp, truyền null
    if (!$chiTietSanPham) {
        return view('page.ProductDetail', [
            'chiTietSanPham' => null,
            'sanPhamLienQuan' => collect(), // Tránh lỗi khi foreach ở view
        ]);
    }

    // Từ khóa liên quan
    $tuKhoa = $this->layTuKhoaLienQuan($chiTietSanPham->name);

    // Sản phẩm liên quan
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
