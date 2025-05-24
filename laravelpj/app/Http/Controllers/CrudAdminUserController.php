<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CrudAdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('crud_user.CrudAdminUser', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('crud_user.CrudAdminUserCreate', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255', 'regex:/^[\pL]+(?:\s[\pL]+)*$/u'],
            'phone'    => ['nullable', 'regex:/^0\d{9,10}$/'],
            'email'    => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/', 'unique:users,email'],
            'address'  => 'nullable|string|max:255',
            'role'     => 'required|exists:role,id',
            'password' => 'required|string|min:6',
        ], [
            'name.regex'  => 'Tên không được chứa ký tự đặc biệt, số hoặc nhiều khoảng trắng liên tiếp.',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 đến 11 chữ số.',
            'email.regex' => 'Email phải là địa chỉ Gmail hợp lệ (@gmail.com).'
        ]);

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'address'  => $request->address,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($request->role);

        return redirect()->route('users.index')->with('success', 'Đã thêm người dùng!');
    }

    public function edit($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'Người dùng không tồn tại hoặc đã bị xoá. Vui lòng tải lại trang.');
        }

        $roles = Role::all();
        return view('crud_user.CrudAdminUserEdit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'Người dùng không còn tồn tại. Vui lòng tải lại trang.');
        }

        $request->validate([
            'name'     => ['required', 'string', 'max:255', 'regex:/^[\pL]+(?:\s[\pL]+)*$/u'],
            'phone'    => ['nullable', 'regex:/^0\d{9,10}$/'],
            'email'    => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/', 'unique:users,email,' . $id],
            'address'  => 'nullable|string|max:255',
            'role'     => 'required|exists:role,id',
            'password' => 'nullable|string|min:6',
        ], [
            'name.regex'  => 'Tên không được chứa ký tự đặc biệt, số hoặc nhiều khoảng trắng liên tiếp.',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 đến 11 chữ số.',
            'email.regex' => 'Email phải là địa chỉ Gmail hợp lệ (@gmail.com).'
        ]);

        $user->update([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'address'  => $request->address,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        $user->roles()->sync([$request->role]);

        return redirect()->route('users.index')->with('success', 'Đã cập nhật người dùng!');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')
                ->with('error', 'Không tìm thấy người dùng cần xoá.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Đã xóa người dùng!');
    }
}
