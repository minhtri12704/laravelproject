@extends('dashboard')

@section('content')
<div class="container">
    <h2>Chỉnh sửa bài viết</h2>

    <form action="{{ route('baiviet.update', $baiviet->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="tieude" class="form-control" value="{{ $baiviet->tieude }}" required>
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="noidung" rows="5" class="form-control" required>{{ $baiviet->noidung }}</textarea>
        </div>

        <div class="mb-3">
            <label>Hình ảnh hiện tại:</label><br>
            @if($baiviet->hinhanh)
                <img src="{{ asset('storage/' . $baiviet->hinhanh) }}" width="150">
            @else
                Không có hình
            @endif
        </div>

        <div class="mb-3">
            <label>Thay hình mới (nếu cần)</label>
            <input type="file" name="hinhanh" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">✅ Cập nhật</button>
        <a href="{{ route('baiviet.index') }}" class="btn btn-secondary">↩️ Quay lại</a>
    </form>
</div>
@endsection
