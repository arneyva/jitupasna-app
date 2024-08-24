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
        Schema::table('kategori_bangunan', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
        Schema::table('kategori_bencana', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
        Schema::table('kerugian', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
        Schema::table('kerusakan', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
        Schema::table('satuan', function (Blueprint $table) {
            $table->text('deskripsi')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_bangunan', function (Blueprint $table) {
            $table->string('deskripsi')->nullable()->change();
        });
        Schema::table('kategori_bencana', function (Blueprint $table) {
            $table->string('deskripsi')->nullable()->change();
        });
        Schema::table('kerugian', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(false)->change();
        });
        Schema::table('kerusakan', function (Blueprint $table) {
            $table->text('deskripsi')->nullable(false)->change();
        });
        Schema::table('satuan', function (Blueprint $table) {
            $table->string('deskripsi')->nullable()->change();
        });
    }
};
