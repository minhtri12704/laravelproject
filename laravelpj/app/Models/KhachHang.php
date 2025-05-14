<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = 'khach_hangs'; // Tên bảng thủ công
    protected $primaryKey = 'idKhach'; // Khóa chính tùy chỉnh

    public $timestamps = true;

    protected $fillable = ['Ten', 'SoDienThoai', 'Email', 'DiaChi', 'MatKhau'];

    protected $hidden = ['MatKhau']; // Ẩn khi trả về JSON

}