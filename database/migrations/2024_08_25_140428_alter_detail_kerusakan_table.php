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
            if (Schema::hasColumn('detail_kerusakan', 'tipe')) {
                $table->dropColumn('tipe');
            }
            if (Schema::hasColumn('detail_kerusakan', 'nama')) {
                $table->dropColumn('nama');
            }
            if (Schema::hasColumn('detail_kerusakan', 'satuan_id')) {
                $table->dropColumn('satuan_id');
            }
            $table->renameColumn('kuantitas', 'kuantitas_per_satuan');
            $table->decimal('kuantitas_per_satuan', 10, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_kerusakan', function (Blueprint $table) {
            $table->integer('tipe')->nullable();
            $table->text('nama')->nullable();
            $table->integer('satuan_id')->nullable();
            $table->integer('kuantitas_per_satuan')->change(); // Revert back to integer if needed
            $table->renameColumn('kuantitas_per_satuan', 'kuantitas');
        });
    }
};
