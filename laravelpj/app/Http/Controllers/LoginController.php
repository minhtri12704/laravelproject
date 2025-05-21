<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
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

        // Tìm khách theo email
        $khach = KhachHang::where('Email', $request->email)->first();

        if ($khach && Hash::check($request->password, $khach->MatKhau)) {
            session(['khach_hang' => $khach]);

            // Kiểm tra nếu là admin thì chuyển hướng sang CRUD Order
            if ($khach->Email === 'admin@gmail.com') {
                return redirect()->route('users.index'); // route đến trang CRUD đơn hàng
            }
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
