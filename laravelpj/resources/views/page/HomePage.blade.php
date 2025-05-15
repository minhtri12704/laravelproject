@extends('dashboardHomePage')

@section('title', 'Trang chủ')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
body {
    background-color: #ffffff;
    color: #222;
    font-family: 'Segoe UI', sans-serif;
}
.section-title {
    font-size: 28px;
    font-weight: bold;
    color: #007bff;
    border-bottom: 2px solid #f48fb1;
    margin: 40px 0 20px 0;
    text-align: center;
}
.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
@media (max-width: 992px) {
    .product-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 600px) {
    .product-grid {
        grid-template-columns: 1fr;
    }
}
.product-card {
    background-color: #fff;
    border-radius: 12px;
    padding: 16px;
    color: #222;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    position: relative;
    border: 1px solid #eee;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
}
.product-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 10px;
}
/* .search-bar {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
}

.search-bar input {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background-color: #f5f5f5;
    color: #333;
    width: 300px;
    outline: none;
} */
.product-name {
    font-size: 18px;
    font-weight: bold;
    color: #222;
    margin: 8px 0;
}
.product-price {
    font-size: 16px;
    color: rgb(85, 34, 34);
}
.favorite-icon {
    position: absolute;
    top: 12px;
    right: 12px;
    font-size: 20px;
    color: #e91e63;
    cursor: pointer;
    transition: transform 0.3s;
}
.favorite-icon:hover {
    transform: scale(1.2);
    color: #ad1457;
}
.btn-cart {
    margin-top: 10px;
    background-color: rgb(16, 131, 255);
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}
.btn-cart:hover {
    background-color: rgb(0, 110, 228);
}
.banner-container {
    overflow: hidden;
    width: 100vw;
    height: 400px;
    margin: 0 auto;
    position: relative;
}
.banner-slider {
    display: flex;
    width: 300%;
    animation: slideLeft 35s ease-in-out infinite;
}
.banner-slider img {
    width: 100vw;
    height: 100%;
    object-fit: cover;
    flex-shrink: 0;
}
.banner-container:hover .banner-slider {
    animation-play-state: paused;
}
@keyframes slideLeft {
    0%, 10% { transform: translateX(0%); }
    20%, 30% { transform: translateX(-100%); }
    40%, 50% { transform: translateX(-200%); }
    60%, 100% { transform: translateX(0%); }
}
.service-section {
    margin: 40px auto;
    max-width: 1100px;
    padding: 0 20px;
}
.service-wrapper {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 20px;
}
.service-box {
    background-color: #f9f9f9;
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    flex: 1 1 280px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    border: 1px solid #eee;
    transition: all 0.3s ease;
}
.service-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
}
.service-box i {
    font-size: 36px;
    color: #e91e63;
    margin-bottom: 10px;
}
.service-box h4 {
    font-size: 18px;
    font-weight: bold;
    color: #222;
    margin-bottom: 10px;
}
.service-box p {
    font-size: 14px;
    color: #555;
    line-height: 1.6;
}
.custom-toast {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #28a745;
    color: white;
    padding: 14px 22px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    font-size: 15px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.5s ease;
    z-index: 9999;
}
.custom-toast.show {
    opacity: 1;
    transform: translateY(0);
}
#flashCountdown {
    font-size: 22px;
    font-weight: bold;
    color: red;
    padding: 4px 10px;
    border: 2px dashed red;
    border-radius: 6px;
    background-color: #fff3f3;
}
</style>

<div class="banner-container">
    <div class="banner-slider">
        @forelse ($products->take(4) as $product)
        <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->ten_san_pham }}">
        @empty
        <img src="{{ asset('images/maylanh3.jpg') }}" alt="Banner default">
        @endforelse
    </div>
</div>

<section class="flash-sale mt-5">
    <h2 class="section-title">Khuyến mãi Online</h2>
    <div class="text-center mb-4">
        <strong>Chỉ còn:</strong>
        <span id="flashCountdown">01:30:00</span>
    </div>
    <div class="product-grid">
        @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->ten_san_pham }}">
            <div class="product-name">{{ $product->ten_san_pham }}</div>
            @if ($product->gia_km && $product->gia_km < $product->gia_goc)
            <div class="product-price text-danger fw-bold">{{ number_format($product->gia_km, 0, ',', '.') }}<sup>đ</sup></div>
            <div style="color: gray; text-decoration: line-through; font-size: 14px;">
                {{ number_format($product->gia_goc, 0, ',', '.') }}<sup>đ</sup>
                <span style="color: red; font-weight: bold; margin-left: 8px;">-{{ floor((($product->gia_goc - $product->gia_km) / $product->gia_goc) * 100) }}%</span>
            </div>
            <div style="margin-top: 8px;">
                <span style="background: linear-gradient(to right, #ffd700, #ffae00); padding: 4px 10px; border-radius: 12px; font-weight: bold;">🔥 Còn {{ rand(5, 100) }}/100 suất</span>
            </div>
            <a href="#" class="btn btn-outline-primary mt-2">Mua ngay</a>
            @else
            <div class="product-price fw-bold">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div>
            @endif
        </div>
        @endforeach
    </div>
</section>

<section style="margin: 40px 0;">
    <h2 class="section-title">Sản phẩm nổi bật</h2>
    <div class="product-grid">
        @foreach ($bestSellers as $product)
        <div class="product-card">
            <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->ten_san_pham }}">
            <div class="product-name">{{ $product->ten_san_pham }}</div>
            <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div>
        </div>
        @endforeach
    </div>
</section>
<!-- Search
<div class="container mt-4">
    <form method="GET" action="{{ route('home') }}" class="search-bar">
        <input type="text" name="search" placeholder="Tìm sản phẩm..." value="{{ old('search', $search ?? '') }}">
    </form>
-->
<h2 class="section-title" id="product-list">Danh sách sản phẩm</h2>
<div style="text-align: right; margin-bottom: 20px;">
    <a href="{{ route('wishlist.show_wishlist') }}" class="btn btn-primary"><i class="bi bi-heart-fill"></i> Danh sách yêu thích</a>
</div>
<div class="product-grid">
    @forelse ($products as $product)
    <div class="product-card">
        <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="favorite-icon" style="border: none; background: none;">♥</button>
        </form>
        <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->ten_san_pham }}">
        <div class="product-name">{{ $product->ten_san_pham }}</div>
        <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div> <br>
        <a href="{{ route('chitietsanpham.show', $product->id) }}" class="btn-cart">
            <i class="bi bi-eye"></i> Xem chi tiết
        </a>
    </div>
    @empty
    <p style="grid-column: 1 / -1; text-align: center;">Không có sản phẩm nào.</p>
    @endforelse
</div>
<div style="margin-top: 30px; text-align: center;">{{ $products->withQueryString()->links() }}</div>

<section class="service-section">
    <h2 class="section-title">Tại sao chọn chúng tôi?</h2>
    <div class="service-wrapper">
        <div class="service-box"><i class="bi bi-truck"></i><h4>Miễn phí giao hàng</h4><p>Đơn hàng từ 500.000đ sẽ được giao hàng miễn phí toàn quốc.</p></div>
        <div class="service-box"><i class="bi bi-arrow-repeat"></i><h4>Đổi trả dễ dàng</h4><p>Đổi trả trong 7 ngày nếu bạn không hài lòng với sản phẩm.</p></div>
        <div class="service-box"><i class="bi bi-headset"></i><h4>Hỗ trợ 24/7</h4><p>Chúng tôi luôn sẵn sàng tư vấn và hỗ trợ mọi lúc, mọi nơi.</p></div>
    </div>
</section>
@if(session('success'))
<div id="wishlist-toast" class="custom-toast">{{ session('success') }}</div>
@endif
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toast = document.getElementById('wishlist-toast');
    if (toast) {
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2500);
    }
    let totalSeconds = 5400;
    const countdownElement = document.getElementById("flashCountdown");
    setInterval(() => {
        if (totalSeconds <= 0) return;
        totalSeconds--;
        const hrs = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
        const mins = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
        const secs = String(totalSeconds % 60).padStart(2, '0');
        countdownElement.textContent = `${hrs}:${mins}:${secs}`;
    }, 1000);
});
</script>
@endsection
