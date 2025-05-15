<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Tìm khách theo email
        $khach = KhachHang::where('Email', $request->email)->first();

        // Dùng Hash::check để so sánh mật khẩu mã hóa
        if ($khach && Hash::check($request->password, $khach->MatKhau)) {
            session(['khach_hang' => $khach]);
            return redirect('/home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng')->withInput();
    }

    public function logout(Request $request)
    {
        session()->forget('khach_hang');
        return redirect('/login')->with('success', 'Đã đăng xuất!');
    }
}
