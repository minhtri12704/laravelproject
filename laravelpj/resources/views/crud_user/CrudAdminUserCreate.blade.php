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
        font-weight: 500;
        margin-bottom: 4px;
        display: block;
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

    .text-danger {
        color: #ff7276;
        font-size: 0.9rem;
    }
</style>

<div class="form-container">
    <h2>Thêm người dùng</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Tên người dùng</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="phone">Số điện thoại</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
            @error('phone')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="address">Địa chỉ</label>
            <input type="text" id="address" name="address" class="form-control" value="{{ old('address') }}" required>
            @error('address')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="role">Vai trò</label>
            <select class="form-control" name="role" id="role" required>
                <option value="">-- Chọn vai trò --</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="password">Mật khẩu</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-dark">Thêm</button>
    </form>
</div>
@endsection
