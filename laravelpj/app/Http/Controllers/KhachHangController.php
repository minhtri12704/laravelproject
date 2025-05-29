<?php

namespace App\Http\Controllers;

use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
                'regex:/^[\p{L}\d\s]+$/u', // chỉ chữ và khoảng trắng
                function ($attribute, $value, $fail) {
                    if (preg_match('/\s{2,}/', $value)) {
                        $fail('Tên không được chứa nhiều khoảng trắng liên tiếp.');
                    }
                    if (preg_match('/^\s|\s$/', $value)) {
                        $fail('Tên không được bắt đầu hoặc kết thúc bằng khoảng trắng.');
                    }
                }
            ],
            'SoDienThoai' => [
                'required',
                'regex:/^0\d{8,10}$/',
                'regex:/^\S+$/'
            ],
            'Email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/i',
                'unique:khach_hangs'
            ],
            'DiaChi' => 'nullable|string|max:255',
            'MatKhau' => [
                'required',
                'string',
                'min:6',
                'regex:/^\S+$/'
            ],
        ], [
            'Ten.required'         => 'Vui lòng nhập tên khách hàng.',
            'Ten.regex'            => 'Tên chỉ được chứa chữ cái và khoảng trắng.',
            'SoDienThoai.required' => 'Vui lòng nhập số điện thoại.',
            'SoDienThoai.regex'    => 'Số điện thoại phải bắt đầu bằng 0 và có 9–11 chữ số.',
            'Email.required'       => 'Vui lòng nhập email.',
            'Email.regex'          => 'Email phải là Gmail hợp lệ.',
            'Email.unique'         => 'Email đã tồn tại.',
            'MatKhau.required'     => 'Mật khẩu không được để trống.',
            'MatKhau.regex'        => 'Mật khẩu không được chứa khoảng trắng.',
        ]);

        KhachHang::create([
            'Ten'         => trim($request->Ten),
            'SoDienThoai' => $request->SoDienThoai,
            'Email'       => $request->Email,
            'DiaChi'      => $request->DiaChi,
            'MatKhau'     => Hash::make($request->MatKhau),
        ]);

        return redirect()->route('khachhang')->with('success', 'Thêm khách hàng thành công');
    }


    public function edit($id)
    {


        try {
            $khach = KhachHang::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('khachhang')->with('error', 'Không tìm thấy khach hangt cần sửa.');
        }

        return view('crud_user.Crud_GuestEdit', compact('khach'));
    }

    public function update(Request $request, $id)
{
    try {
        $khach = KhachHang::findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return redirect()->route('khachhang')->with('error', 'Không tìm thấy người dùng để cập nhật.');
    }

    // 🛡️ Kiểm tra xung đột dữ liệu
    $formUpdatedAt = $request->input('updated_at');
    if ($formUpdatedAt && $formUpdatedAt != $khach->updated_at->toDateTimeString()) {
        return redirect()->route('khachhang')->with('error', 'Khách hàng này đã được người khác cập nhật trước đó. Vui lòng tải lại trang.');
    }

    $request->validate([
        // (giữ nguyên toàn bộ validate cũ)
    ]);

    $data = $request->only(['Ten', 'SoDienThoai', 'Email', 'DiaChi']);
    $data['MatKhau'] = Hash::make($request->MatKhau);
    $data['Ten'] = trim($data['Ten']); // loại bỏ khoảng trắng dư

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
