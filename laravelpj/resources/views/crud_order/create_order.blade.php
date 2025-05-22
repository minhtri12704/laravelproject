@extends('dashboard')

@section('title', 'Thêm Đơn Hàng')

@section('content')
<style>
  .form-wrapper {
    max-width: 720px;
    margin: 40px auto;
    background-color: #1a1a1a;
    color: #ffb6c1;
    padding: 35px;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(255, 182, 193, 0.2);
    font-size: 16px;
  }

  .form-wrapper h2 {
    color: #ff85c0;
    text-align: center;
    margin-bottom: 30px;
    font-weight: bold;
  }

  label {
    margin-top: 18px;
    display: block;
    font-weight: bold;
    color: #ffb6c1;
  }

  input, select, textarea {
    width: 100%;
    background-color: #2b2b2b;
    color: #ffb6c1;
    border: 1px solid #444;
    border-radius: 8px;
    padding: 12px 14px;
    margin-top: 8px;
    transition: border-color 0.3s;
  }

  input:focus, select:focus, textarea:focus {
    border-color: #ff69b4;
    outline: none;
  }

  textarea {
    resize: vertical;
  }

  .form-actions {
    margin-top: 30px;
    text-align: right;
  }

  .btn-submit {
    background-color: #ff69b4;
    color: #fff;
    padding: 10px 24px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    font-size: 16px;
    transition: background-color 0.3s ease;
  }

  .btn-submit:hover {
    background-color: #ff3399;
  }
</style>

<div class="form-wrapper">
  <h2>Thêm Đơn Hàng Mới</h2>

  <form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <label for="ten_don_hang">Tên đơn hàng</label>
    <input type="text" name="ten_don_hang" placeholder="Nhập tên đơn hàng..." required>

    <label for="ten_khach_hang">Tên khách hàng</label>
    <input type="text" name="ten_khach_hang" placeholder="Nhập tên khách hàng..." required>

    <label for="tong_tien">Tổng tiền (VNĐ)</label>
    <input type="number" name="tong_tien" min="0" placeholder="VD: 500000">

    <label for="phuong_thuc_thanh_toan">Phương thức thanh toán</label>
    <select name="phuong_thuc_thanh_toan" required>
      <option value="">-- Chọn phương thức --</option>
      <option value="Tiền mặt">Tiền mặt</option>
      <option value="Chuyển khoản">Chuyển khoản</option>
      <option value="Thẻ tín dụng">Thẻ tín dụng</option>
    </select>

    <label for="trang_thai">Trạng thái</label>
    <select name="trang_thai" required>
      <option value="">-- Chọn trạng thái --</option>
      <option value="Chưa xử lý">Chưa xử lý</option>
      <option value="Đang xử lý">Đang xử lý</option>
      <option value="Đã xử lý">Đã xử lý</option>
    </select>

    <label for="ghi_chu">Ghi chú</label>
    <textarea name="ghi_chu" rows="3" placeholder="VD: Giao gấp trước thứ 6..."></textarea>

    <div class="form-actions">
      <button type="submit" class="btn-submit">Lưu đơn hàng</button>
    </div>
  </form>
</div>
@endsection