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
            'name'     => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'phone'    => ['required', 'regex:/^0\d{9}$/'],
            'email'    => [
                'required',
                'email:rfc,dns',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
                'unique:users,email',
            ],
            'address'  => 'nullable|string|max:255',
            'role'     => 'required|exists:role,id',
            'password' => ['required', 'string', 'min:6', 'max:20', 'regex:/^\S+$/'],
        ], [
            'name.required'     => 'Tên không được để trống.',
            'name.regex'        => 'Tên không hợp lệ (không được chứa số hoặc ký tự đặc biệt).',
            'phone.required'    => 'Số điện thoại là bắt buộc.',
            'phone.regex'       => 'Số điện thoại phải đúng định dạng 10 số, bắt đầu bằng 0.',
            'email.required'    => 'Email không được để trống.',
            'email.email'       => 'Email không hợp lệ.',
            'email.regex'       => 'Email phải là địa chỉ Gmail.',
            'email.unique'      => 'Email đã tồn tại.',
            'role.required'     => 'Vai trò là bắt buộc.',
            'role.exists'       => 'Vai trò không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.regex'    => 'Mật khẩu không được chứa khoảng trắng.',
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
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('crud_user.CrudAdminUserEdit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => ['required', 'string', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'phone'    => ['required', 'regex:/^0\d{9}$/'],
            'email'    => [
                'required',
                'email:rfc,dns',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
                'unique:users,email,' . $id,
            ],
            'address'  => 'nullable|string|max:255',
            'role'     => 'required|exists:role,id',
            'password' => ['required', 'string', 'min:6', 'max:20', 'regex:/^\S+$/'],
        ], [
            'name.required'     => 'Tên không được để trống.',
            'name.regex'        => 'Tên không hợp lệ (không được chứa số hoặc ký tự đặc biệt).',
            'phone.required'    => 'Số điện thoại là bắt buộc.',
            'phone.regex'       => 'Số điện thoại phải đúng định dạng 10 số, bắt đầu bằng 0.',
            'email.required'    => 'Email không được để trống.',
            'email.email'       => 'Email không hợp lệ.',
            'email.regex'       => 'Email phải là địa chỉ Gmail.',
            'email.unique'      => 'Email đã tồn tại.',
            'role.required'     => 'Vai trò là bắt buộc.',
            'role.exists'       => 'Vai trò không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.regex'    => 'Mật khẩu không được chứa khoảng trắng.',
        ]);

        $user->update([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'address'  => $request->address,
            'password' => Hash::make($request->password),
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
