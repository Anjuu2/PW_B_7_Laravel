<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class riwayat extends Model
{
    use HasFactory;

    protected $table= "riwayats";

    protected $fillable=[
        'nomor_akun',
        'jenis_transaksi',
        'nominal_transaksi',
        'tanggal_transaksi',
    ];

    public function akun(){
        return $this->belongsto(akun::class, 'nomor_akun');
    }
}
