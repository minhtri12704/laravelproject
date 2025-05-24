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

    .btn-dark {
        background-color: #ff69b4;
        color: #ffffff;
        border: none;
    }

    .btn-dark:hover {
        background-color: #ff85c0;
    }

    .text-danger {
        font-size: 0.9rem;
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
            <input type="text" name="ma_phieu" class="form-control" value="{{ old('ma_phieu') }}" required>
            @error('ma_phieu') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="ten_phieu">Tên phiếu</label>
            <input type="text" name="ten_phieu" class="form-control" value="{{ old('ten_phieu') }}" required>
            @error('ten_phieu') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="loai_giam">Loại giảm</label>
            <select name="loai_giam" class="form-select" required>
                <option value="percent" {{ old('loai_giam') == 'percent' ? 'selected' : '' }}>Phần trăm (%)</option>
                <option value="fixed" {{ old('loai_giam') == 'fixed' ? 'selected' : '' }}>Giảm tiền (VNĐ)</option>
            </select>
            @error('loai_giam') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="gia_tri">Giá trị giảm</label>
            <input type="number" name="gia_tri" class="form-control" value="{{ old('gia_tri') }}" min="1" required>
            @error('gia_tri') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="ngay_bat_dau">Ngày bắt đầu</label>
            <input type="date" name="ngay_bat_dau" id="ngay_bat_dau" class="form-control" value="{{ old('ngay_bat_dau') }}" required>
            @error('ngay_bat_dau') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="ngay_ket_thuc">Ngày kết thúc</label>
            <input type="date" name="ngay_ket_thuc" id="ngay_ket_thuc" class="form-control" value="{{ old('ngay_ket_thuc') }}" required>
            @error('ngay_ket_thuc') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-dark">💾 Lưu</button>
        <a href="{{ route('khuyenmai.index') }}" class="btn btn-secondary">⬅️ Quay lại</a>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startDate = document.getElementById('ngay_bat_dau');
        const endDate = document.getElementById('ngay_ket_thuc');

        endDate.addEventListener('change', function () {
            if (new Date(endDate.value) < new Date(startDate.value)) {
                alert("Ngày kết thúc phải sau hoặc bằng ngày bắt đầu!");
                endDate.value = '';
            }
        });
    });
</script>
