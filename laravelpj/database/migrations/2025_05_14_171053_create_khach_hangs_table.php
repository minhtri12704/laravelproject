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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id('idKhach');
            $table->string('Ten');
            $table->string('SoDienThoai');
            $table->string('Email')->nullable();
            $table->string('DiaChi')->nullable();
            $table->string('MatKhau'); 
            $table->timestamps();
        });
        
        
    }

    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
        
    }
};