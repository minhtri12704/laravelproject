<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        // Đăng nhập bằng guard 'khach'
        if (Auth::guard('khach')->attempt([
            'Email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->with('error', 'Email hoặc mật khẩu không đúng')->withInput();
    }

    public function logout()
    {
        Auth::guard('khach')->logout();
        return redirect('/login')->with('success', 'Đã đăng xuất!');
    }
}
