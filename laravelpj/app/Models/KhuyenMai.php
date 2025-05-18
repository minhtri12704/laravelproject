<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    protected $fillable = [
        'ma_phieu', 'ten_phieu', 'phan_tram_giam', 'ngay_bat_dau', 'ngay_ket_thuc'
    ];
}