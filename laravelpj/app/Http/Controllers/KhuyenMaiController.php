<?php

namespace App\Http\Controllers;

use App\Models\KhuyenMai;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    public function index()
    {
        $ds = KhuyenMai::paginate(10);
        return view('page.KhuyenMaiGiamGia', compact('ds'));
    }

    public function create()
    {
        return view('page.KhuyenMaiGiamGiaCreate'); // ✅ đúng tên file
    }

    public function store(Request $request)
    {
        $request->validate([
            'ma_phieu' => 'required|unique:khuyen_mais',
            'ten_phieu' => 'required',
            'phan_tram_giam' => 'required|integer|min:1|max:100',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
        ]);

        KhuyenMai::create($request->all());

        return redirect()->route('khuyenmai.index')->with('success', 'Thêm khuyến mãi thành công!');
    }

    public function edit($id)
    {
        $km = KhuyenMai::findOrFail($id);
        return view('page.editKhuyenMai', compact('km')); // ✅ đúng tên file
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ten_phieu' => 'required',
            'phan_tram_giam' => 'required|integer|min:1|max:100',
            'ngay_bat_dau' => 'required|date',
            'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
        ]);

        $km = KhuyenMai::findOrFail($id);
        $km->update($request->all());

        return redirect()->route('khuyenmai.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        KhuyenMai::destroy($id);
        return redirect()->route('khuyenmai.index')->with('success', 'Đã xóa!');
    }
}