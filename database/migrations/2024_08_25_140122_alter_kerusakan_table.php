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
            if (Schema::hasColumn('kerusakan', 'kuantitas')) {
                $table->dropColumn('kuantitas');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerusakan', function (Blueprint $table) {
            // Add the column back if necessary, specify the column type
            $table->integer('kuantitas')->nullable()->after('kategori_bangunan_id'); // Adjust the column type as needed
        });
    }
};
