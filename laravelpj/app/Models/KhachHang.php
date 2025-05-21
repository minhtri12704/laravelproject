<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KhachHang extends Authenticatable
{
    use HasFactory;

    protected $table = 'khach_hangs';
    protected $primaryKey = 'idKhach';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = ['Ten', 'SoDienThoai', 'Email', 'DiaChi', 'MatKhau'];

    protected $hidden = ['MatKhau'];

    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class, 'customer_id', 'idKhach');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'khach_hang_id');
    }
}
