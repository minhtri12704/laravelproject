@extends('dashboardHomePage')

@section('content')
<style>
    /* Cài đặt font, màu nền toàn trang */
    body {
        background-color: #ffffff;
        color: #222;
        font-family: 'Segoe UI', sans-serif;
    }

    /* Phần container chính của giỏ hàng */
    .cart-container {
        max-width: 100% !important;
        margin: 0;
        background: #fff;
        padding: 30px;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    /* Nhóm sản phẩm theo cửa hàng */
    .shop-group {
        border-top: 1px solid #eee;
        padding: 20px 0;
    }

    /* Tiêu đề tên shop */
    .shop-title {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 15px;
        color: #ff5722;
    }

    /* Thẻ sản phẩm */
    .cart-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        gap: 15px;
    }

    /* Ảnh sản phẩm */
    .cart-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
    }

    /* Thông tin sản phẩm */
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

    /* Cụm nút tăng giảm số lượng */
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

    /* Phần tổng cộng + nút mua hàng */
    .total-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        border-top: 1px solid #ddd;
        padding-top: 20px;
    }
</style>

<div class="cart-container w-100 px-4 py-5">
    <h3 class="mb-4">🛒 Giỏ hàng của bạn</h3>
    @if(session('success'))
    <div id="success-alert" style="position:fixed; top:20%; left:50%; transform:translateX(-50%); z-index:9999; background:#e6ffed; color:#1b5e20; padding:15px 25px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.2); font-weight:600;">
        {{ session('success') }}
    </div>
    @endif

    @if(!empty($cart))
    <form method="POST" action="{{ route('cart.view') }}">
        @csrf
        <div class="shop-group">
            <div class="shop-title">💼 Cửa hàng của bạn</div>

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
                        <!-- Nút giảm số lượng -->
                        <button type="submit" name="decrease" value="{{ $item['id'] }}">-</button>
                        <span>{{ $item['quantity'] }}</span>
                        <!-- Nút tăng số lượng -->
                        <button type="submit" name="increase" value="{{ $item['id'] }}">+</button>
                    </div>
                </div>
                <!-- Tổng tiền mỗi sản phẩm -->
                <div><strong>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ</strong></div>
                <!-- Nút xóa sản phẩm -->
                <div>
                    <a href="{{ route('cart.remove', $item['id']) }}" class="btn btn-sm btn-danger">Xóa</a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tổng tiền + Nút mua hàng -->
        <div class="total-section">
            <div>
                <!-- Checkbox chọn tất cả -->
                <input type="checkbox" id="select-all"> <label for="select-all">Chọn tất cả</label>
            </div>
            <div>
                <span class="me-3 fw-bold">Tổng cộng:</span>
                <span class="text-danger fw-bold h5" id="total-price">0đ</span>
                <!-- Nút mua hàng -->
                <button type="submit" id="buy-button" name="checkout" class="btn btn-danger ms-3">Mua hàng</button>
            </div>

            <!-- Thông báo khi không chọn sản phẩm nào -->
            <div id="alert-box" style="display:none; position:fixed; top:20%; left:50%; transform:translateX(-50%); z-index:9999; background:#ffebee; color:#c62828; padding:15px 25px; border-radius:8px; box-shadow:0 2px 6px rgba(0,0,0,0.2); font-weight:600;">
                Bạn chưa chọn sản phẩm nào để mua
            </div>
        </div>

    </form>
    @else
    <!-- Khi giỏ hàng trống -->
    <div class="text-center p-5">
        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="180">
        <h5 class="mt-3">Giỏ hàng trống</h5>
        <a href="{{ route('sanpham.index') }}" class="btn btn-primary mt-2">Tiếp tục mua sắm</a>
    </div>
    @endif
</div>

<script>
    // DOM selector
    const checkboxes = document.querySelectorAll('input[name="selected[]"]');
    const selectAll = document.getElementById('select-all');
    const buyBtn = document.getElementById('buy-button');
    const alertBox = document.getElementById('alert-box');

    // 1. Khi nhấn nút Mua hàng
    buyBtn.addEventListener('click', function(e) {
        const checked = document.querySelectorAll('input[name="selected[]"]:checked').length;

        // Nếu chưa tick chọn sản phẩm nào
        if (checked === 0) {
            e.preventDefault(); // Ngăn submit form
            showAlert(); // Hiện thông báo
        }
    });

    // 2. Hiển thị thông báo lỗi trong 3 giây
    function showAlert() {
        alertBox.style.display = 'block';
        setTimeout(() => {
            alertBox.style.display = 'none';
        }, 3000); // 3 giây
    }

    // 3. Cập nhật nội dung nút Mua hàng theo số sản phẩm đã tick chọn
    function updateBuyButton() {
        const checked = document.querySelectorAll('input[name="selected[]"]:checked').length;
        buyBtn.textContent = checked > 0 ? `Mua hàng (${checked})` : 'Mua hàng';
    }

    // 4. Cập nhật tổng tiền theo sản phẩm được chọn
    function updateTotalPrice() {
        const selectedCheckboxes = document.querySelectorAll('input[name="selected[]"]:checked');
        let total = 0;
        selectedCheckboxes.forEach(cb => {
            const itemDiv = cb.closest('.cart-item');
            const price = parseFloat(itemDiv.getAttribute('data-price'));
            const quantity = parseInt(itemDiv.getAttribute('data-quantity'));
            total += price * quantity;
        });

        const totalPriceEl = document.getElementById('total-price');
        totalPriceEl.textContent = total.toLocaleString('vi-VN') + 'đ';
    }

    // 5. Khi chọn hoặc bỏ chọn từng sản phẩm
    checkboxes.forEach(cb => cb.addEventListener('change', () => {
        updateBuyButton();
        updateTotalPrice();
    }));

    // 6. Khi bấm "Chọn tất cả"
    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBuyButton();
            updateTotalPrice();
        });
    }

    // Ẩn thông báo xóa thành công sau 3s
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 3000);
    }

    // 7. Gọi 1 lần khi load trang
    updateBuyButton();
    updateTotalPrice();
    //
</script>
@endsection
