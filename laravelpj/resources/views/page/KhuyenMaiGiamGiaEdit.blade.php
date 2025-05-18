@extends('dashboard')

@section('title', 'Sửa Khuyến mãi')

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
    /* ✅ Màu trắng cho label */
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

.action-icon {
    color: #ffccdd;
    font-size: 1.2rem;
    margin-right: 10px;
}

.action-icon:hover {
    color: #ff85c0;
}

.pagination .page-link {
    background-color: rgb(255, 255, 255);
    color: rgb(0, 0, 0);
    border: 1px solid #d3d3d3;
}

.pagination .page-item.active .page-link {
    background-color: #ff69b4;
    color: #ffffff;
    border: 1px solid #d3d3d3;
}

.pagination .page-link:hover {
    background-color: #ff85c0;
    color: #ffffff;
}
</style>
<div class="container mt-5">
    <h2 class="mb-4">Sửa phiếu giảm giá</h2>

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

    <form action="{{ route('khuyenmai.update', $km->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Mã phiếu</label>
            <input type="text" name="ma_phieu" class="form-control" value="{{ $km->ma_phieu }}" disabled>
        </div>

        <div class="mb-3">
            <label>Tên phiếu</label>
            <input type="text" name="ten_phieu" class="form-control" value="{{ $km->ten_phieu }}" required>
        </div>

        <div class="mb-3">
            <label>Phần trăm giảm</label>
            <input type="number" name="phan_tram_giam" class="form-control" value="{{ $km->phan_tram_giam }}" min="1"
                max="100" required>
        </div>

        <div class="mb-3">
            <label>Ngày bắt đầu</label>
            <input type="date" name="ngay_bat_dau" class="form-control" value="{{ $km->ngay_bat_dau }}" required>
        </div>

        <div class="mb-3">
            <label>Ngày kết thúc</label>
            <input type="date" name="ngay_ket_thuc" class="form-control" value="{{ $km->ngay_ket_thuc }}" required>
        </div>

        <button type="submit" class="btn btn-primary">✅ Cập nhật</button>
        <a href="{{ route('khuyenmai.index') }}" class="btn btn-secondary">⬅️ Quay lại</a>
    </form>
</div>
@endsection