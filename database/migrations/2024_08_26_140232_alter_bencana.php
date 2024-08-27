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
        Schema::table('bencana', function (Blueprint $table) {
            // Change the 'gambar' column type to text
            $table->text('gambar')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bencana', function (Blueprint $table) {
            // Reverse the change: specify the original type of 'gambar' (e.g., string or whatever it was)
            $table->date('gambar')->nullable()->change();
        });
    }
};
