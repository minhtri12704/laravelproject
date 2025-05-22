<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\KhachHang;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $paymentMethods = ['Tiền mặt', 'Chuyển khoản', 'Thẻ tín dụng'];
        $statuses = ['Chưa xử lý', 'Đã xử lý'];

        $khachHangs = KhachHang::pluck('idKhach')->toArray(); // Lấy danh sách ID khách hàng

        if (empty($khachHangs)) {
            return; // Không có khách hàng nào để gán
        }

        for ($i = 1; $i <= 20; $i++) {
            Order::create([
                'ten_don_hang' => 'Đơn hàng #' . $i,
                'khach_hang_id' => $khachHangs[array_rand($khachHangs)],
                'tong_tien' => rand(200000, 2000000),
                'phuong_thuc_thanh_toan' => $paymentMethods[array_rand($paymentMethods)],
                'trang_thai' => $statuses[array_rand($statuses)],
                'ghi_chu' => rand(0, 1) ? 'Giao hàng giờ hành chính' : 'Liên hệ trước khi giao',
            ]);
        }
    }
}
