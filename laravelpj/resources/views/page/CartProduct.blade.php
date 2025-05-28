@extends('dashboardHomePage')

@section('content')
<style>
    body {
        background-color: #ffffff;
        color: #222;
        font-family: 'Segoe UI', sans-serif;
    }

    .cart-container {
        max-width: 100% !important;
        margin: 0;
        background: #fff;
        padding: 30px;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .shop-group {
        border-top: 1px solid #eee;
        padding: 20px 0;
    }

    .shop-title {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 15px;
        color: #ff5722;
    }

    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        gap: 15px;
    }

    .cart-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
    }

    .cart-info {
        flex-grow: 1;
    }

    .cart-info .name {
        font-weight: 500;
        margin-bottom: 5px;
    }

    .price {
        font-weight: 700;
        color: #d32f2f;
    }

    .quantity-controls {
        display: flex;
        gap: 5px;
        align-items: center;
        margin-top: 8px;
    }

    .quantity-controls button {
        width: 25px;
        height: 25px;
        font-size: 14px;
        border: 1px solid #ccc;
        background: #f9f9f9;
        cursor: pointer;
    }

    .total-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        border-top: 1px solid #ddd;
        padding-top: 20px;
    }

    .total-section {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 20px;
    }
</style>
@php
$khach = Auth::guard('khach')->user();
@endphp

@if ($khach)
<div class="d-flex justify-content-start ms-3">
    <a href="{{ route('orders.byKhach', ['id' => $khach->idKhach]) }}" class="btn btn-outline-primary">
        Thông tin thanh toán
    </a>
</div>
@else
<div class="d-flex justify-content-start ms-3">
    <a href="{{ route('login') }}" class="btn btn-outline-secondary">
        Đăng nhập để xem đơn hàng
    </a>
</div>
@endif



<hr>
<!-- Nút quay lại -->
<a href="{{ route('sanpham.index') }}" class="come" style="font-size: 1.8rem;" title="Quay lại">
    <i class="bi bi-arrow-left-circle-fill"></i>
</a>
<div class="cart-container w-100 px-4 py-5">
    <h3 class="mb-4">🛒 Giỏ hàng của bạn</h3>
    <div class="d-flex align-items-center mb-3 ps-1">
        <input type="checkbox" id="select-all" class="form-check-input me-2">
        <label for="select-all" class="form-check-label">Chọn tất cả sản phẩm</label>
    </div>

    @if(session('success'))
    <div id="success-alert"
        style="position:fixed; top:20%; left:50%; transform:translateX(-50%); z-index:9999; background:#e6ffed; color:#1b5e20; padding:15px 25px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.2); font-weight:600;">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div id="error-alert"
        style="position:fixed; top:28%; left:50%; transform:translateX(-50%); z-index:9999; background:#ffe6e6; color:#d32f2f; padding:15px 25px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.2); font-weight:600;">
        {{ session('error') }}
    </div>
    @endif


    @if(!empty($cart))
    @php $total = 0; @endphp

    <form method="POST" action="{{ route('cart.update') }}">
        @csrf
        <div class="shop-group">
            @foreach($cart as $item)
            <div class="cart-item shadow-sm border rounded-3 p-3 bg-white"
                data-price="{{ $item['price'] }}"
                data-quantity="{{ $item['quantity'] }}">
                <input type="checkbox" name="selected[]" value="{{ $item['id'] }}">
                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}">
                <div class="cart-info">
                    <div class="name">{{ $item['name'] }}</div>
                    <div class="price">{{ number_format($item['price'], 0, ',', '.') }}đ</div>
                    <div class="quantity-controls">
                        <button type="submit" name="decrease" value="{{ $item['id'] }}">-</button>
                        <span>{{ $item['quantity'] }}</span>
                        <button type="submit" name="increase" value="{{ $item['id'] }}">+</button>
                    </div>
                </div>
                <div><strong>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</strong></div>
                <div>
                    <a href="{{ route('cart.remove', $item['id']) }}" class="btn btn-sm btn-danger">Xóa</a>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Nhập mã giảm giá -->
        <div class="d-flex justify-content-between align-items-center mt-4 px-2">
            <div class="fw-semibold" style="color: #555;">
                🔖 Bạn có mã giảm giá?
            </div>
            <div class="d-flex gap-2">
                <input type="text" id="discount-code" class="form-control" placeholder="Nhập mã..." style="width: 200px;">
                <button type="button" id="apply-discount" class="btn btn-warning">Áp dụng</button>
            </div>
        </div>

        {{-- tong tien --}}
        <div class="total-section justify-content-end">
            <div class="d-flex align-items-center gap-3">
                <span class="fw-bold">Tổng cộng:</span>
                <span class="text-danger fw-bold h5 mb-0" id="total-price">0đ</span>
                <button type="submit" id="buy-button" name="checkout" class="btn btn-danger">Mua hàng</button>
            </div>
        </div>


    </form>
    @else
    <div class="text-center p-5">
        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="180">
        <h5 class="mt-3">Giỏ hàng trống</h5>
        <a href="{{ route('sanpham.index') }}" class="btn btn-primary mt-2">Tiếp tục mua sắm</a>
    </div>
    @endif
</div>

<script>
    let appliedDiscount = 0;
    let discountType = null;
    let isDiscountApplied = false;

    const checkboxes = document.querySelectorAll('input[name="selected[]"]');
    const selectAll = document.getElementById('select-all');
    const buyBtn = document.getElementById('buy-button');

    buyBtn.addEventListener('click', function(e) {
        const checked = document.querySelectorAll('input[name="selected[]"]:checked').length;
        if (checked === 0) {
            e.preventDefault();
            alert('Vui lòng chọn ít nhất 1 sản phẩm để mua!');
        }
    });

    function updateBuyButton() {
        const checked = document.querySelectorAll('input[name="selected[]"]:checked').length;
        buyBtn.textContent = checked > 0 ? `Mua hàng (${checked})` : 'Mua hàng';
    }

    function updateTotalPrice() {
        const selectedCheckboxes = document.querySelectorAll('input[name="selected[]"]:checked');
        let total = 0;
        selectedCheckboxes.forEach(cb => {
            const itemDiv = cb.closest('.cart-item');
            const price = parseFloat(itemDiv.getAttribute('data-price'));
            const quantity = parseInt(itemDiv.getAttribute('data-quantity'));
            total += price * quantity;
        });

        let finalTotal = total;

        if (discountType === 'percent') {
            finalTotal = total - (total * appliedDiscount / 100);
        } else if (discountType === 'fixed') {
            finalTotal = total - appliedDiscount;
        }

        if (finalTotal < 0) finalTotal = 0;

        document.getElementById('total-price').textContent = finalTotal.toLocaleString('vi-VN') + 'đ';
    }

    checkboxes.forEach(cb => cb.addEventListener('change', () => {
        updateBuyButton();
        updateTotalPrice();
    }));

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBuyButton();
            updateTotalPrice();
        });
    }

    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 3000);
    }
    const errorAlert = document.getElementById('error-alert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 3000);
    }

    document.getElementById('apply-discount').addEventListener('click', function() {
        if (isDiscountApplied) {
            alert('Bạn đã áp dụng mã giảm giá rồi.');
            return;
        }

        const code = document.getElementById('discount-code').value.trim();
        if (!code) return;

        fetch(`/check-discount?code=${code}`)
            .then(res => res.json())
            .then(data => {
                if (data.valid) {
                    appliedDiscount = data.amount;
                    discountType = data.type;
                    isDiscountApplied = true;

                    updateTotalPrice();

                    // Disable sau khi áp dụng
                    document.getElementById('discount-code').disabled = true;
                    document.getElementById('apply-discount').disabled = true;
                } else {
                    appliedDiscount = 0;
                    discountType = null;
                    updateTotalPrice();
                    alert('Mã giảm giá không hợp lệ hoặc đã hết hạn!');
                }
            });
    });


    updateBuyButton();
    updateTotalPrice();
</script>

@endsection