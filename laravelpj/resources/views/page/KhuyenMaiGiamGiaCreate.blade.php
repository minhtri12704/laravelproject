@extends('dashboard')

@section('title', 'Thêm Khuyến mãi')

@section('content')
<style>
    body {
        background-color: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
    }

    h2 {
        color: pink;
    }

    label {
        color: white;
        font-weight: bold;
    }

    .table {
        background-color: #1a1a1a;
        color: #ffffff;
    }

    .table-bordered th,
    .table-bordered td {
        background-color: #1a1a1a;
        border: 1px solid #d3d3d3;
        color: #ffccdd;
    }

    .table-dark {
        background-color: #3a3a3a;
        color: #ffccdd;
    }

    .btn-dark {
        background-color: #ff69b4;
        color: #ffffff;
        border: none;
    }

    .btn-dark:hover {
        background-color: #ff85c0;
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4">Thêm phiếu giảm giá</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Lỗi:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('khuyenmai.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="ma_phieu">Mã phiếu</label>
            <input type="text" name="ma_phieu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ten_phieu">Tên phiếu</label>
            <input type="text" name="ten_phieu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="loai_giam">Loại giảm</label>
            <select name="loai_giam" class="form-select" required>
                <option value="percent">Phần trăm (%)</option>
                <option value="fixed">Giảm tiền (VNĐ)</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="gia_tri">Giá trị giảm</label>
            <input type="number" name="gia_tri" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="ngay_bat_dau">Ngày bắt đầu</label>
            <input type="date" name="ngay_bat_dau" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ngay_ket_thuc">Ngày kết thúc</label>
            <input type="date" name="ngay_ket_thuc" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">💾 Lưu</button>
        <a href="{{ route('khuyenmai.index') }}" class="btn btn-secondary">⬅️ Quay lại</a>
    </form>
</div>
@endsection