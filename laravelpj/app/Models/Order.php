<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'ten_don_hang',
        'ten_khach_hang',
        'tong_tien',
        'phuong_thuc_thanh_toan',
        'trang_thai',
        'ghi_chu',
    ];
}