<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #ffffff, #3daafe);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background-color: #d6e0eb;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .login-container h2 {
      color: #2e2e2e;
      margin-bottom: 20px;
      font-size: 36px;
      font-weight: bold;
    }

    .login-container input {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 10px;
      font-size: 16px;
    }

    .login-container button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      background-color: #3e8afd;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .login-container button:hover {
      background-color: #002a7d;
    }

    .login-container p {
      margin-top: 15px;
      color: #666;
      font-size: 14px;
    }

    .message {
      margin-bottom: 10px;
      font-size: 14px;
    }

    .message.success { color: green; }
    .message.error { color: red; }

    @media (max-width: 500px) {
      .login-container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h2>Đăng nhập</h2>

    {{-- Hiển thị thông báo --}}
    @if (session('error'))
      <div class="message error">{{ session('error') }}</div>
    @endif

    @if (session('success'))
      <div class="message success">{{ session('success') }}</div>
    @endif

    {{-- Form đăng nhập --}}
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
      <input type="password" name="password" placeholder="Mật khẩu" required>

      <button type="submit">Đăng nhập</button>
    </form>

    <p>Chưa có tài khoản? 
      <a href="{{ route('register') }}" style="color:rgb(50, 113, 209); text-decoration: none;">Đăng ký</a>
    </p>
  </div>

</body>
</html>