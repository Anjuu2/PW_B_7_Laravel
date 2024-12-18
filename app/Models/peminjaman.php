<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class peminjaman extends Model
{
    use HasFactory;

    protected $table= "peminjamans";

    protected $fillable = [
        'nominal_peminjaman',
        'tanggal_peminjaman',
        'masa_peminjaman',
        'deskripsi_peminjaman',
        'nominal_fix',
        'nomor_akun',
    ];

    public function akun(){
        return $this->belongsto(akun::class, 'nomor_akun');
    }
}
