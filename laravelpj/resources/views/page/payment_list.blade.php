@extends('dashboardHomePage')

@section('title', 'Danh sách đơn thanh toán')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">🧾 Danh sách đơn hàng đã thanh toán</h2>
    @if($payments->count())
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Phương thức</th>
                <th>Số tiền</th>
                <th>Thời gian</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $key => $p)
            <tr>
                <td>{{ $payments->firstItem() + $key }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->email }}</td>
                <td>{{ $p->address }}</td>
                <td>{{ $p->payment_method == 'cash' ? 'Tiền mặt' : 'Chuyển khoản' }}</td>
                <td>{{ number_format($p->amount, 0, ',', '.') }}đ</td>
                <td>{{ $p->created_at->format('H:i d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $payments->links() }}
    </div>
    @else
    <div class="alert alert-info text-center">Chưa có đơn hàng nào được thanh toán.</div>
    @endif
</div>
@endsection
