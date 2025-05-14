<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ten_san_pham');
            $table->decimal('gia', 10, 2);
            $table->string('hinh_anh')->nullable();
            $table->unsignedTinyInteger('so_sao')->default(5);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};