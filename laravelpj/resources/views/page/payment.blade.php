@extends('dashboardHomePage')

@section('title', 'Thanh Toán')

@section('content')
<style>
body {
    background-color: #ffffff;
    color: #222;
    font-family: 'Segoe UI', sans-serif;
}

.container-pay {
    max-width: 500px;
    margin: 50px auto;
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 30px;
    font-family: 'Quicksand', sans-serif;
}

h2 {
    text-align: center;
    color: rgb(0, 0, 0);
    margin-bottom: 30px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 800;
    color: rgba(0, 0, 0, 0.74);
}

input[type="text"],
input[type="email"],
input[type="number"],
select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 16px;
}

button {
    width: 100%;
    padding: 14px;
    background-color: rgb(53, 41, 216);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: rgb(2, 52, 134);
}

.note {
    text-align: center;
    font-size: 14px;
    color: #616161;
    margin-top: 20px;
}

.container-pay {
    margin-top: 5%;
}

.alert {
    padding: 15px;
    background-color: #4CAF50;
    color: white;
    margin-bottom: 20px;
    border-radius: 8px;
}
</style>
<div class="container py-5">
    <div class="row g-4 align-items-start">
        <!-- FORM Thanh toán bên trái -->
        <div class="col-md-5">
            <div class="bg-white shadow rounded-4 p-4 h-100">
                <h2 class="text-center mb-4">Thông Tin Thanh Toán</h2>

                @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('payment.process') }}" method="POST">
                    @csrf

                    <label for="name">Họ và Tên</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control mb-3"
                        required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control mb-3"
                        required>

                    <label for="address">Địa chỉ giao hàng</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}"
                        class="form-control mb-3" required>

                    <label for="payment_method">Phương thức thanh toán</label>
                    <select id="payment_method" name="payment_method" class="form-select mb-3" required>
                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tiền mặt</option>
                        <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>Chuyển khoản
                        </option>
                    </select>

                    <label for="amount">Số tiền (VNĐ)</label>
                    <input type="text" id="amount" name="amount"
                        value="{{ session('success') ? '' : old('amount', $total ?? '') }}" class="form-control mb-4"
                        readonly required>

                    <button type="submit" class="btn btn-primary w-100">Thanh Toán</button>
                </form>

                <div class="note text-center mt-3">
                    Cảm ơn bạn đã mua sắm cùng chúng tôi!
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm bên phải -->
        <div class="col-md-7">
            <div class="bg-white shadow rounded-4 p-4 h-100">
                <h4 class="text-center mb-4">🧾 Sản phẩm đã chọn</h4>

                @if(!empty($selectedItems))
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
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
                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" width="60"
                                    height="60" style="object-fit:cover; border-radius: 6px;">
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

<div class="note">
    Cảm ơn bạn đã mua sắm cùng chúng tôi!
</div>
</div>
@endsection