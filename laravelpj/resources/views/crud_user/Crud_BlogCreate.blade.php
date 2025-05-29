@extends('dashboard')
@section('content')

<style>
.form-container {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #1a1a1a;
    border-radius: 8px;
}

h2 {
    color: #ffccdd;
    text-align: center;
    margin-bottom: 20px;
}

label {
    color: #ffccdd;
    margin-bottom: 5px;
    display: block;
}

.form-control {
    background-color: #2c2c2c;
    color: #ffccdd;
    border: 1px solid #d3d3d3;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 15px;
}

.form-control:focus {
    background-color: #3a3a3a;
    color: #ffccdd;
    border-color: #ff69b4;
    box-shadow: none;
}

.btn-dark {
    background-color: #ff69b4;
    color: #ffffff;
    border: none;
    padding: 12px 24px;
    font-size: 1.1rem;
    border-radius: 4px;
    width: 100%;
    cursor: pointer;
}

.btn-dark:hover {
    background-color: #ff85c0;
}

.btn-reset {
    background-color: #ffd700;
    color: #000000;
    border: none;
    padding: 12px 24px;
    font-size: 1.1rem;
    border-radius: 4px;
    width: 100%;
    margin-top: 10px;
    text-align: center;
    display: block;
}

.image-preview {
    margin-bottom: 15px;
    text-align: center;
}

.image-preview img {
    max-width: 100%;
    height: auto;
    border-radius: 6px;
    border: 1px solid #d3d3d3;
}

.image-upload {
    border: 2px dashed #ff69b4;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    color: #ffccdd;
    transition: background-color 0.3s ease;
    margin-bottom: 15px;
}

.image-upload:hover {
    background-color: #2c2c2c;
}

.image-upload i {
    font-size: 2.2rem;
    color: #ff85c0;
    display: block;
    margin-bottom: 10px;
}

.image-upload span {
    font-size: 0.95rem;
}

.alert-danger ul {
    margin-bottom: 0;
}
</style>

<div class="form-container">
    <h2>📝 Thêm bài viết mới</h2>

    {{-- Hiển thị lỗi --}}
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $loi)
            <li>{{ $loi }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('baiviet.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Tiêu đề</label>
            <input type="text" name="tieude" id="tieude" class="form-control" maxlength="35" required>
            @if ($errors->has('tieude'))
            <small class="text-danger">{{ $errors->first('tieude') }}</small>
            @endif
            <small id="tieude-count" style="color:#ccc">35 ký tự còn lại</small>
        </div>

        <div>
            <label>Nội dung</label>
            <textarea name="noidung" id="noidung" rows="5" class="form-control" maxlength="255" required></textarea>
            <small id="noidung-count" style="color:#ccc">255 ký tự còn lại</small>
        </div>

        <div>
            <label>Hình ảnh bài viết</label>
            <div class="image-preview" id="preview-area">
                <span style="color:#999;">Chưa chọn ảnh</span>
            </div>
            <label for="imageInput" class="image-upload">
                <i class="bi bi-cloud-upload"></i>
                <span>Nhấn để chọn ảnh từ máy</span>
            </label>
            <input type="file" name="hinhanh" id="imageInput" class="d-none" accept="image/*">
        </div>

        <button type="submit" class="btn btn-dark">💾 Lưu bài viết</button>
        <a href="{{ route('baiviet.index') }}" class="btn btn-reset">↩️ Quay lại</a>
    </form>
</div>

{{-- Scripts --}}
<script>
const input = document.getElementById('imageInput');
const preview = document.getElementById('preview-area');
input.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '<span style="color:#999;">Chưa chọn ảnh</span>';
    }
});

const tieudeInput = document.getElementById('tieude');
const noidungInput = document.getElementById('noidung');
const tieudeCount = document.getElementById('tieude-count');
const noidungCount = document.getElementById('noidung-count');

tieudeInput.addEventListener('input', () => {
    tieudeCount.textContent = `${35 - tieudeInput.value.length} ký tự còn lại`;
});

noidungInput.addEventListener('input', () => {
    noidungCount.textContent = `${255 - noidungInput.value.length} ký tự còn lại`;
});
</script>
@endsection