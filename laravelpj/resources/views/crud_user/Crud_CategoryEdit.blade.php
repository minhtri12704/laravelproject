@extends('dashboard')

@section('content')
<style>
  body {
    background-color: #1c1c1e;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #f5e6f7;
  }
  .container {
    background-color: #2c2c2e;
    border-radius: 15px;
    padding: 30px;
    max-width: 600px;
    margin: 40px auto;
    box-shadow: 0 0 20px rgba(255, 192, 203, 0.15);
  }
  .title {
    text-align: center;
    margin-bottom: 25px;
    color: #ffb6c1;
  }
  .form-group label {
    color: #f8e8f9;
  }
  .form-control {
    background-color: #3a3a3c;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px;
  }
  .form-control:focus {
    background-color: #4a4458;
    outline: none;
    box-shadow: 0 0 5px #ffb6c1;
  }
  .btn-submit {
    background-color: #ffb6c1;
    color: #1c1c1e;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    margin-top: 20px;
    transition: background-color 0.2s ease;
  }
  .btn-submit:hover {
    background-color: #ffa0bd;
  }
</style>

<div class="container">
  <h2 class="title">Chỉnh sửa Danh Mục</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('categories.update', $categories->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
      <label for="name">Tên danh mục:</label>
      <input type="text" id="name" name="name" class="form-control" value="{{ $categories->name }}" maxlength="75" required>
    </div>
    <button type="submit" class="btn-submit">Cập nhật</button>
  </form>
</div>
@endsection