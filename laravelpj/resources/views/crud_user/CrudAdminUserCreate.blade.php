@extends('dashboard')

@section('content')
<style>
    .form-container {
        max-width: 400px;
        margin: 0 auto;
    }

    .form-control {
        background-color: #2c2c2c;
        color: #ffccdd;
        border: 1px solid #d3d3d3;
    }

    .form-control:focus {
        background-color: #3a3a3a;
        color: #ffccdd;
        border-color: #ff69b4;
        box-shadow: none;
    }

    label {
        color: #ffccdd;
    }

    h2 {
        color: #ffccdd;
    }

    .btn-dark {
        background-color: #ff69b4;
        color: #ffffff;
        border: none;
        padding: 12px 24px;
        font-size: 1.2rem;
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
    }

    .btn-reset:hover {
        background-color: #ffec3d;
    }
</style>

<div class="form-container">
    <h2>Thêm người dùng</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="form-group mb-3">
            <input type="text" placeholder="Name" id="name" class="form-control" name="name" required autofocus>
            @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <!-- Phone -->
        <div class="form-group mb-3">
            <input type="text" placeholder="Phone" id="phone" class="form-control" name="phone" required>
            @if ($errors->has('phone'))
            <span class="text-danger">{{ $errors->first('phone') }}</span>
            @endif
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" required>
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <!-- Address -->
        <div class="form-group mb-3">
            <input type="text" placeholder="Address" id="address" class="form-control" name="address" required>
            @if ($errors->has('address'))
            <span class="text-danger">{{ $errors->first('address') }}</span>
            @endif
        </div>
        

        <!-- Role -->
        <div class="form-group mb-3">
            <select class="form-control" name="role" required>
                <option value="">-- Chọn vai trò --</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>

        </div>


        <!-- Password -->
        <div class="form-group mb-3">
            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="d-grid mx-auto">
            <button type="submit" class="btn btn-dark btn-block">Submit</button>
        </div>
    </form>
</div>
@endsection