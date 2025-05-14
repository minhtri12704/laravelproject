@extends('dashboard')

@section('content')
<style>
    .form-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #1a1a1a;
        border-radius: 8px;
    }

    h2 {
        color: #ffccdd;
        text-align: center;
        margin-bottom: 20px;
    }

    label {
        color: #ffccdd;
    }

    .form-control {
        background-color: #2c2c2c;
        color: #ffccdd;
        border: 1px solid #d3d3d3;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 15px;
    }

    .form-control:focus {
        background-color: #3a3a3a;
        color: #ffccdd;
        border-color: #ff69b4;
        box-shadow: none;
    }

    .btn-dark {
        background-color: #ff69b4;
        color: #ffffff;
        border: none;
        padding: 12px 24px;
        font-size: 1.2rem;
        border-radius: 4px;
        width: 100%;
        cursor: pointer;
    }

    .btn-dark:hover {
        background-color: #ff85c0;
    }

    .btn-reset {
        background-color: #ffd700;
        color: #000000;
        border: none;
        padding: 12px 24px;
        font-size: 1.2rem;
        border-radius: 4px;
        width: 100%;
        margin-top: 10px;
    }

    .btn-reset:hover {
        background-color: #ffec3d;
    }

    .form-container .mb-3:last-child {
        margin-bottom: 0;
    }
</style>
<div class="form-container">
    <h2>Chỉnh sửa người dùng</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tên người dùng</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
        </div>
        <div class="mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
        </div>
        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control" value="{{ $user->address }}">
        </div>
        <!-- Role -->
        <div class="mb-3">
            <select class="form-control" name="role" required>
                <option value="">-- Chọn vai trò --</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="mb-3">
            <label>Mật khẩu (để trống nếu không đổi)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-dark">Cập nhật</button>
    </form>
</div>
@endsection