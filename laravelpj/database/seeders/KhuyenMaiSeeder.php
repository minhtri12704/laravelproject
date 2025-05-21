<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhuyenMai;
use Illuminate\Support\Str;

class KhuyenMaiSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $isPercent = rand(0, 1); // 0 = fixed, 1 = percent

            $loaiGiam = $isPercent ? 'percent' : 'fixed';
            $giaTri = $isPercent ? rand(10, 50) : rand(10000, 100000); // 10-50% hoặc 10k - 100k

            KhuyenMai::create([
                'ma_phieu' => 'KM' . Str::upper(Str::random(5)),
                'ten_phieu' => 'Giảm giá ' . $giaTri . ($isPercent ? '%' : 'đ'),
                'loai_giam' => $loaiGiam,
                'gia_tri' => $giaTri,
                'ngay_bat_dau' => now()->subDays(rand(1, 10)),
                'ngay_ket_thuc' => now()->addDays(rand(10, 30)),
            ]);
        }
    }
}
