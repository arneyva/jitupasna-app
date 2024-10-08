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
        Schema::create('hsd', function (Blueprint $table) {
            $table->id();
            $table->integer('tipe');
            $table->string('nama')->nullable();
            $table->string('satuan')->nullable();
            $table->float('harga', 10, 0)->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hsd');
    }
};
