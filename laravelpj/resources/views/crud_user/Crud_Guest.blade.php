@extends('dashboard')

@section('content')
<style>
    body {
        background-color: #1c1c1e;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #f5e6f7;
    }

    .tab {
        margin-top: 5%;
        margin-left: 15%;
        margin-right: 10%;
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #ffb6c1;
    }

    .btn-success {
        background-color: #ff69b4;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .btn-success:hover {
        background-color: #ff85c1;
    }

    .table {
        background-color: #2c2c2e;
        color: #f5e6f7;
    }

    .table th {
        background-color: #ffb6c1;
        color: #1c1c1e;
        text-align: center;
    }

    .table td {
        background-color: #3a3a3c;
        color: #fff;
        vertical-align: middle;
    }

    .edit {
        background-color: #ffb86b;
        color: #1c1c1e;
        padding: 6px 12px;
        border: none;
        border-radius: 8px;
        margin-right: 5px;
        text-decoration: none;
    }

    .edit:hover {
        background-color: #ffc67f;
    }

    .btn-danger {
        background-color: #ff4d6d;
        border: none;
        padding: 6px 12px;
        border-radius: 8px;
    }

    .btn-danger:hover {
        background-color: #ff6f8d;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-radius: 6px;
        padding: 10px 15px;
        margin-bottom: 20px;
    }

</style>

<div class="tab">
    <h2>Danh sách Khách Hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('khachhang.create') }}" class="btn btn-success mb-3">➕ Thêm khách hàng</a>

    <table class="table table-bordered text-center align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Điện thoại</th>
                <th>Địa chỉ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dsKhach as $khach)
                <tr>
                    <td>{{ $khach->idKhach }}</td>
                    <td>{{ $khach->Ten }}</td>
                    <td>{{ $khach->Email }}</td>
                    <td>{{ $khach->SoDienThoai }}</td>
                    <td>{{ $khach->DiaChi }}</td>
                    <td>
                        <a href="#" class="edit">✏️ Sửa</a>
                        <form action="#" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑️ Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $dsKhach->links() }}
</div>
@endsection
