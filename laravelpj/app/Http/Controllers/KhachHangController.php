<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KhachHangController extends Controller
{
    public function index()
    {
        $dsKhach = KhachHang::paginate(10);
        return view('crud_user.Crud_Guest', compact('dsKhach'));
    }

    public function create()
    {
        return view('crud_user.Crud_GuestCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Ten' => [
                'required',
                'string',
                'max:75',
                'regex:/^[\p{L}\s]+$/u', // chỉ cho chữ và khoảng trắng
                function ($attribute, $value, $fail) {
                    if (preg_match('/\s{2,}/', $value)) {
                        $fail('Tên không được chứa nhiều khoảng trắng liên tiếp.');
                    }
                }
            ],
            'SoDienThoai' => ['required', 'regex:/^0\d{8,10}$/'],
            'Email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 'unique:khach_hangs'],
            'DiaChi' => 'nullable|string|max:255',
            'MatKhau' => 'required|min:6',
        ]);

        KhachHang::create([
            'Ten' => $request->Ten,
            'SoDienThoai' => $request->SoDienThoai,
            'Email' => $request->Email,
            'DiaChi' => $request->DiaChi,
            'MatKhau' => Hash::make($request->MatKhau),
        ]);

        return redirect()->route('khachhang')->with('success', 'Thêm khách hàng thành công');
    }

    public function edit($id)
    {
        $khach = KhachHang::find($id);

        if (!$khach) {
            return redirect()->route('khachhang')->with('error', 'Khách hàng không tồn tại hoặc đã bị xoá. Vui lòng tải lại trang.');
        }

        return view('crud_user.Crud_GuestEdit', compact('khach'));
    }

    public function update(Request $request, $id)
    {
        $khach = KhachHang::find($id);

        if (!$khach) {
            return redirect()->route('khachhang')->with('error', 'Không tìm thấy khách hàng cần cập nhật. Có thể đã bị xoá.');
        }

        $request->validate([
            'Ten' => [
                'required',
                'string',
                'max:75',
                'regex:/^[\p{L}\s]+$/u',
                function ($attribute, $value, $fail) {
                    if (preg_match('/\s{2,}/', $value)) {
                        $fail('Tên không được chứa nhiều khoảng trắng liên tiếp.');
                    }
                }
            ],
            'SoDienThoai' => ['required', 'regex:/^0\d{8,10}$/'],
            'Email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i', 'unique:khach_hangs,Email,' . $id . ',idKhach'],
            'DiaChi' => 'nullable|string|max:255',
            'MatKhau' => 'nullable|min:6',
        ]);

        $data = $request->only(['Ten', 'SoDienThoai', 'Email', 'DiaChi']);

        if ($request->filled('MatKhau')) {
            $data['MatKhau'] = Hash::make($request->MatKhau);
        }

        $khach->update($data);

        return redirect()->route('khachhang')->with('success', 'Cập nhật khách hàng thành công');
    }

    public function destroy($id)
    {
        $khach = KhachHang::find($id);

        if (!$khach) {
            return redirect()->route('khachhang')->with('error', 'Không tìm thấy khách hàng để xoá. Có thể đã bị xoá.');
        }

        $khach->delete();

        return redirect()->route('khachhang')->with('success', 'Xóa khách hàng thành công');
    }
}
