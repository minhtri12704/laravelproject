<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BaiViet;

class BaiVietSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tieude' => 'Top 5 máy lạnh tiết kiệm điện đáng mua nhất hè này',
                'noidung' => 'Bạn đang tìm máy lạnh tiết kiệm điện? Hãy tham khảo 5 mẫu máy lạnh inverter tốt nhất hiện nay đến từ các thương hiệu như Daikin, Panasonic, LG,... giúp làm mát nhanh mà vẫn tiết kiệm chi phí điện năng hàng tháng.',
                'hinhanh' => 'images/maylanh1.jpg',
            ],
            [
                'tieude' => 'So sánh máy giặt cửa trên và cửa trước: nên chọn loại nào?',
                'noidung' => 'Máy giặt cửa trên có giá thành rẻ và dễ sử dụng, trong khi máy giặt cửa trước tiết kiệm nước và giặt sạch hơn. Bài viết sẽ giúp bạn chọn được loại máy phù hợp với nhu cầu và ngân sách gia đình.',
                'hinhanh' => 'images/maylanh2.jpg',
            ],
            [
                'tieude' => 'Tủ lạnh Inverter là gì? Có thực sự tiết kiệm điện?',
                'noidung' => 'Tủ lạnh Inverter sử dụng công nghệ biến tần giúp duy trì nhiệt độ ổn định, giảm hao phí điện năng. Đây là lựa chọn lý tưởng cho gia đình có nhu cầu lưu trữ nhiều và sử dụng thường xuyên.',
                'hinhanh' => 'images/maylanh3.jpg',
            ],
            [
                'tieude' => 'Cách chọn máy lạnh phù hợp với diện tích phòng',
                'noidung' => 'Khi chọn máy lạnh, bạn cần quan tâm đến công suất (HP) phù hợp với diện tích phòng. Phòng nhỏ dưới 15m² nên chọn máy 1HP, phòng lớn hơn 25m² nên chọn máy 1.5HP trở lên để làm lạnh hiệu quả.',
                'hinhanh' => 'images/maylanh4.jpg',
            ],
            [
                'tieude' => 'Điều hòa hai chiều có đáng mua không?',
                'noidung' => 'Điều hòa hai chiều có chức năng làm mát lẫn sưởi ấm, đặc biệt phù hợp với khu vực miền Bắc có mùa đông lạnh. Dù giá cao hơn máy một chiều, nhưng lại rất tiện lợi và tiết kiệm không gian.',
                'hinhanh' => 'images/dieuhoa-daikin.jpg',
            ],
            [
                'tieude' => 'Kinh nghiệm chọn mua máy lọc không khí cho gia đình',
                'noidung' => 'Máy lọc không khí giúp loại bỏ bụi mịn, vi khuẩn và mùi hôi. Bạn nên chọn loại có màng lọc HEPA, tích hợp cảm biến bụi và có công suất phù hợp với diện tích phòng.',
                'hinhanh' => 'images/tivi-lg1.jpg',
            ],
            [
                'tieude' => 'Giải mã các công nghệ mới trên Smart Tivi 2024',
                'noidung' => 'Smart Tivi hiện nay được trang bị nhiều công nghệ hiện đại như 4K HDR, trợ lý ảo Google Assistant, điều khiển giọng nói, kết nối điện thoại... giúp bạn có trải nghiệm giải trí thông minh và tiện lợi hơn.',
                'hinhanh' => 'images/tivi-lg.jpg',
            ],
            [
                'tieude' => 'Có nên mua máy giặt có sấy 2 trong 1?',
                'noidung' => 'Máy giặt có sấy tích hợp giúp bạn tiết kiệm không gian và thời gian phơi đồ, đặc biệt phù hợp với căn hộ chung cư. Tuy nhiên, chi phí ban đầu cao và tiêu thụ điện nhiều hơn máy giặt thông thường.',
                'hinhanh' => 'images/maylanh4.jpg',
            ],
            [
                'tieude' => 'Hướng dẫn sử dụng máy lạnh đúng cách, tiết kiệm điện',
                'noidung' => 'Không nên để nhiệt độ dưới 24°C, hãy bật chế độ Eco hoặc hẹn giờ tắt máy lạnh khi ngủ. Việc bảo trì định kỳ cũng giúp máy lạnh hoạt động hiệu quả và ít hao điện.',
                'hinhanh' => 'images/maylanh1.jpg',
            ],
            [
                'tieude' => 'Cập nhật các mẫu tủ lạnh side-by-side bán chạy nhất',
                'noidung' => 'Tủ lạnh side-by-side có thiết kế sang trọng, dung tích lớn, phù hợp với gia đình đông người. Bài viết sẽ giới thiệu các mẫu đáng mua đến từ Samsung, LG và Hitachi đang được người dùng đánh giá cao.',
                'hinhanh' => 'images/maylanh3.jpg',
            ]
        ];

        foreach ($data as $item) {
            BaiViet::create([
                'tieude' => $item['tieude'],
                'noidung' => $item['noidung'],
                'hinhanh' => $item['hinhanh'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
