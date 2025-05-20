<?php

// database/migrations/xxxx_xx_xx_create_chat_messages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();       // admin trả lời
            $table->unsignedBigInteger('customer_id')->nullable();   // khách gửi
            $table->text('message');
            $table->boolean('is_bot')->default(false);               // có phải bot không
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('customer_id')->references('idKhach')->on('khach_hangs')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
}

