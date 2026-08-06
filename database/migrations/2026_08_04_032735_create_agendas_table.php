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
    Schema::create('agenda', function (Blueprint $table) {
        $table->id();
        $table->string('judul_rapat');
        $table->date('tanggal');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->string('tempat');
        $table->string('pimpinan_rapat');
        $table->text('keterangan')->nullable();
        $table->enum('status', ['Terjadwal', 'Selesai', 'Ditunda'])->default('Terjadwal');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
