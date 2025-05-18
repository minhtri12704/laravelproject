@extends('dashboardHomePage')

@section('title', 'Thanh Toán')

@section('content')
<style>
body {
    background-color: rgb(64, 144, 224);
    font-family: 'Quicksand', sans-serif;
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

<div class="container-pay">
    <h2>Thông Tin Thanh Toán</h2>
    @if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf

        <label for="name">Họ và Tên</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="address">Địa chỉ giao hàng</label>
        <input type="text" id="address" name="address" value="{{ old('address') }}" required>

        <label for="payment_method">Phương thức thanh toán</label>
        <select id="payment_method" name="payment_method" required>
            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tiền mặt (Thanh toán khi nhận
                hàng)</option>
            <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>Chuyển khoản ngân hàng</option>
        </select>

        <label for="amount">Số tiền (VNĐ)</label>
        <input type="text" id="amount" name="amount" value="{{ old('amount', $total ?? '') }}" readonly required>

        <button type="submit">Thanh Toán</button>
    </form>

    <div class="note">
        Cảm ơn bạn đã mua sắm cùng chúng tôi!
    </div>
</div>
@endsection
