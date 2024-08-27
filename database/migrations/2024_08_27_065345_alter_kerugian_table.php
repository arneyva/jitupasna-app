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
            $table->decimal('nilai_ekonomi',15,2)->nullable()->change();
            $table->decimal('BiayaKeseluruhan',15,2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerugian', function (Blueprint $table) {
            $table->float('nilai_ekonomi', 10, 0)->nullable()->change();
            $table->float('BiayaKeseluruhan', 10, 0)->nullable()->change();
        });
    }
};
