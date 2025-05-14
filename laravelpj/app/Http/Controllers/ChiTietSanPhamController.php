<?php
namespace App\Http\Controllers;

use App\Models\ChiTietSanPham;
use App\Models\CrudProduct;
use Illuminate\Http\Request;

class ChiTietSanPhamController extends Controller
{
    public function show($id)
    {
        $chiTietSanPham = CrudProduct::findOrFail($id);
    
        // Lấy từ khóa (ví dụ: lấy "máy lạnh" từ tên sản phẩm)
        $tuKhoa = $this->layTuKhoaLienQuan($chiTietSanPham->name);
    
        // Tìm sản phẩm liên quan theo từ khóa trong tên sản phẩm (loại trừ chính nó)
        $sanPhamLienQuan = CrudProduct::where('name', 'like', "%$tuKhoa%")
            ->where('id', '!=', $chiTietSanPham->id)
            ->take(4)
            ->get();
    
        return view('page.ProductDetail', compact('chiTietSanPham', 'sanPhamLienQuan'));
    }
    
    /**
     * Hàm trích từ khóa đơn giản từ tên sản phẩm
     * Ví dụ "Máy lạnh LG Inverter" -> "máy lạnh"
     */
    private function layTuKhoaLienQuan($ten)
    {
        // Tách tên theo dấu cách, lấy 2 từ đầu tiên (hoặc tùy bạn)
        $tu = explode(' ', strtolower($ten));
        return implode(' ', array_slice($tu, 0, 2));
    }
    

}