<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $danhMuc = ['Máy giặt', 'Máy lạnh', 'Tủ lạnh','Điều Hòa'];

        foreach ($danhMuc as $ten) {
            Category::create([
                'name' => $ten,
            ]);
        }
    }
}
