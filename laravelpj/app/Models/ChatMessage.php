<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    // Nếu bạn dùng Laravel 8+ và chưa bật fillable toàn cục, nên khai báo fillable
    protected $fillable = [
        'user_id',        
        'customer_id',    
        'message',
        'is_bot'
    ];

    //Liên kết đến admin (users)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //Liên kết với khách hàng
    public function customer()
    {
        return $this->belongsTo(KhachHang::class, 'customer_id', 'idKhach');
    }
}
