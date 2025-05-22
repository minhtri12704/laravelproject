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
    $request->validate([ 'email' => 'required|email',
    'password' => 'required'
    ]);

    // Đăng nhập ADMIN (bảng users)
    $admin = User::where('email', $request->email)->first();
    if ($admin && Hash::check($request->password, $admin->password)) {
        Auth::guard('web')->login($admin);
        return redirect('/users')->with('success', 'Chào mừng quản trị viên!');
    }

   // Đăng nhập KHÁCH (guard: khach)
    if (Auth::guard('khach')->attempt([
        'Email' => $request->email,
        'password' => $request->password
    ])) {
        $khach = Auth::guard('khach')->user();

        // Gán thủ công session nếu cần
 session(['khach_hang' => $khach]);

 if ($khach->Email === 'admin@gmail.com') {
return redirect()->route('users.index'); // nếu trùng email đặc biệt
 }

 return redirect('/home')->with('success', 'Đăng nhập thành công!');
    }

    return back()->with('error', 'Email hoặc mật khẩu không đúng')->withInput();
}

    public function logout()
    {
        Auth::guard('khach')->logout();
        return redirect('/login')->with('success', 'Đã đăng xuất!');
    }   
    
}