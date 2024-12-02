<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 

     public function up()
     {
         Schema::create('transaksis', function (Blueprint $table) {
             $table->id();
             $table->foreignId('penyewa_id')->constrained()->onDelete('cascade'); // Relasi ke tabel penyewa
             $table->date('tanggal_transaksi')->nullable(); // Tanggal transaksi
             $table->decimal('total_biaya', 10, 2)->nullable(); // Total biaya transaksi
             $table->date('tanggal_pembayaran')->nullable(); // Tanggal pembayaran
             $table->decimal('jumlah_pembayaran', 10, 2)->nullable(); // Jumlah pembayaran
             $table->timestamps();
         });
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
