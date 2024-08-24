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
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->integer('kecamatan_id')->nullable();
            $table->string('nama');
            $table->string('kode_pos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kecamatan');
        Schema::dropIfExists('desa');
    }
};
