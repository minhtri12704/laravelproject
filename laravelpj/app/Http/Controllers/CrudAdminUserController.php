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
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'nullable|string|max:255',
            'role' => 'required|exists:role,id',
            'password' => 'nullable|string|min:6',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
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
