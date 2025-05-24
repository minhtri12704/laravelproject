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

.bi-star-fill {
    color: #ff9900;
}
.bi-star {
    color: #cccccc;
}

</style>

<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: black; text-shadow: 1px 1px 3px #000;">Danh sách Sản phẩm</h2>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse($sanPhams as $sp)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset( 'images/' . $sp->image) }}" alt="{{ $sp->name }}" class="card-img-top img-fluid"
                    style="height: 250px; width:100%; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title text-danger" style="min-height: 48px;">{{ $sp->name }}</h5>
                    <div class="star-rating" data-id="{{ $sp->id }}">
                        @for($i = 1; $i <= 5; $i++) <i class="bi bi-star star" data-index="{{ $i }}"></i>
                            @endfor
                    </div>


                    <p class="card-text">
                        <strong class="text-dark">Giá:</strong>
                        <span class="text-danger">{{ number_format($sp->price, 0, ',', '.') }}₫</span><br>
                        <strong class="text-dark">Ngày tạo:</strong> {{ $sp->created_at->format('d/m/Y') }}
                    </p>

                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-dark btn-sm">Mua ngay</a>
                        <a href="{{ route('chitietsanpham.show', $sp->id) }}" class="btn btn-outline-dark btn-sm">Xem
                            chi tiết</a>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ratings = document.querySelectorAll('.star-rating');

    ratings.forEach(rating => {
        const stars = rating.querySelectorAll('.star');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const index = parseInt(this.getAttribute('data-index'));

                stars.forEach((s, i) => {
                    if (i < index) {
                        s.classList.remove('bi-star');
                        s.classList.add('bi-star-fill');
                        s.style.color = '#ff9900';
                    } else {
                        s.classList.remove('bi-star-fill');
                        s.classList.add('bi-star');
                        s.style.color = '#cccccc';
                    }
                });
            });
        });
    });
});
</script>