<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table = 'baiviet'; // Tên bảng trong database
    protected $fillable = ['tieude', 'noidung', 'hinhanh'];
}