<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'khach_hang_id', 'product_id', 'rating', 'noi_dung'
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id', 'idKhach');
    }

    public function product()
    {
        return $this->belongsTo(CrudProduct::class, 'product_id');
    }
}
