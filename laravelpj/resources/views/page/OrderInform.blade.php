@extends('dashboardHomePage')

@section('content')
<style>
    body {
        background-color: #ffffff;
        color: #222;
        font-family: 'Segoe UI', sans-serif;
    }

    .order-container {
        max-width: 900px;
        margin: 30px auto;
        background: #fff;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', sans-serif;
    }

    .order-container h3 {
        color: #ff5722;
        margin-bottom: 20px;
        font-weight: bold;
    }

    .order-summary {
        background: #fef7f1;
        border: 1px solid #ffd3b6;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .order-summary p {
        margin: 0;
        padding: 4px 0;
        font-size: 15px;
        color: #333;
    }

    .table {
        background: #fff;
        border-collapse: collapse;
        width: 100%;
    }

    .table thead {
        background: #f8f8f8;
    }

    .table th,
    .table td {
        padding: 12px 15px;
        border: 1px solid #ddd;
        text-align: center;
        font-size: 14px;
    }

    .btn-primary {
        background-color: #ff5722;
        border-color: #ff5722;
    }

    .btn-primary:hover {
        background-color: #e64a19;
        border-color: #e64a19;
    }
</style>

<div class="order-container">
    <h3>Đơn hàng của khách: {{ $khach->Ten }}</h3>

    @if(count($orders) > 0)
    <div class="order-summary">
        @foreach($orders as $order)
        <p><strong>{{ $order->ten_don_hang }}</strong> - Tổng: {{ number_format($order->tong_tien) }}đ</p>
        @endforeach
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID Đơn Hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ number_format($order->tong_tien) }} đ</td>
                <td>{{ $order->trang_thai }}</td>
                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                <td><a href="#" class="btn btn-sm btn-primary">Xem</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-warning">Khách hàng này chưa có đơn hàng nào.</div>
    @endif
</div>
@endsection