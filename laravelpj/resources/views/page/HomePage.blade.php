@extends('dashboardHomePage')

@section('title', 'Trang chủ')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
body {
    background: #f8f9fa;
    color: #222;
    font-family: 'Segoe UI', sans-serif;
}

.section-title {
    font-size: 28px;
    font-weight: 700;
    color: #343a40;
    border-left: 8px solid #007bff;
    padding-left: 16px;
    margin: 50px 0 20px;
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
    border-radius: 16px;
    padding: 20px;
    color: #222;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.07);
    position: relative;
    border: none;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

.product-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 12px;
}

.product-name {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-top: 10px;
}

.product-price {
    font-size: 16px;
    color: #28a745;
    font-weight: bold;
    margin-top: 6px;
}

.favorite-icon {
    position: absolute;
    top: 14px;
    right: 14px;
    font-size: 22px;
    color: #ff4081;
    cursor: pointer;
    background: none;
    border: none;
}

.favorite-icon:hover {
    transform: scale(1.1);
}

.btn-cart {
    background-color: #007bff;
    color: white;
    border-radius: 30px;
    padding: 8px 16px;
    font-weight: 500;
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
}

.btn-cart:hover {
    background-color: #0056b3;
}

.banner-container {
    overflow: hidden;
    width: 100%;
    height: 400px;
    margin-top: 20px;
    border-radius: 12px;
}

.banner-slider {
    display: flex;
    width: 300%;
    animation: fadeSlider 18s infinite ease-in-out;
}

.banner-slider img {
    width: 100vw;
    height: 100%;
    object-fit: cover;
    flex-shrink: 0;
}

@keyframes fadeSlider {

    0%,
    33% {
        transform: translateX(0%);
    }

    33.01%,
    66% {
        transform: translateX(-100%);
    }

    66.01%,
    100% {
        transform: translateX(-200%);
    }
}

.service-section {
    margin: 50px auto;
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
    background-color: #ffffff;
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    flex: 1 1 280px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.service-box:hover {
    transform: translateY(-6px);
}

.service-box i {
    font-size: 36px;
    color: #007bff;
    margin-bottom: 10px;
}

.service-box h4 {
    font-size: 18px;
    font-weight: bold;
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
</style>


<div class="banner-container">
    <div id="bannerFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            @foreach ($products->take(3) as $index => $product)
                <button type="button" data-bs-target="#bannerFade" data-bs-slide-to="{{ $index }}" @if($index === 0) class="active" aria-current="true" @endif aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($products->take(3) as $index => $product)
                <div class="carousel-item @if($index === 0) active @endif">
                    <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="{{ $product->ten_san_pham }}">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Trước</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Sau</span>
        </button>
    </div>
</div>


<section class="flash-sale mt-5">
    <h2 class="section-title">Khuyến mãi Online</h2>
    <!-- <div style="text-align:right;margin-top:-2%">
        <button onclick="toggleDarkMode()" class="btn btn-dark">🌓 Đổi chế độ</button>
    </div> -->
    <div class="text-center mb-4">
        <span class="badge bg-danger text-white fs-5 p-2 rounded-3">
            Còn <span id="flashCountdown">01:30:00</span>
        </span>
    </div>
    <div class="product-grid">
        @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->ten_san_pham }}">
            <div class="product-name">{{ $product->ten_san_pham }}</div>
            @if ($product->gia_km && $product->gia_km < $product->gia_goc)
                <div class="product-price text-danger fw-bold">
                    {{ number_format($product->gia_km, 0, ',', '.') }}<sup>đ</sup></div>
                <div style="color: gray; text-decoration: line-through; font-size: 14px;">
                    {{ number_format($product->gia_goc, 0, ',', '.') }}<sup>đ</sup>
                    <span
                        style="color: red; font-weight: bold; margin-left: 8px;">-{{ floor((($product->gia_goc - $product->gia_km) / $product->gia_goc) * 100) }}%</span>
                </div>
                <a href="#" class="btn-cart mt-2">Mua ngay</a>
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

<h2 class="section-title" id="product-list">Danh sách sản phẩm</h2>
<div style="text-align: right; margin-bottom: 20px;">
    <a href="{{ route('wishlist.show_wishlist') }}" class="btn btn-primary"><i class="bi bi-heart-fill"></i> Danh sách
        yêu thích</a>
</div>
<div class="product-grid">
    @forelse ($products as $product)
    <div class="product-card">
        <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="favorite-icon">♥</button>
        </form>
        <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->ten_san_pham }}">
        <div class="product-name">{{ $product->ten_san_pham }}</div>
        <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div>
        <a href="{{ route('chitietsanpham.show', $product->id) }}" class="btn-cart"><i class="bi bi-eye-fill"></i> Xem
            chi tiết</a>
    </div>
    @empty
    <p style="grid-column: 1 / -1; text-align: center;">Không có sản phẩm nào.</p>
    @endforelse
</div>
<div style="margin-top: 30px; text-align: center;">{{ $products->withQueryString()->links() }}</div>

<section class="service-section">
    <h2 class="section-title">Tại sao chọn chúng tôi?</h2>
    <div class="service-wrapper">
        <div class="service-box"><i class="bi bi-truck"></i>
            <h4>Miễn phí giao hàng</h4>
            <p>Đơn hàng từ 500.000đ sẽ được giao hàng miễn phí toàn quốc.</p>
        </div>
        <div class="service-box"><i class="bi bi-arrow-repeat"></i>
            <h4>Đổi trả dễ dàng</h4>
            <p>Đổi trả trong 7 ngày nếu bạn không hài lòng với sản phẩm.</p>
        </div>
        <div class="service-box"><i class="bi bi-headset"></i>
            <h4>Hỗ trợ 24/7</h4>
            <p>Chúng tôi luôn sẵn sàng tư vấn và hỗ trợ mọi lúc, mọi nơi.</p>
        </div>
    </div>
</section>

@if(session('success'))
<div id="wishlist-toast" class="custom-toast">{{ session('success') }}</div>
@endif

<script>
document.addEventListener("DOMContentLoaded", function() {
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

<script>
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

document.addEventListener("DOMContentLoaded", function() {
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }

    // Hiện popup sau 3 giây
    setTimeout(() => {
        alert('🎉 Ưu đãi đặc biệt hôm nay! Giảm 20K cho đơn hàng trên 200K!');
    }, 3000);

    // Cuộn lại đúng vị trí người dùng
    if (sessionStorage.scrollTop !== undefined) {
        window.scrollTo(0, sessionStorage.scrollTop);
    }
});

window.addEventListener("beforeunload", function() {
    sessionStorage.scrollTop = window.scrollY;
});
</script>

<style>
.dark-mode {
    background-color: #1e1e1e !important;
    color: #f5f5f5 !important;
}
.dark-mode .product-card,
.dark-mode .service-box {
    background-color: #2c2c2c;
    color: #f5f5f5;
}
.dark-mode .btn-cart {
    background-color: #444;
    color: white;
}
</style>