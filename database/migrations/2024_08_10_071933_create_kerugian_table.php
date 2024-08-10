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
        Schema::create('kerugian', function (Blueprint $table) {
            $table->id();
            $table->integer('bencana_id');
            $table->integer('tipe');
            $table->float('nilai_ekonomi', 10, 0)->nullable();
            $table->string('satuan')->nullable();
            $table->decimal('kuantitas', 8, 2)->nullable();
            $table->text('deskripsi');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerugian');
    }
};
