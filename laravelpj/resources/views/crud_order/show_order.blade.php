@extends('dashboard')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<style>
  .detail-wrapper {
    max-width: 800px;
    margin: 40px auto;
    background-color: #1a1a1a;
    color: #ffb6c1;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(255, 182, 193, 0.2);
    font-size: 17px;
  }

  .back-btn {
    display: inline-block;
    margin-bottom: 20px;
    background-color: #ff69b4;
    color: white;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
  }

  .back-btn:hover {
    background-color: #ff3399;
  }

  .detail-wrapper ul {
    list-style: none;
    padding-left: 0;
  }

  .detail-wrapper li {
    padding: 10px 0;
    border-bottom: 1px solid #444;
  }

  .detail-wrapper strong {
    color: #ffc0cb;
    min-width: 150px;
    display: inline-block;
  }

  .order-image {
    display: block;
    margin: 20px auto;
    max-width: 100%;
    max-height: 300px;
    object-fit: contain;
    border: 2px solid #ff69b4;
    border-radius: 10px;
  }
</style>

<div class="detail-wrapper">
  <a href="{{ route('orders.index') }}" class="back-btn">← Quay lại</a>

  <h2 style="text-align: center; margin-bottom: 30px;">Chi tiết Đơn hàng</h2>

   @if ($order->hinh_anh)
    <img src="{{ asset('images/' . $order->hinh_anh) }}" alt="Hình đơn hàng" class="order-image">
  @endif

  <ul>
    <li><strong>Tên đơn hàng:</strong> {{ $order->ten_don_hang }}</li>
    <li><strong>Khách hàng:</strong> {{ $order->ten_khach_hang }}</li>
    <li><strong>Tổng tiền:</strong> {{ number_format($order->tong_tien, 0, ',', '.') }} VNĐ</li>
    <li><strong>Thanh toán:</strong> {{ $order->phuong_thuc_thanh_toan }}</li>
    <li><strong>Trạng thái:</strong> {{ $order->trang_thai }}</li>
    <li><strong>Ghi chú:</strong> {{ $order->ghi_chu }}</li>

  </ul>
</div>
@endsection