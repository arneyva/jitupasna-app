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
        Schema::table('kerugian', function (Blueprint $table) {
            $table->float('BiayaKeseluruhan', 10, 0)->default(0)->nullable()->after('kuantitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerugian', function (Blueprint $table) {
            $table->dropColumn(['BiayaKeseluruhan']);
        });
    }
};
