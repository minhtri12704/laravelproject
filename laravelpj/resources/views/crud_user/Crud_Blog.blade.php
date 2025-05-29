@extends('dashboard')

@section('content')
<div class="container">
    <h2>Danh sách bài viết</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <a href="{{ route('baiviet.create') }}" class="btn btn-primary mb-3">➕ Thêm bài viết</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Hình ảnh</th>
                <th>Ngày đăng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($baiviets as $bv)
            <tr>
                <td>{{ $bv->tieude }}</td>
                <td>{{ \Illuminate\Support\Str::limit(strip_tags($bv->noidung), 100) }}</td>
                <td>
                    @if($bv->hinhanh)
                    <img src="{{ asset($bv->hinhanh) }}" alt="{{ $bv->tieude }}" width="60">

                    @else
                    Không có ảnh
                    @endif
                </td>
                <td>{{ $bv->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('baiviet.edit', $bv->id) }}" class="btn btn-warning btn-sm">✏️ Sửa</a>
                    <form action="{{ route('baiviet.destroy', $bv->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">🗑️
                            Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center">
        {{ $baiviets->links() }}
    </div>
</div>
@endsection