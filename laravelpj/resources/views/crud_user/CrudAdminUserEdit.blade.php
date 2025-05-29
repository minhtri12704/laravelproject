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
        font-size: 0.9rem;
    }
</style>

<div class="form-container">
    <h2>Chỉnh sửa người dùng</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Tên người dùng</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"maxlength="35" require>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <input type="hidden" name="updated_at" value="{{ $user->updated_at }}">


        <div class="mb-3">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}"maxlength="20" require>
            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}"maxlength="35" require>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $user->address) }}"maxlength="20" require>
            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="role">Vai trò</label>
            <select name="role" id="role" class="form-control" required>
                <option value="">-- Chọn vai trò --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ (old('role', $user->roles->first()->id ?? '') == $role->id) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error('role') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password">Mật khẩu mới (nếu đổi)</label>
            <input type="password" name="password" id="password" class="form-control" maxlength="15" require>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-dark">Cập nhật</button>
    </form>
</div>
@endsection
