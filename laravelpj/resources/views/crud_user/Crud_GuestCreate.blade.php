@extends('dashboard')

@section('content')
<style>
  body {
    background-color: #1c1c1e;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #f5e6f7;
  }
  .container {
    background-color: #2c2c2e;
    border-radius: 15px;
    padding: 30px;
    max-width: 600px;
    margin: 40px auto;
    box-shadow: 0 0 20px rgba(255, 192, 203, 0.15);
  }
  .title {
    text-align: center;
    margin-bottom: 25px;
    color: #ffb6c1;
  }
  .form-group label {
    color: #f8e8f9;
  }
  .form-control {
    background-color: #3a3a3c;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px;
  }
  .form-control:focus {
    background-color: #4a4458;
    outline: none;
    box-shadow: 0 0 5px #ffb6c1;
  }
  .btn-submit {
    background-color: #ffb6c1;
    color: #1c1c1e;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    margin-top: 20px;
    transition: background-color 0.2s ease;
  }
  .btn-submit:hover {
    background-color: #ffa0bd;
  }
</style>
<div class="container">
<h2>Thêm khách hàng</h2>

<form action="{{ route('khachhang.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Tên</label>
        <input type="text" name="Ten" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input type="text" name="SoDienThoai" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="Email" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input type="text" name="DiaChi" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Mật khẩu</label>
        <input type="text" name="MatKhau" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Thêm</button>
    <a href="{{ route('khachhang') }}" class="btn btn-secondary">Quay lại</a>
</form></div>
@endsection