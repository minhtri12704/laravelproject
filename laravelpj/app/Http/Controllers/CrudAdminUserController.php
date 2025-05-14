<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CrudAdminUserController extends Controller
{
    //hàm hiển thị
    public function index()
    {
        $users = User::with('roles')->paginate(10); // phân trang 3 người mỗi trang
        return view('crud_user.CrudAdminUser', compact('users'));
    }
    //hàm chuyển sang trang thêm người dùng tại crud_user
    public function create()
    {
        $roles = Role::all(); // lấy danh sách từ bảng roles
        return view('crud_user.CrudAdminUserCreate', compact('roles'));
    }
    //hàm store giúp xử lí thêm người dùng tại trang thêm
     public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'required|email|unique:users,email',
        'address' => 'nullable|string|max:255',
        'role' => 'required|exists:role,id',
        'password' => 'required|string|min:6',
    ]);

    $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
        'password' =>$request->password,
    ]);

    // Thêm role vào bảng user_role
    $user->roles()->attach($request->role);

    return redirect()->route('users.index')->with('success', 'Đã thêm người dùng!');
}
}