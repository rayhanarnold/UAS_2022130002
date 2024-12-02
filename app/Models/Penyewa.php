<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;

    // Pastikan nama tabel di sini benar, jika tidak menggunakan penamaan jamak Laravel
    protected $table = 'penyewas'; // atau sesuai nama tabel di database Anda
}


