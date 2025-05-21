<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('ten_don_hang');
            $table->unsignedBigInteger('khach_hang_id'); 
            $table->decimal('tong_tien', 15, 2)->nullable();
            $table->string('phuong_thuc_thanh_toan');
            $table->string('trang_thai')->default('Chưa xử lý');
            $table->string('ghi_chu')->nullable();
            $table->timestamps();

            // Khóa ngoại tham chiếu đến bảng khach_hangs
            $table->foreign('khach_hang_id')->references('id')->on('khach_hangs')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
