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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomor_akun')->constrained('akuns')->onDelete('cascade');
            $table->foreignId('id_peminjaman')->constrained('peminjamans')->onDelete('cascade');
            $table->double('nominal_angsuran');
            $table->date('tanggal_pembayaran');
            $table->integer('tahapan_angsuran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
