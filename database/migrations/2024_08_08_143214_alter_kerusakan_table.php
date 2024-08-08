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
        Schema::table('kerusakan', function (Blueprint $table) {
            $table->dropColumn(['kategori_kerusakan_id']);
            $table->integer('kategori_rusak_id')->nullable()->after('bencana_id');
            $table->integer('kategori_bangunan_id')->nullable()->after('kategori_rusak_id');
        });
        //status
        //quantity recieved
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerusakan', function (Blueprint $table) {
            $table->integer('kategori_kerusakan_id');
            $table->dropColumn(['kategori_bangunan_id', 'kategori_rusak_id']);
        });
    }
};
