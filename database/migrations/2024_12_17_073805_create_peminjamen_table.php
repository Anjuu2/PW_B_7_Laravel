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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->double('nominal_peminjaman');
            $table->date('tanggal_peminjaman');
            $table->integer('masa_peminjaman');
            $table->string('ktm');
            $table->string('deskripsi_peminjaman');
            $table->double('nominal_fix');
            $table->foreignId('nomor_akun')->constrained('akuns')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
