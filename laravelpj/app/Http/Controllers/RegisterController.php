<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // View đăng ký nằm tại: resources/views/auth/register.blade.php
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:khach_hangs,Email',
            'password' => 'required|string|min:6',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
        ]);

        $khachHang = KhachHang::create([
            'Ten'         => $request->name,
            'Email'       => $request->email,
            'MatKhau'     => Hash::make($request->password),
            'SoDienThoai' => $request->phone,
            'DiaChi'      => $request->address,
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}
