@extends('dashboardHomePage')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<style>
body {
    background-color: #ffffff;
    color: #000000;
}

h2 {
    color: #000000;
}

.card {
    background-color: #ffffff;
    color: #000000;
    border: 1px solid #ddd;
}

.btn-dark {
    background-color: #343a40;
    color: #ffffff;
    border: none;
}

.btn-dark:hover {
    background-color: #495057;
}

.star {
    font-size: 1.5rem;
    cursor: pointer;
    color: #cccccc;
}

.star.active {
    color: #ff9900 !important;
}
</style>

<!-- Nút quay lại -->
<a href="{{ route('sanpham.index') }}" class="come" style="font-size: 1.8rem;" title="Quay lại">
    <i class="bi bi-arrow-left-circle-fill"></i>
</a>

<div class="container mt-5">
    <div class="row">
        <!-- Hình ảnh -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/' . $chiTietSanPham->image) }}" class="img-fluid rounded"
                alt="{{ $chiTietSanPham->name }}" style="max-height: 400px;">
        </div>

        <!-- Thông tin -->
        <div class="col-md-6">
            <h2>{{ $chiTietSanPham->name }}</h2>
            <h4 class="text-danger">{{ number_format($chiTietSanPham->price, 0, ',', '.') }} đ</h4>

            <p><strong>Đánh giá của bạn:</strong></p>
            <div class="d-flex align-items-center gap-2">
                <div class="rating-stars" data-product-id="{{ $chiTietSanPham->id }}">
                    @for($i = 1; $i <= 5; $i++) <i class="bi bi-star star" data-index="{{ $i }}"></i>
                        @endfor
                </div>
                <span class="sao-da-chon text-dark">(0/5)</span>
            </div>


            <p class="mt-4">Mô tả sản phẩm:</p>
            <p class="text-muted">
                {{ $chiTietSanPham->mo_ta ?? 'Chưa có mô tả.' }}
            </p>

            <a href="#" class="btn btn-success mt-3">
                <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
            </a>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    <hr class="my-5">
    <h4 class="mb-4">Sản phẩm liên quan</h4>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse($sanPhamLienQuan as $sp)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/' . $sp->image) }}" class="card-img-top" alt="{{ $sp->name }}"
                    style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title">{{ $sp->name }}</h6>
                    <p class="card-text text-danger">{{ number_format($sp->price, 0, ',', '.') }}₫</p>
                    <a href="{{ route('chitietsanpham.show', $sp->id) }}" class="btn btn-sm btn-outline-primary">Xem</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <p class="text-muted">Không có sản phẩm liên quan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ratingContainers = document.querySelectorAll('.rating-stars');

    ratingContainers.forEach(container => {
        const stars = container.querySelectorAll('.star');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));

                stars.forEach((s, i) => {
                    if (i < index) {
                        s.classList.add('active');
                    } else {
                        s.classList.remove('active');
                    }
                });

                // Hiển thị số sao đã chọn
                const textDisplay = container.parentElement.querySelector('.sao-da-chon');
                if (textDisplay) {
                    textDisplay.textContent = `(${index}/5)`;
                }
            });
        });
    });
});
</script>
