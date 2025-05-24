<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = [
        'user_id',        // admin trả lời
        'customer_id',    // khách gửi
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
