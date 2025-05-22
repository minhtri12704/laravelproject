<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = ['Tiền mặt', 'Chuyển khoản', 'Thẻ tín dụng'];
        $statuses = ['Chưa xử lý', 'Đã xử lý'];
        $sampleImages = [
            'maylanh1.jpg',
            'maylanh4.jpg',
            'maylanh3.jpg',
        ];

        for ($i = 1; $i <= 20; $i++) {
            Order::create([
                'ten_don_hang' => 'Đơn hàng #' . $i,
                'ten_khach_hang' => 'Nguyễn Văn ' . chr(64 + $i), // A, B, C...
                'tong_tien' => rand(200000, 2000000),
                'phuong_thuc_thanh_toan' => $paymentMethods[array_rand($paymentMethods)],
                'trang_thai' => $statuses[array_rand($statuses)],
                'ghi_chu' => rand(0, 1) ? 'Giao hàng giờ hành chính' : 'Liên hệ trước khi giao',
                'hinh_anh' => $sampleImages[array_rand($sampleImages)],
            ]);
        }
    }
}