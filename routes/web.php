<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PembayaranController;
Use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Auth\Events\Login;

Route::get('/', action: function () {
    return view('Login');
});
Route::get('/Login', [AkunController::class, 'showViewLogin'])->name('Login.view');
Route::post('/login', [AkunController::class, 'login'])->name('Login');

Route::post('register', [AkunController::class, 'register'])->name('register');
// Route::post('/register', [AkunController::class, 'register'])->name('register');


Route::get('/register', function (){
    return view('Register');
});

Route::get('/dashboard', function(){
    return view('Dashboard');
});

Route::get('/bank/index', function(){
    return view('bank.index');
});

Route::get('/bank/profile', function(){
    return view('bank.profile');
});

Route::get('/admin', function(){
    return view('admin');
});

Route::get('/admin/listakun', function(){
    return view('admin.listakun');
});

Route::get('/admin/listpinjaman', function(){
    return view('admin.listpinjaman');
});

Route::get('/admin/listpembayaran', function(){
    return view('admin.listpembayaran');
});

Route::get('/admin/listdeposit', function(){
    return view('admin.listdeposit');
});

Route::get('/bank/pengajuanPinjaman', function(){
    return view('bank.pengajuanPinjaman');
});

Route::get('/bank/pembayaranAngsuran', function(){
    return view('bank.pembayaranAngsuran');
});

Route::get('/admin/listakun2', function(){
    return view('admin.listakun2');
});

Route::post('/akun/register', [AkunController::class, 'register'])->name('akun.register');
Route::post('/akun/login', [AkunController::class, 'login'])->name('akun.login');
Route::get('/akun/nama', [AkunController::class, 'showNamaAkun'])->name('akun.nama');

// Route::middleware(middleware: 'auth:sanctum')->group(function (){
//     Route::get('/akun', [AkunController::class, 'show'])->name('akun.show');
//     Route::delete('/akun/delete', [AkunController::class, 'destroy'])->name('akun.destroy');
// });