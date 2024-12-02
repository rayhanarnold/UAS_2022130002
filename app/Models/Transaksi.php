<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis'; // Pastikan nama tabel benar

    protected $fillable = [
        'penyewa_id', // Tambahkan ini
        'tanggal_transaksi',
        'total_biaya',
        'tanggal_pembayaran',
        'jumlah_pembayaran', // Sesuaikan dengan nama kolom di form
    ];

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }
}



