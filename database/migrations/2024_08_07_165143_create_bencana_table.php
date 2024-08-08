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
        Schema::create('bencana', function (Blueprint $table) {
            $table->id();
            $table->integer('kategori_bencana_id');
            $table->text('lokasi');
            $table->text('deskripsi');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bencana');
    }
};
