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
        Schema::create('aspirasis', function (Blueprint $table) {
            $table->id();

            $table->foreignId('input_aspirasi_id')
                ->constrained('input_aspirasis')
                ->onDelete('cascade');

            $table->enum('status', ['menunggu', 'proses', 'selesai']);

            $table->foreignId('siswa_id')
                ->constrained('siswas')
                ->onDelete('cascade');

            $table->foreignId('kategori_id')
                ->constrained('kategoris')
                ->onDelete('cascade');

            $table->string('feedback');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
