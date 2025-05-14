@extends('dashboard')

@section('title', 'Danh sách Đơn Hàng')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
body {
    background-color: #1a1a1a;
    color: #ffb6c1;
}

.order-list {
    width: 95%;
    margin: 40px auto;
    background-color: #1a1a1a;
    padding: 30px;
    border-radius: 12px;
}

.header-title {
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    color: #ff85c0;
    margin-bottom: 20px;
}

.btn-add {
    float: right;
    margin-bottom: 15px;
    background-color: #ff69b4;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    text-decoration: none;
}

.btn-add:hover {
    background-color: #ff3399;
}

.custom-table {
    width: 100%;
    background-color: #2b2b2b;
    color: #ffb6c1;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
}

.custom-table th,
.custom-table td {
    border: 1px solid #444;
    padding: 12px 10px;
    text-align: center;
    vertical-align: middle;
}

.custom-table th {
    background-color: #3c3c3c;
    color: #ffb6c1;
    font-weight: bold;
}

.custom-table tr:hover {
    background-color: #383838;
}

.btn-edit {
    background-color: #ffd1dc;
    color: #2c2c2e;
    padding: 6px 12px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    margin-right: 5px;
}

.btn-delete {
    background-color: #ff4d6d;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
}

.btn-edit:hover,
.btn-delete:hover {
    opacity: 0.9;
}

.text-center {
    text-align: center;
}

.alert {
    width: 100%;
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 6px;
    font-weight: bold;
}

.alert-success {
    background-color: #28a745;
    color: #fff;
}

.alert-danger {
    background-color: #dc3545;
    color: #fff;
}

.status {
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: bold;
    display: inline-block;
}

.status-choxuly {
    background-color: #ffcc00;
    color: #1a1a1a;
}

.status-dangxuly {
    background-color: #3399ff;
    color: #fff;
}

.status-daxuly {
    background-color: #6c757d;
    color: #fff;
}

.pagination-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 30px;
    gap: 10px;
}

.pagination-info {
    color: #ff85c0;
    font-weight: bold;
    font-size: 16px;
}
.pagination .page-link {
        background-color: #2c2c2c;
        color: #ffccdd;
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

<div class="order-list">
    <h2 class="header-title">Danh sách Đơn hàng</h2>

    <a href="{{ route('orders.create') }}" class="btn-add">+ Thêm đơn hàng</a>

    @if (session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif
    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên đơn hàng</th>
                <th>Khách hàng</th>
                <th>Số lượng</th>
                <th>Tổng tiền</th>
                <th>Thanh toán</th>
                <th>Chi tiết</th>
                <th>Trạng thái</th>
                <th>Ghi chú</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $donHang)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $donHang->ten_don_hang }}</td>
                <td>{{ $donHang->ten_khach_hang }}</td>
                <td>{{ $donHang->so_luong }}</td>
                <td><strong>{{ number_format($donHang->tong_tien, 0, ',', '.') }} <span
                            style="color:#ff69b4;">VNĐ</span></strong></td>
                <td>{{ $donHang->phuong_thuc_thanh_toan }}</td>
                <td>
                    <a href="{{ route('orders.show', $donHang->id) }}">
                        <button class="btn-edit">Xem</button>
                    </a>
                </td>
                <td>
                    @php
                    $statusClass = match($donHang->trang_thai) {
                    'Chưa xử lý' => 'status status-choxuly',
                    'Đã xử lý' => 'status status-daxuly',
                    default => 'status'
                    };
                    @endphp
                    <span class="{{ $statusClass }}">{{ $donHang->trang_thai }}</span>
                </td>
                <td>{{ $donHang->ghi_chu }}</td>
                <td>
                    <a href="{{ route('orders.edit', $donHang->id) }}">
                        <button class="btn-edit">Sửa</button>
                    </a>
                    <form action="{{ route('orders.destroy', $donHang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Không có đơn hàng nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-wrapper">
        {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
        <div class="pagination-info">
            Trang {{ $orders->currentPage() }} / {{ $orders->lastPage() }} — Tổng cộng {{ $orders->total() }} đơn hàng
        </div>
    </div>
</div>
@endsection