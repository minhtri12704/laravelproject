<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #007bff;
            color: #f5f5f5;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
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

        .search-form .form-control {
            background-color: #fff;
            color: #000;
        }


        #chat-toggle-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #0d6efd;
            color: white;
            border-radius: 50%;
            padding: 15px 18px;
            border: none;
            font-size: 20px;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #chat-box {
            display: none;
            position: fixed;
            bottom: 90px;
            right: 30px;
            width: 300px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25);
            padding: 10px;
            z-index: 1000;
            font-size: 14px;
        }

        .chat-messages {
            max-height: 260px;
            overflow-y: auto;
            padding: 5px;
        }

        .chat-bubble {
            padding: 8px 12px;
            margin: 5px;
            border-radius: 15px;
            max-width: 80%;
            word-wrap: break-word;
            display: inline-block;
        }

        .admin-message {
            background-color: #e6e6e6;
            color: #333;
            border-radius: 15px 15px 15px 0;
        }

        .user-message {
            background-color: #0d6efd;
            color: white;
            border-radius: 15px 15px 0 15px;
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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

                <form class="d-flex search-form" role="search" action="{{ route('search') }}" method="GET">
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
    <!-- Nút mở chat -->
    <button id="chat-toggle-btn"><i class="fa fa-comments"></i></button>

    <!-- Chat box -->
    <div id="chat-box">
        <div id="chat-history" class="chat-messages">
            <p class="text-muted">💬 Đang tải hội thoại...</p>
        </div>
        <form id="chatForm" method="POST" action="{{ route('guest.chat.send') }}" class="d-flex align-items-center mt-2">
            @csrf
            <input type="hidden" name="customer_id" id="customer_id_hidden" value="{{ session('khach_hang')->idKhach ?? '' }}">
            <input type="text" name="message" id="chatMessage" class="form-control form-control-sm me-2 rounded-pill" placeholder="Aa..." required>
            <button type="submit" class="btn btn-sm btn-primary rounded-circle"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>



    <script>
        const toggleBtn = document.getElementById('chat-toggle-btn');
        const chatBox = document.getElementById('chat-box');
        const customerId = document.getElementById('customer_id_hidden').value;

        toggleBtn.addEventListener('click', () => {
            chatBox.style.display = (chatBox.style.display === 'none' || chatBox.style.display === '') ? 'block' : 'none';
            if (chatBox.style.display === 'block') {
                loadMessages(customerId);
            }
        });

        function loadMessages(customerId) {
            fetch(`/api/chat/messages?customer_id=${customerId}`)
                .then(res => res.json())
                .then(data => {
                    const history = document.getElementById('chat-history');
                    history.innerHTML = '';

                    if (data.length === 0) {
                        history.innerHTML = '<p class="text-muted">Chưa có hội thoại nào.</p>';
                        return;
                    }

                    data.forEach(msg => {
                        const isAdmin = msg.user_id !== null;

                        const bubble = document.createElement('div');
                        bubble.className = 'chat-bubble ' + (isAdmin ? 'admin-message' : 'user-message');
                        bubble.innerHTML = msg.message;

                        const wrapper = document.createElement('div');
                        wrapper.className = 'd-flex mb-1';
                        wrapper.style.justifyContent = isAdmin ? 'flex-start' : 'flex-end';


                        wrapper.appendChild(bubble);

                        history.appendChild(wrapper);
                    });

                    history.scrollTop = history.scrollHeight;
                });
        }


        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(() => {
                    document.getElementById('chatMessage').value = '';
                    loadMessages(customerId);
                });
        });
    </script>






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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>