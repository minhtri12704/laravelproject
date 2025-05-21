<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;

class KhachHangSeeder extends Seeder
{
    public function run(): void
    {
        KhachHang::create([
            'Ten' => 'Admin',
            'SoDienThoai' => '0123456789',
            'Email' => 'admin@gmail.com',
            'DiaChi' => 'TP.HCM',
            'MatKhau' => Hash::make('123456') 
        ]);

        for ($i = 1; $i <= 20; $i++) {
            KhachHang::create([
                'Ten' => "Khách $i",
                'SoDienThoai' => '09' . rand(10000000, 99999999),
                'Email' => "khach$i@gmail.com",
                'DiaChi' => 'Số ' . rand(1, 100) . ' Đường ABC, TP.HCM',
                'MatKhau' => Hash::make('matkhau123')
            ]);
        }
    }
}
