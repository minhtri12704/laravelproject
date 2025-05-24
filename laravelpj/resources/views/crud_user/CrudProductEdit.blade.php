@extends('dashboard')
@section('content')

<style>
    .form-container {
        max-width: 400px;
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
        font-size: 1.2rem;
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
        font-size: 1.2rem;
        border-radius: 4px;
        width: 100%;
        margin-top: 10px;
    }

    .btn-reset:hover {
        background-color: #ffec3d;
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
    <h2>Chỉnh sửa sản phẩm</h2>

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

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>Tên sản phẩm</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" maxlength="75" required>
        <small id="name-count" style="color:#ccc">{{ 75 - strlen($product->name) }} ký tự còn lại</small>
    </div>

    <div>
        <label>Danh mục</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Mô tả</label>
        <textarea name="descript" id="descript" class="form-control" maxlength="100">{{ $product->descript }}</textarea>
        <small id="descript-count" style="color:#ccc">{{ 100 - strlen($product->descript) }} ký tự còn lại</small>
    </div>

    <div>
        <label>Số lượng</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}">
    </div>

    <div>
        <label>Giá</label>
        <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    <div>
        <label>Hình ảnh hiện tại</label>
        <div class="image-preview">
            @if($product->image)
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
            @else
                <span style="color: #999;">Không có hình ảnh</span>
            @endif
        </div>
    </div>

    <div>
        <label>Hình ảnh mới</label>
        <div class="image-preview" id="preview-area">
            <span style="color:#999;">Chưa chọn ảnh</span>
        </div>
        <label for="imageInput" class="image-upload">
            <i class="bi bi-cloud-upload"></i>
            <span>Nhấn để chọn ảnh từ máy</span>
        </label>
        <input type="file" name="image" id="imageInput" class="d-none" accept="image/*">
    </div>

    <button type="submit" class="btn btn-dark">Cập nhật</button>
    <a href="{{ route('products.index') }}" class="btn btn-reset">Quay lại</a>
</form>

<!-- ... -->

<script>
    // JS cho xem trước ảnh
    const input = document.getElementById('imageInput');
    const preview = document.getElementById('preview-area');
    input.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '<span style="color:#999;">Chưa chọn ảnh</span>';
        }
    });

    // JS đếm ký tự còn lại
    const nameInput = document.getElementById('name');
    const descriptInput = document.getElementById('descript');
    const nameCount = document.getElementById('name-count');
    const descriptCount = document.getElementById('descript-count');

    nameInput.addEventListener('input', () => {
        nameCount.textContent = `${75 - nameInput.value.length} ký tự còn lại`;
    });

    descriptInput.addEventListener('input', () => {
        descriptCount.textContent = `${100 - descriptInput.value.length} ký tự còn lại`;
    });
</script>

@endsection