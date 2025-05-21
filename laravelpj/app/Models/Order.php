<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KhachHang;

class Order extends Model
{
    protected $fillable = [
        'ten_don_hang',
        'khach_hang_id',
        'tong_tien',
        'phuong_thuc_thanh_toan',
        'trang_thai',
        'ghi_chu',
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id', 'idKhach');
    }
}
