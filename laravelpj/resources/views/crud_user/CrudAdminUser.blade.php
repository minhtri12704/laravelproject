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

    .action-icon {
        color: #ffccdd;
        font-size: 1.2rem;
        margin-right: 10px;
    }

    .action-icon:hover {
        color: #ff85c0;
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

<h2>Quản lý người dùng</h2>

@if(session('success') || session('error'))
<div id="alert-box" class="position-fixed top-50 start-50 translate-middle text-center p-4 rounded"
     style="z-index: 9999;
            background-color: {{ session('success') ? '#28a745' : '#dc3545' }};
            color: white;
            font-size: 18px;">
    {{ session('success') ?? session('error') }}
</div>

<script>
    setTimeout(function () {
        const alertBox = document.getElementById('alert-box');
        if (alertBox) {
            alertBox.style.display = 'none';
        }
    }, 4000);
</script>
@endif


<div class="text-end mb-3">
    <a href="{{ route('users.create') }}" class="btn btn-dark mb-3">Thêm người dùng</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Mã</th>
            <th>Tên</th>
            <th>SĐT</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Mật khẩu</th>
            <th>Phân quyền</th>
            <th>Chức năng</th>
        </tr>
    </thead>
    <tbody>
        @if($users->count())
        @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->phone }}</th>
            <th>{{ $user->email }}</th>
            <th>{{ $user->address }}</th>
            <th>{{ $user->password }}</th>
            <th>
                @if (!empty($user->roles) && $user->roles->count())
                @foreach($user->roles as $role)
                <span style="color: #ffccdd">{{ $role->name }}</span>
                @endforeach
                @else
                <span class="text-muted fst-italic">Chưa gán</span>
                @endif
            </th>

            <th>
                <!-- Nút Sửa -->
                <form action="{{ route('users.edit', ['id' => $user->id]) }}" method="GET" style="display: inline-block;">
                    <button type="submit" class="edit" style="background-color: #ffa6c9; padding: 6px 12px; border: none; border-radius: 8px; color: white;">
                        Sửa
                    </button>
                </form>

                <!-- Nút Xóa -->
                <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete" style="background-color: #ff4d6d; padding: 6px 12px; border: none; border-radius: 8px; color: white;">
                        Xoá
                    </button>
                </form>

            </th>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection