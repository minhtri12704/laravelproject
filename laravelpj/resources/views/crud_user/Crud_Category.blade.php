@extends('dashboard')

@section('content')
<style>
  .tab{
    margin-top: 10%;
    margin-left: 20%;
    margin-right: 10%;
    padding: auto;
  }
</style>
<div class="tab">

<h2 style="text-align: center; color: #ffb6c1;">Quản lý Danh mục</h2>

<!-- Nút chuyển sang trang thêm danh mục -->
<div style="text-align: right; margin-bottom: 20px;">
  <a href="{{ route('categories.create') }}" 
     style="background-color: #ff69b4; color: white; padding: 10px 15px; border-radius: 8px; text-decoration: none;">
    + Thêm danh mục
  </a>
</div>


<!-- Bảng hiển thị danh mục -->
<table style="width: 100%; border-collapse: collapse; background-color: #3a3a3a;">
  <thead>
    <tr>
      <th style="background-color: #ffb6c1; color: #1e1e1e; padding: 12px;">Mã</th>
      <th style="background-color: #ffb6c1; color: #1e1e1e; padding: 12px;">Tên danh mục</th>
      <th style="background-color: #ffb6c1; color: #1e1e1e; padding: 12px;">Chức năng</th>
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $category)
      <tr>
        <td style="padding: 12px; color: #ffb6c1;">{{ $category->id }}</td>
        <td style="padding: 12px; color: #ffb6c1;">{{ $category->name }}</td>
        <td style="padding: 12px;">
<!--Sửa danh mục-->
          <form action="{{ route('categories.editCategory', $category->id) }}" method="GET" style="display:inline-block;">
            <button class="edit" style="background-color: #ffa6c9; padding: 6px 12px; border: none; border-radius: 8px;">Sửa</button>
          </form>

<!--Xóa-->
          <form action="{{ route('categories.deleteCategory', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
            @csrf
            @method('DELETE')
            <button class="delete" style="background-color: #ff4d6d; padding: 6px 12px; border: none; border-radius: 8px;">Xoá</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
</div>