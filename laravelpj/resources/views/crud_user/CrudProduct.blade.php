@extends('dashboard')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background-color: #1a1a1a;
        color: #ffccdd;
    }

    h2 {
        color: #ffccdd;
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

    .action-button {
        padding: 6px 12px;
        border: none;
        border-radius: 8px;
        color: white;
    }

    .btn-edit {
        background-color: #ffa6c9;
    }

    .btn-delete {
        background-color: #ff4d6d;
    }

    .btn-edit:hover {
        background-color: #ffbfd9;
    }

    .btn-delete:hover {
        background-color: #ff7b91;
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

<h2 class="mb-4 text-center">Quản lý sản phẩm</h2>
@if(session('success'))
<div id="success-alert" class="position-fixed top-50 start-50 translate-middle text-center p-4 rounded" style="z-index: 9999; background-color: #28a745; color: white; font-size: 18px;">
    {{ session('success') }}
</div>

<script>
    setTimeout(function () {
        const alertBox = document.getElementById('success-alert');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
    }, 3000);
</script>
@endif

{{-- Thông báo thành công --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="text-end mb-3">
    <a href="{{ route('products.create') }}" class="btn btn-dark">+ Thêm sản phẩm</a>
</div>

<table class="table table-bordered table-striped text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $sp)
            <tr>
                <td>{{ $sp->id }}</td>
                <td>{{ $sp->name }}</td>
                <td>{{ $sp->category->name ?? 'Chưa có' }}</td>
                <td>{{ $sp->descript }}</td>
                <td>{{ $sp->quantity }}</td>
                <td>{{ number_format($sp->price, 0, ',', '.') }} đ</td>
                <td>
                    @if($sp->image)
                        <img src="{{ asset('images/' . $sp->image) }}" alt="{{ $sp->name }}" width="60">
                    @else
                        Không có ảnh
                    @endif
                </td>
                <td>
                    <!-- Nút Sửa -->
                    <form action="{{ route('products.edit', $sp->id) }}" method="GET" style="display: inline-block;">
                        <button type="submit" class="action-button btn-edit">Sửa</button>
                    </form>

                    <!-- Nút Xóa -->
                    <form action="{{ route('products.delete', $sp->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-button btn-delete">Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $products->links() }}
</div>

@endsection