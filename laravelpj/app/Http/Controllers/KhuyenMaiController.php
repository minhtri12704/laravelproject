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
        return view('page.KhuyenMaiGiamGiaCreate');
    }

    public function store(Request $request)
{
    $request->validate([
        'ma_phieu' => 'required|unique:khuyen_mais',
        'ten_phieu' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z0-9\s]+$/u',
            function ($attribute, $value, $fail) {
                if (preg_match('/\s{2,}/', $value)) {
                    $fail('Tên phiếu không được chứa nhiều khoảng trắng liền nhau.');
                }
            }
        ],
        'loai_giam' => 'required|in:percent,fixed',
        'gia_tri' => [
            'required',
            'integer',
            'min:1',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->loai_giam === 'percent' && $value > 100) {
                    $fail('Phần trăm giảm không được vượt quá 100%.');
                }
            }
        ],
        'ngay_bat_dau' => 'required|date',
        'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
    ]);

    KhuyenMai::create($request->all());

    return redirect()->route('khuyenmai.index')->with('success', 'Thêm khuyến mãi thành công!');
}

    public function edit($id)
{
    $km = KhuyenMai::find($id);

    if (!$km) {
        return redirect()->route('khuyenmai.index')
                         ->with('error', 'Phiếu giảm giá không tồn tại hoặc đã bị xóa. Vui lòng tải lại trang.');
    }

    return view('page.KhuyenMaiGiamGiaEdit', compact('km'));
}


public function update(Request $request, $id)
{
    $km = KhuyenMai::find($id);

    if (!$km) {
        return redirect()->route('khuyenmai.index')
                         ->with('error', 'Phiếu giảm giá không tồn tại hoặc đã bị xóa. Vui lòng tải lại trang.');
    }

    $formUpdatedAt = $request->input('updated_at');
    if ($formUpdatedAt && $formUpdatedAt != $km->updated_at->toDateTimeString()) {
        return redirect()->route('khuyenmai.index')
                         ->with('error', 'Dữ liệu đã bị thay đổi bởi người khác. Vui lòng tải lại trang.');
    }

    $request->validate([
        'ten_phieu' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z0-9\s]+$/u',
            function ($attribute, $value, $fail) {
                if (preg_match('/\s{2,}/', $value)) {
                    $fail('Tên phiếu không được chứa nhiều khoảng trắng liền nhau.');
                }
            }
        ],
        'loai_giam' => 'required|in:percent,fixed',
        'gia_tri' => [
            'required',
            'integer',
            'min:1',
            function ($attribute, $value, $fail) use ($request) {
                if ($request->loai_giam === 'percent' && $value > 100) {
                    $fail('Phần trăm giảm không được vượt quá 100%.');
                }
            }
        ],
        'ngay_bat_dau' => 'required|date',
        'ngay_ket_thuc' => 'required|date|after_or_equal:ngay_bat_dau',
    ]);

    $km->update($request->except('updated_at'));

    return redirect()->route('khuyenmai.index')->with('success', 'Cập nhật thành công!');
}




    public function destroy($id)
    {
        KhuyenMai::destroy($id);
        return redirect()->route('khuyenmai.index')->with('success', 'Đã xóa!');
    }
}
