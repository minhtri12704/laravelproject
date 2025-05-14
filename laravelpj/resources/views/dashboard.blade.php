<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #1a1a1a;
            /* Đen */
            color: #333;
        }

        .sidebar {
            background-color: #2d2d2d;
            /* Đen pastel */
            min-height: 100vh;
            color: #f5f5f5;
            /* Trắng nhẹ cho chữ */
        }

        .sidebar h4 {
            font-size: 1.5rem;
            /* Tiêu đề to hơn */
            margin-bottom: 1.5rem;
            /* Giãn cách dưới */
        }

        .sidebar a {
            color: #f5f5f5;
            /* Trắng nhẹ cho liên kết */
            text-decoration: none;
            font-size: 1.2rem;
            /* Chữ to hơn */
            padding: 12px 0;
            /* Giãn cách trong */
            display: block;
            /* Đảm bảo liên kết chiếm toàn bộ chiều rộng */
            transition: color 0.3s ease;
            /* Hiệu ứng mượt khi hover */
        }

        .sidebar a:hover {
            color: #ff85c0;
            /* Hồng pastel đậm hơn khi hover */
        }

        .sidebar .nav-item {
            margin-bottom: 10px;
            /* Giãn cách giữa các mục */
        }

        .content {
            padding: 20px;
            background-color: #1a1a1a;
            /* Nền đen */
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div class="sidebar p-3" style="width: 250px;">
            <h4>Quản trị</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link">Người dùng</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Quản lý khách hàng</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Quản lý sản phẩm</a></li>
                <li class="nav-item"><a href="{{ route('orders.index') }}" class="nav-link">Quản lý đơn hàng</a></li>
                <li class="nav-item"><a href="" class="nav-link">Quản lý danh mục</a></li>
            </ul>
        </div>
        <div class="content flex-grow-1">
            @yield('content')
        </div>
    </div>
</body>