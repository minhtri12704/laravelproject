<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('khach_hang_id');
            $table->string('noi_dung');
            $table->tinyInteger('rating')->default(5); 
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('khach_hang_id')->references('idKhach')->on('khach_hangs')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
}
