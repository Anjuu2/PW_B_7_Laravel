<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class deposit extends Model
{
    use HasFactory;

    protected $table= "deposits";

    protected $fillable = [
        'nomor_akun',
        'nominal_deposit',
        'tanggal_transaksi',
    ];
    
    public function akun(){
        return $this->belongsto(akun::class, 'nomor_akun');
    }
}
