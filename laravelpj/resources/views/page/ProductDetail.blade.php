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
</style>

<!-- Nút quay lại -->
<a href="{{ route('sanpham.index') }}"
    class="come"
    style="font-size: 1.8rem;"
    title="Quay lại">
    <i class="bi bi-arrow-left-circle-fill"></i>
</a>

<div class="container mt-5">
    @if(session('success'))
    <div id="success-alert" class="position-fixed top-50 start-50 translate-middle text-center p-4 rounded" style="z-index: 9999; background-color: #28a745; color: white; font-size: 18px;">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            const alertBox = document.getElementById('success-alert');
            if (alertBox) {
                alertBox.style.display = 'none';
            }
        }, 3000);
    </script>
    @endif

    <div class="row">
        <!-- Hình ảnh -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/' . $chiTietSanPham->image) }}"
                class="img-fluid rounded"
                alt="{{ $chiTietSanPham->name }}"
                style="max-height: 400px;">
        </div>

        <!-- Thông tin -->
        <div class="col-md-6">
            <h2>{{ $chiTietSanPham->name }}</h2>
            <h4 class="text-danger">{{ number_format($chiTietSanPham->price, 0, ',', '.') }} đ</h4>

            <p><strong>Số sao đánh giá:</strong>
                @for($i = 1; $i <= 5; $i++)
                    @if($i <=$chiTietSanPham->so_sao)
                    <i class="bi bi-star-fill text-warning"></i>
                    @else
                    <i class="bi bi-star text-muted"></i>
                    @endif
                    @endfor
            </p>

            <p class="mt-4">Mô tả sản phẩm:</p>
            <p class="text-muted">
                {{ $chiTietSanPham->mo_ta ?? 'Chưa có mô tả.' }}
            </p>

            <a href="{{ route('cart.add', $chiTietSanPham->id) }}" class="btn btn-success mt-2">
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
                <img src="{{ asset('images/' . $sp->image) }}" class="card-img-top" alt="{{ $sp->name }}" style="height: 180px; object-fit: cover;">
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