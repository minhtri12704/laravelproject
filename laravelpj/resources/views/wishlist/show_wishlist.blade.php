@extends('dashboardHomePage')

@section('title', 'Danh sách yêu thích')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('content')
<style>
body {
    background-color: #fff;
    color: #222;
    font-family: 'Segoe UI', sans-serif;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
}

.container {
    flex: 1;
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
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    border: 1px solid #eee;
    position: relative;
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
    margin: 8px 0;
}

.product-price {
    color: rgb(85, 34, 34);
    font-size: 16px;
}

.btn-cart {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 10px;
}

.btn-cart:hover {
    background-color: #c82333;
}

footer {
    margin-top: auto;
}
</style>

<div class="container">
    <h2 class="section-title">Sản phẩm yêu thích</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="product-grid">
        @forelse($products as $product)
        <div class="product-card">
            <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->name }}">
            <div class="product-name">{{ $product->name }}</div>
            <div class="product-price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div>

            <!-- <p style="margin-top: 5px;">
                Đã yêu thích <strong>{{ $wishlist[$product->id] ?? 0 }}</strong> lần
            </p>

            <form action="{{ route('wishlist.decrease', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-warning btn-sm">Giảm 1</button>
            </form> -->

            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Xóa hết</button>
            </form> <br> <br>

            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success">Thêm vào giỏ</a>
        </div>

        @empty
        <p style="grid-column: 1 / -1; text-align: center;">Bạn chưa yêu thích sản phẩm nào.</p>
        @endforelse
    </div>

    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ route('home') }}" class="btn btn-primary">Trở về trang chủ</a>
    </div>
</div>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
    const removeButtons = document.querySelectorAll('.btn-confirm-remove');

    removeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            Swal.fire({
                title: 'Bạn chắc chắn?',
                text: 'Sản phẩm sẽ bị xóa khỏi danh sách yêu thích!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Xóa ngay',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
});
</script>