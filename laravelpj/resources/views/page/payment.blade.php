@extends('dashboardHomePage')

@section('title', 'Thanh Toán')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', sans-serif;
    }

    .checkout-container {
        max-width: 1140px;
        margin: 40px auto;
    }

    .form-box, .product-box {
        color: black;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 30px;
    }

    h2, h4 {
        font-weight: bold;
        color: #333;
    }

    label {
        font-weight: 600;
        margin-top: 10px;
    }

    input, select {
        margin-bottom: 15px;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    button {
        padding: 14px;
        font-size: 18px;
        background-color: #007bff;
        border: none;
        border-radius: 10px;
        color: white;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    .note {
        text-align: center;
        font-size: 14px;
        color: #666;
        margin-top: 20px;
    }

    .table thead th {
        background-color: #f0f0f0;
    }

    .table img {
        border-radius: 8px;
    }
</style>

<div class="container checkout-container">
    <div class="row g-4">
        <!-- Thông tin thanh toán -->
        <div class="col-md-5">
            <div class="form-box">
                <h2 class="text-center mb-4">🔒 Thanh Toán</h2>

                @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('payment.process') }}" method="POST">
                    @csrf

                    <label for="name">Họ và Tên</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>

                    <label for="address">Địa chỉ giao hàng</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control" required>

                    <label for="payment_method">Phương thức thanh toán</label>
                    <select id="payment_method" name="payment_method" class="form-select" required>
                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tiền mặt</option>
                        <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>Chuyển khoản</option>
                    </select>

                    <label for="amount">Số tiền (VNĐ)</label>
                    <input type="text" id="amount" name="amount" value="{{ session('success') ? '' : old('amount', $total ?? '') }}" class="form-control" readonly required>

                    <button type="submit" class="w-100 mt-3">💳 Thanh Toán</button>
                </form>

                <div class="note">
                    Cảm ơn bạn đã mua sắm cùng chúng tôi!
                </div>
            </div>
        </div>

        <!-- Sản phẩm đã chọn -->
        <div class="col-md-7">
            <div class="product-box">
                <h4 class="text-center mb-4">🛒 Sản phẩm đã chọn</h4>

                @if(!empty($selectedItems))
                <table class="table table-bordered align-middle text-center">
                    <thead>
                        <tr>
                            <th>Hình</th>
                            <th>Mã</th>
                            <th>Tên</th>
                            <th>SL</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($selectedItems as $item)
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" width="60" height="60" style="object-fit:cover;">
                            </td>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }}đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-center text-muted">Không có sản phẩm nào được chọn.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
