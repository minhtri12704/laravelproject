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
            KhuyenMai::create([
                'ma_phieu' => 'KM' . Str::upper(Str::random(5)),
                'ten_phieu' => 'Giảm giá ' . rand(10, 50) . '%',
                'phan_tram_giam' => rand(10, 50),
                'ngay_bat_dau' => now()->subDays(rand(1, 10)),
                'ngay_ket_thuc' => now()->addDays(rand(10, 30)),
            ]);
        }
    }
}