@extends('dashboardHomePage')

@section('title', 'Tìm Kiếm Sản Phẩm')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background-color: #f1f5f9;
}

h3 {
    color: #1e3a8a;
    font-weight: bold;
}

.card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
}

.card-text {
    font-size: 16px;
    margin-bottom: 12px;
}

.card-img-top {
    height: 180px;
    width: 100%;
    object-fit: contain;
    background-color: #f8f9fa;
    padding: 8px;
    image-rendering: auto;
    transition: transform 0.3s ease;
}

.card-img-top:hover {
    transform: scale(1.05);
}

.btn-primary {
    background-color: #0d6efd;
    border: none;
    font-weight: 500;
}

.btn-primary:hover {
    background-color: #0a58ca;
}

.action-icon:hover {
    color: #ff85c0;
}

.pagination .page-link {
    background-color: rgb(255, 255, 255);
    color: rgb(0, 0, 0);
    border: 1px solid #d3d3d3;
}

.pagination .page-item.active .page-link {
    background-color: #ff69b4;
    color: #ffffff;
    border: 1px solid #d3d3d3;
}

.pagination .page-link:hover {
    background-color: #ff85c0;
    color: #ffffff;
}
</style>

<div class="container mt-4">
    <h3 class="mb-4">
        Kết quả tìm kiếm cho: <span class="text-warning">"{{ $query }}"</span>
    </h3>

    <div class="row">
        @forelse($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch">
            <div class="card w-100 shadow-sm">
                <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body bg-white text-center">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                    <a href="{{ route('chitietsanpham.show', $product->id) }}" class="btn btn-primary btn-sm w-100">Xem
                        chi tiết</a>

                </div>
            </div>
        </div>
        @empty
        <p class="text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $products->appends(['query' => $query])->links() }}
    </div>
</div>
@endsection