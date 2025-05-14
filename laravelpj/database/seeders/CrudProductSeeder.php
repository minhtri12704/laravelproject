<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CrudProduct;
use App\Models\Category;

class CrudProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //chạy dữ liệu mẫu với số lượng là 10 sản phẩm
        $categories = Category::all();
        $imageList = ['mayquat.png', 'tivi.png', 'maylanh1.jpg', 'tu-lanh-panasonic.jpg'];
        foreach ($categories as $category) {
            for ($i = 1; $i <= 10; $i++) {
                CrudProduct::create([
                    'category_id' => $category->id,
                    'name' => "{$category->name} $i",
                    'descript' => "Mô tả sản phẩm {$category->name} $i",
                    'quantity' => rand(5, 20),
                    'price' => rand(300, 1000) * 1000,
                    'image' => $imageList[array_rand($imageList)],
                ]);
            }
        }
    }
}