<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

        // Ưu tiên kiểm tra đăng nhập admin (bảng users)
        $admin = User::where('email', $request->email)->first();
        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::login($admin); 
            return redirect('/users')->with('success', 'Chào mừng quản trị viên!');
        }

        // Nếu không phải admin → kiểm tra khách hàng
        $khach = KhachHang::where('Email', $request->email)->first();
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
