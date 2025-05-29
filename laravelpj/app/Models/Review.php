<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

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
