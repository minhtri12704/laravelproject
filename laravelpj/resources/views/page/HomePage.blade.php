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

/* Banner slider */
.banner-container {
    overflow: hidden;
    width: 100vw;
    height: 400px;
    margin: 0 auto;
    position: relative;
    border-radius: 0;
}

.banner-slider {
    display: flex;
    width: 300%;
    animation: slideLeft 45s ease-in-out infinite;
}

.banner-slider img {
    width: 100vw;
    height: 100%;
    object-fit: cover;
    padding: 0;
    margin: 0;
    flex-shrink: 0;
}

.banner-container:hover .banner-slider {
    animation-play-state: paused;
}

@keyframes slideLeft {
    0%, 10% {
        transform: translateX(0%);
    }
    20%, 30% {
        transform: translateX(-100%);
    }
    40%, 50% {
        transform: translateX(-200%);
    }
    60%, 100% {
        transform: translateX(0%);
    }
}


/* Service Boxes */
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
</style>

<!-- Banner slider -->
<div class="banner-container">
    <div class="banner-slider">
        @forelse ($products->take(3) as $product)
        <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->ten_san_pham }}">
        @empty
        <img src="{{ asset('images/maylanh3.jpg') }}" alt="Banner 3">
        @endforelse
    </div>
</div>  
<!-- spnb -->
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
<!-- Product List -->
<h2 class="section-title" id="product-list">Danh sách sản phẩm</h2> <br>
<div class="product-grid">
    @forelse ($products as $product)
    <div class="product-card">
        <div class="favorite-icon" onclick="alert('Yêu thích rồi nhé 😍')">♥</div>
        <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->ten_san_pham }}">
        <div class="product-name">{{ $product->ten_san_pham }}</div>
        <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div>
        <button class="btn-cart">Thêm vào giỏ</button>
    </div>
    @empty
    <p style="grid-column: 1 / -1; text-align: center;">Không có sản phẩm nào.</p>
    @endforelse
</div>
<div style="margin-top: 30px; text-align: center;">
    {{ $products->withQueryString()->links() }}
</div>
<!-- Dịch vụ nổi bật -->
<section class="service-section">
    <h2 class="section-title">Tại sao chọn chúng tôi?</h2>
    <div class="service-wrapper">
        <div class="service-box">
            <i class="bi bi-truck"></i>
            <h4>Miễn phí giao hàng</h4>
            <p>Đơn hàng từ 500.000đ sẽ được giao hàng miễn phí trên toàn quốc.</p>
        </div>
        <div class="service-box">
            <i class="bi bi-arrow-repeat"></i>
            <h4>Đổi trả dễ dàng</h4>
            <p>Đổi trả trong 7 ngày nếu bạn không hài lòng với sản phẩm.</p>
        </div>
        <div class="service-box">
            <i class="bi bi-headset"></i>
            <h4>Hỗ trợ 24/7</h4>
            <p>Chúng tôi luôn sẵn sàng tư vấn và hỗ trợ mọi lúc, mọi nơi.</p>
        </div>
    </div>
</section>
<!-- Section dịch vụ nổi bật -->
<div class="service-section">
    <div class="service-wrapper">
        <div class="service-box">
            <i class="bi bi-truck"></i>
            <h4>Miễn phí giao hàng</h4>
            <p>Đơn từ 500K được giao hàng miễn phí toàn quốc, nhanh chóng và an toàn.</p>
        </div>
        <div class="service-box">
            <i class="bi bi-arrow-repeat"></i>
            <h4>Đổi trả 7 ngày</h4>
            <p>Không hài lòng? Đổi trả trong 7 ngày hoàn toàn miễn phí và dễ dàng.</p>
        </div>
        <div class="service-box">
            <i class="bi bi-headset"></i>
            <h4>Hỗ trợ 24/7</h4>
            <p>Đội ngũ chăm sóc khách hàng luôn sẵn sàng phục vụ bạn mọi lúc.</p>
        </div>
    </div>
</div>
<!-- Pagination -->

</div>
@endsection