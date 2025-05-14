@extends('dashboardHomePage')

@section('content')
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9fb;
}
.container {
    margin: 40px auto;
}

.article-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.article-image {
    width: 100%;
    max-height: 450px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.article-content {
    font-size: 1.1rem;
    color: #444;
    line-height: 1.7;
    white-space: pre-line;
}

.back-link {
    display: inline-block;
    margin-bottom: 20px;
    color: #007bff;
    font-weight: 600;
    text-decoration: none;
}

.back-link:hover {
    text-decoration: underline;
}
</style>
<div class="container">
    <a href="{{ route('baiviet.index') }}" class="back-link">← Quay lại danh sách</a>

    <h1 class="article-title">{{ $bv->tieude }}</h1>

    <img class="article-image" src="{{ asset($bv->hinhanh ?? 'images/default.jpg') }}" alt="Ảnh bài viết">

    <div class="article-content">
        {!! nl2br(e($bv->noidung)) !!}
    </div>
</div>

@endsection
