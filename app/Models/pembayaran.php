<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class pembayaran extends Model
{
    use HasFactory;

    protected $table= "pembayarans";

    protected $fillable = [
        'nomor_akun',
        'id_peminjaman',
        'nominal_angsuran',
        'tanggal_pembayaran',
        'tahapan_angsuran',
    ];

    public function akun(){
        return $this->belongsto(akun::class, 'nomor_akun');
    }

    public function peminjaman(){
        return $this->belongsto(akun::class, 'id_peminjaman');
    }
}
