@extends('dashboard')

@section('title', 'Quản lý Khuyến mãi')

@section('content')
<style>
    body {
        background-color:rgb(255, 255, 255);
        color:rgb(0, 0, 0);
    }

    h2 {
        color:pink;
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
        background-color:rgb(255, 255, 255);
        color:rgb(0, 0, 0);
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
    <h2 class="mb-4 text-center">Danh sách phiếu giảm giá</h2>

    <!-- Thêm mới -->
    <div class="mb-3 text-end">
        <a href="{{ route('khuyenmai.create') }}" class="btn btn-primary">
            ➕ Thêm khuyến mãi
        </a>
    </div>

    <!-- Hiển thị thông báo -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Danh sách -->
    @if($ds->isEmpty())
        <div class="alert alert-warning text-center">Chưa có khuyến mãi nào.</div>
    @else
    <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Mã phiếu</th>
                <th>Tên phiếu</th>
                <th>Giảm (%)</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ds as $km)
            <tr>
                <td>{{ $km->id }}</td>
                <td>{{ $km->ma_phieu }}</td>
                <td>{{ $km->ten_phieu }}</td>
                <td>{{ $km->phan_tram_giam }}%</td>
                <td>{{ \Carbon\Carbon::parse($km->ngay_bat_dau)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($km->ngay_ket_thuc)->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('khuyenmai.edit', $km->id) }}" class="btn btn-warning btn-sm">
                        ✏️ Sửa
                    </a>
                    <form action="#" method="POST" style="display:inline-block" 
                          onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">🗑️ Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="d-flex justify-content-center mt-3">
        {{ $ds->links() }}
    </div>
    @endif
</div>
@endsection