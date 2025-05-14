@extends('dashboardHomePage')

@section('content')
  <title>Blog Tin Tức</title>
  <style>
    body {
      background-color: #1c1c1e;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    .blog-header {
      background-color: #2c2c2e;
      color: #fff;
      text-align: center;
      padding: 40px 20px;
      width: 100%;
    }

    .blog-header h1 {
      margin: 0;
      font-size: 2.5rem;
    }

    .blog-header p {
      font-size: 1.1rem;
      margin-top: 10px;
      color: #ccc;
    }

    .blog-list {
      width: 100%;
      padding: 30px 5%;
      box-sizing: border-box;
    }

    .blog-post {
      display: flex;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      margin-bottom: 25px;
      overflow: hidden;
      transition: transform 0.2s ease;
    }

    .blog-post:hover {
      transform: translateY(-2px);
    }

    .post-img {
      flex: 0 0 180px;
    }

    .post-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .post-content {
      padding: 20px;
      flex: 1;
    }

    .post-content h2 {
      font-size: 1.4rem;
      color: #111;
      margin-bottom: 10px;
    }

    .post-content p {
      font-size: 1rem;
      color: #444;
    }

    .post-content a {
      display: inline-block;
      margin-top: 10px;
      color: #007bff;
      font-weight: bold;
      text-decoration: none;
    }

    .post-content a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .blog-post {
        flex-direction: column;
      }

      .post-img {
        width: 100%;
        height: 200px;
      }
    }
    .content{
      margin: -20px;
    }
  </style>

  <div class="blog-header">
    <h1>Blog Tin Tức</h1>
    <p>Cập nhật những sản phẩm mới nhất mỗi ngày!</p>
  </div>

  <div class="blog-list">
    @foreach($baiviet as $bv)
      <div class="blog-post">
        <div class="post-img">
          <img src="{{ $bv->hinhanh ?? 'https://via.placeholder.com/400x400' }}" alt="Ảnh tin tức">
        </div>
        <div class="post-content">
          <h2>{{ $bv->tieude }}</h2>
          <p>{{ \Illuminate\Support\Str::limit($bv->noidung, 150) }}</p>
          <a href="{{ route('baiviet.show', $bv->id) }}">Đọc thêm →</a>
        </div>
      </div>
    @endforeach
  </div>
@endsection
