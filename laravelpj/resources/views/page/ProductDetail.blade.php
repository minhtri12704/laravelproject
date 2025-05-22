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
<a href="{{ route('sanpham.index') }}" class="come" style="font-size: 1.8rem;" title="Quay lại">
    <i class="bi bi-arrow-left-circle-fill"></i>
</a>

<div class="container mt-5">
    @if(session('success'))
    <div id="success-alert" class="position-fixed top-50 start-50 translate-middle text-center p-4 rounded"
        style="z-index: 9999; background-color: #28a745; color: white; font-size: 18px;">
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
            <img src="{{ asset('images/' . $chiTietSanPham->image) }}" class="img-fluid rounded"
                alt="{{ $chiTietSanPham->name }}" style="max-height: 400px;">
        </div>

        <!-- Thông tin -->
        <div class="col-md-6">
            <h2>{{ $chiTietSanPham->name }}</h2>
            <h4 class="text-danger">{{ number_format($chiTietSanPham->price, 0, ',', '.') }} đ</h4>

            <p><strong>Số sao đánh giá:</strong>
                @for($i = 1; $i <= 5; $i++) @if($i <=$chiTietSanPham->so_sao)
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

    <hr class="my-5">
    <h4>Đánh giá sản phẩm</h4>

    <!-- Form gửi đánh giá -->
    @if(session('khach_hang'))
    <form action="{{ route('review.store', $chiTietSanPham->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="rating">Số sao:</label>
            <select name="rating" class="form-select" style="width: 120px">
                @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}">{{ $i }} sao</option>
                @endfor
            </select>
        </div>
        <div class="mb-3">
            <label for="noi_dung">Bình luận:</label>
            <textarea name="noi_dung" rows="3" class="form-control @error('noi_dung') is-invalid @enderror"
                required>{{ old('noi_dung') }}</textarea>
            @error('noi_dung')
            <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-dark">Gửi đánh giá</button>
    </form>
    @else
    <p class="text-muted">Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để gửi đánh giá.</p>
    @endif

    <!-- Danh sách đánh giá -->
    @forelse ($chiTietSanPham->reviews as $review)
    <div class="mb-3 border p-3 rounded shadow-sm position-relative">

    <!-- Header: tên, thời gian, nút 3 chấm -->
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <strong>{{ $review->khachHang->Ten ?? 'Ẩn danh' }}</strong> - 
            <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
        </div>

        @if(session('khach_hang') && $review->khach_hang_id == session('khach_hang')->idKhach)
        <div class="dropdown">
            <button class="btn btn-sm btn-light border-0" type="button" id="dropdownMenuButton{{ $review->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $review->id }}">
                <li>
                    <form action="{{ route('review.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Xác nhận xóa đánh giá?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">Xóa</button>
                    </form>
                </li>
            </ul>
        </div>
        @endif
    </div>

    <!-- Rating + nội dung -->
    <div class="mt-2">
        @for ($i = 1; $i <= 5; $i++)
            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
        @endfor
        <p class="mt-2">{{ $review->noi_dung }}</p>
    </div>
</div>


    @empty
    <p>Chưa có đánh giá nào cho sản phẩm này.</p>
    @endforelse


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