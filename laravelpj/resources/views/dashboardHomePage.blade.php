<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #007bff;
            color: #f5f5f5;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #ffffff;
        }

        .navbar .nav-link:hover {
            color: #cce6ff;
        }

        .content {
            padding: 20px;
        }

        .search-form .form-control {
            background-color: #fff;
            color: #000;
        }

        #chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 999;
            cursor: pointer;
        }

        #chat-popup {
            display: none;
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            overflow: hidden;
        }

        #chat-messages {
            max-height: 300px;
            overflow-y: auto;
            padding: 15px;
        }

        #chat-input {
            display: flex;
            border-top: 1px solid #ccc;
        }

        #chat-input input {
            flex: 1;
            border: none;
            padding: 10px;
        }

        #chat-input button {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 10px 15px;
        }
    </style>
</head>

<body>
    {{-- chạy danh mục, hiển thị toàn bộ danh mục có trong quản lí danh mục --}}
    @php
    use App\Models\Category;
    $categories = Category::all();
    @endphp
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold">Điện máy Xanh</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    {{-- khi ấn vào danh mục sẽ hiển thị các sản phẩm theo danh mục đó --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Danh mục
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- vòng lặp foreach để chạy vòng lặp trên @php...@endphp --}}
                            @foreach($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('products.byCategory', $category->id) }}">
                                    {{-- hiển thị tên danh mục --}}
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('baiviet.index') }}">Blog tin tức</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Về chúng tôi</a>
                    </li>
                </ul>
                <!-- ni hao -->
                @if(session()->has('khach_hang'))
                <div class="me-3 d-flex align-items-center text-white fw-bold">
                    👋 Xin chào [ {{ session('khach_hang')->Ten }} ]
                </div>
                @endif

                <form class="d-flex search-form" role="search" action="#" method="GET">
                    <input class="form-control me-2" type="search" name="query" placeholder="Tìm kiếm..."
                        aria-label="Search">
                    <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
                </form>
                <a href="{{ route('login') }}" class="btn btn-outline-light ms-3">Đăng Xuất</a>
                <a href="{{ route('cart.view') }}" class="btn btn-outline-light ms-2">
                    <i class="bi bi-cart"></i>
                </a>

            </div>
        </div>
    </nav>


    <div class="content">
        @yield('content')
    </div>
    <!-- Icon mở chatbot -->
    <button id="chat-icon"><i class="bi bi-chat-dots"></i></button>

    <!-- Popup chatbot -->
    <div id="chat-popup">
        <div class="bg-primary text-white p-2">🤖 Chatbot Điện máy</div>
        <div id="chat-messages"></div>
        <div id="chat-input">
            <input type="text" id="user-message" placeholder="Nhập nội dung..." />
            <button id="send-btn">Gửi</button>
        </div>
    </div>





    <footer class="text-white py-4" style="background-color: #007bff;">
        <div class="container">
            <div class="row text-center text-md-start">
                <div class="col-md-4 mb-3">
                    <h5>Liên hệ</h5>
                    <p>Email: dienmayxanh@dienmayxanh.vn</p>
                    <p>Điện thoại: 0123 456 789</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Nhóm thực hiện</h5>
                    <p>Nhóm I</p>
                    <p class="mb-0">Đồ án: Website quản lý Điện máy Xanh</p>
                </div>
                <div class="col-md-4 mb-3 text-md-end">
                    <h5>Thương hiệu hợp tác</h5>
                    <div class="d-flex flex-wrap justify-content-md-end justify-content-center gap-2">
                        <img src="{{ asset('images/DienMayXanh.jpg') }}" alt="Điện máy Xanh"
                            style="height: 40px;width:100px;">
                        <img src="{{ asset('images/TheGioiDiDong.jpg') }}" alt="Thế Giới Di Động"
                            style="height: 40px;width:100px;">
                        <img src="{{ asset('images/Panasonic.jpg') }}" alt="Panasonic"
                            style="height: 40px;width:100px;">
                        <img src="{{ asset('images/LG.jpg') }}" alt="LG" style="height: 40px;width:100px;">
                        <img src="{{ asset('images/SamSung.jpg') }}" alt="Samsung" style="height: 40px;width:100px;">


                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        const chatIcon = document.getElementById('chat-icon');
        const chatPopup = document.getElementById('chat-popup');
        const sendBtn = document.getElementById('send-btn');
        const userInput = document.getElementById('user-message');
        const chatMessages = document.getElementById('chat-messages');

        // Toggle mở/tắt chatbot
        chatIcon.onclick = () => {
            chatPopup.style.display = chatPopup.style.display === 'none' ? 'block' : 'none';
        };

        // Gửi tin nhắn
        sendBtn.onclick = () => {
            const msg = userInput.value.trim();
            if (!msg) return;
            chatMessages.innerHTML += `<div><strong>Bạn:</strong> ${msg}</div>`;
            userInput.value = '';

            fetch("{{ route('simplebot.ask') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: msg
                    })
                })
                .then(res => res.json())
                .then(data => {
                    chatMessages.innerHTML += `<div><strong>Bot:</strong> ${data.reply}</div>`;
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                });
        };
    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>