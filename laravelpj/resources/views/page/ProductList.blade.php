@extends('dashboardHomePage')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background-color: rgb(255, 255, 255);
        color: rgb(0, 0, 0);
    }

    h2 {
        color: rgb(0, 0, 0);
    }

    .table {
        background-color: #1a1a1a;
        color: #ffffff;
    }

    .table-bordered th,
    .table-bordered td {
        background-color: #1a1a1a;
        border: 1px solid #d3d3d3;
        color: #ffccdd;
    }

    .table-dark {
        background-color: #3a3a3a;
        color: #ffccdd;
    }

    .btn-dark {
        background-color: #ff69b4;
        color: #ffffff;
        border: none;
    }

    .btn-dark:hover {
        background-color: #ff85c0;
    }

    .action-icon {
        color: #ffccdd;
        font-size: 1.2rem;
        margin-right: 10px;
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
{{-- Bộ lọc sản phẩm --}}
@php
    use App\Models\Category;
    $categories = Category::all();
    @endphp
<div class="container py-3">
    <form method="GET" action="{{ route('sanpham.index') }}" class="row g-3 align-items-end" style="background: #fff; padding: 20px; border-radius: 10px;">
        <div class="col-md-4">
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" id="category_id" class="form-select">
                <option value="">-- Tất cả danh mục --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label for="price_range" class="form-label">Khoảng giá</label>
            <select name="price_range" id="price_range" class="form-select">
                <option value="">-- Tất cả mức giá --</option>
                <option value="1" {{ request('price_range') == 1 ? 'selected' : '' }}>Dưới 500.000đ</option>
                <option value="2" {{ request('price_range') == 2 ? 'selected' : '' }}>500.000đ - 1.000.000đ</option>
                <option value="3" {{ request('price_range') == 3 ? 'selected' : '' }}>Trên 1.000.000đ</option>
            </select>
        </div>

        <div class="col-md-4 text-end">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-funnel-fill"></i> Lọc sản phẩm</button>
        </div>
    </form>
</div>
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: black; text-shadow: 1px 1px 3px #000;">Danh sách Sản phẩm</h2>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse($sanPhams as $sp)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset( 'images/' . $sp->image) }}"
                    alt="{{ $sp->name }}"
                    class="card-img-top img-fluid"
                    style="height: 250px; width:100%; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title text-danger" style="min-height: 48px;">{{ $sp->name }}</h5>
                    <div class="mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <=$sp->so_sao)
                            <i class="bi bi-star-fill text-warning"></i>
                            @else
                            <i class="bi bi-star text-muted"></i>
                            @endif
                            @endfor
                    </div>

                    <p class="card-text">
                        <strong class="text-dark">Giá:</strong>
                        <span class="text-danger">{{ number_format($sp->price, 0, ',', '.') }}₫</span><br>
                        <strong class="text-dark">Ngày tạo:</strong> {{ $sp->created_at->format('d/m/Y') }}
                    </p>

                    <div class="d-grid gap-2">
                        <form method="POST" action="{{ route('cart.addById') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $sp->id }}">
                            <button type="submit" class="btn btn-dark btn-sm w-100">Mua ngay</button>
                        </form>
                        <a href="{{ route('chitietsanpham.show', $sp->id) }}" class="btn btn-outline-dark btn-sm w-100">Xem chi tiết</a>
                    </div>


                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted">Không có sản phẩm nào.</div>
        @endforelse
    </div>

    <!-- Phân trang -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $sanPhams->links() }}
    </div>
</div>
@endsection