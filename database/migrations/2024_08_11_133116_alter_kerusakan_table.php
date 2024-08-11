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
        Schema::table('detail_kerusakan', function (Blueprint $table) {
            // Mengubah nama kolom 'satuan' menjadi 'satuan_id' dan tipe datanya menjadi integer
            $table->renameColumn('satuan', 'satuan_id');
            $table->integer('satuan_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_kerusakan', function (Blueprint $table) {
            // Mengubah nama kolom 'satuan_id' kembali menjadi 'satuan' dan tipe datanya menjadi string
            $table->renameColumn('satuan_id', 'satuan');
            $table->string('satuan')->nullable()->change();
        });
    }
};
