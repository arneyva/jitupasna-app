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
            $table->string('Ref', 192)->nullable()->after('id');
        });
        Schema::table('kerugian', function (Blueprint $table) {
            $table->string('Ref', 192)->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kerusakan', function (Blueprint $table) {
            $table->dropColumn(['Ref']);
        });
        Schema::table('kerugian', function (Blueprint $table) {
            $table->dropColumn(['Ref']);
        });
    }
};
