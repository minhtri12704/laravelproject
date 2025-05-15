@extends('dashboardHomePage')


@section('content')
<style>
    body {
        background-color: #ffffff !important;
    }
    h3 {
        color: black;
    }
    table,th,tr {
        border: 3px solid black;
    }
    .table {
        border: 3px solid black;
    }
</style>
<div class="container mt-5 mb-5">
    <h3 class="mb-4">Giỏ hàng của bạn</h3>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(!empty($cart))
    <table class="table table-bordered text-center">
        <thead class="table-success">
            <tr>
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($cart as $item)
            @php $total += $item['price'] * $item['quantity']; @endphp
            <tr>
                <td><img src="{{ asset('images/' . $item['image']) }}" width="70" height="70" style="object-fit: cover;">
                </td>
                <td>{{ $item['name'] }}</td>
                <td>{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</td>
                <td>
                    <a href="{{ route('cart.remove', $item['id']) }}" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                <td colspan="2" class="fw-bold text-danger">{{ number_format($total, 0, ',', '.') }}đ</td>
            </tr>
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="/" class="btn btn-secondary">Tiếp tục mua sắm</a>
        <a href="#" class="btn btn-warning">Đặt hàng</a>
    </div>
    @else
    <div class="text-center p-5">
        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="180">
        <h5 class="mt-3">Giỏ hàng trống</h5>
        <a href="/" class="btn btn-primary mt-2">Tiếp tục mua sắm</a>
    </div>
    @endif
</div>
@endsection