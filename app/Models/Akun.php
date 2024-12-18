<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;


class Akun extends Model
{
    use HasFactory, HasApiTokens;
    public $timestamps = false;

    protected $table= "akuns";

    protected $fillable =[
        'npm',
        'nomor_rekening',
        'nama_akun',
        'saldo',
        'pin',
        'password',
        'isAdmin',
    ];

    public function deposit()
{
    return $this->hasMany(Deposit::class, 'nomor_akun', 'id');
}
}
