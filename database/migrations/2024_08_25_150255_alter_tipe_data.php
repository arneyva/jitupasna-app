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
            $table->decimal('BiayaKeseluruhan', 15, 2)->nullable()->change();
        });
        Schema::table('detail_kerusakan', function (Blueprint $table) {
            $table->decimal('harga', 15, 2)->nullable()->change();
            $table->integer('hsd_id')->after('kerusakan_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerusakan', function (Blueprint $table) {
            $table->float('BiayaKeseluruhan', 10, 0)->nullable()->change(); // Revert back to integer if needed
        });
        Schema::table('detail_kerusakan', function (Blueprint $table) {
            $table->float('harga', 10, 0)->nullable()->change(); // Revert back to integer if needed
            $table->dropColumn('hsd_id');
        });
    }
};
