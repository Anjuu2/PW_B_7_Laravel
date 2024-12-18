<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use App\Models\Deposit;
use App\Models\Peminjaman;
use App\Models\Pembayaran;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function createDeposit($id)
    {
        // Cari user (Akun) dengan ID yang diberikan
        
        $user = Akun::whereHas('deposit', function ($query) use ($id) {
            $query->where('id', $id);
        })->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Akun not found',
            ], 404);
        }

        // Ambil hanya satu data Deposit pertama berdasarkan nomor_akun user
        $deposit = Deposit::where('nomor_akun', $user->nomor_rekening)
                  ->whereNotNull('tanggal_transaksi');

        if (!$deposit) {
            return response()->json([
                'status' => false,
                'message' => 'No valid deposit found.',
            ], 404);
        }

        // Simpan data deposit ke dalam tabel Riwayat
        $riwayat = Riwayat::firstOrCreate(
            [
                'nomor_akun' => $user->nomor_rekening,
                'jenis_transaksi' => 'Deposit',
                'tanggal_transaksi' => $deposit->tanggal_transaksi,
            ],
            [
                'nominal_transaksi' => $deposit->nominal_deposit,
            ]
        );

        // Return response dengan data riwayat yang disimpan
        return response()->json([
            'status' => true,
            'message' => 'Riwayat Deposit berhasil dibuat.',
            'data' => $riwayat,
        ], 201);
    }



    public function createPeminjaman($id)
    {
        // Find the user (Akun) with the same ID passed in the parameter
        $user = Akun::find($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Akun not found',
            ], 404);
        }

        // Ambil data Peminjaman berdasarkan nomor_akun user
        $peminjamans = Peminjaman::where('nomor_akun', $user->nomor_rekening)
                                ->whereNotNull('tanggal_peminjaman')
                                ->get();

        // Proses untuk menyimpan data dari peminjaman
        foreach ($peminjamans as $peminjaman) {
            Riwayat::firstOrCreate(
                [
                    'nomor_akun' => $user->nomor_rekening,
                    'jenis_transaksi' => 'Peminjaman',
                    'tanggal_transaksi' => $peminjaman->tanggal_peminjaman,
                ],
                [
                    'nominal_transaksi' => $peminjaman->nominal_peminjaman,
                ]
            );
        }

        return response()->json([
            'status' => true,
            'message' => 'Riwayat Peminjaman berhasil dibuat untuk Akun ID: ' . $id,
        ], 201);
    }

    public function createPembayaran($id)
    {
        // Find the user (Akun) with the same ID passed in the parameter
        $user = Akun::whereHas('pembayaran', function ($query) use ($id) {
            $query->where('pembayaran.nomor_akun', $id);
        })->first();
    
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Akun not found',
            ], 404);
        }
    
        // Ambil data Pembayaran berdasarkan nomor_akun user
        $pembayarans = Pembayaran::where('nomor_akun', $user->id)
                                 ->whereNotNull('tanggal_pembayaran')
                                 ->get();
    
        // Proses untuk menyimpan data dari pembayaran
        foreach ($pembayarans as $pembayaran) {
            Riwayat::firstOrCreate(
                [
                    'nomor_akun' => $user->nomor_rekening,
                    'jenis_transaksi' => 'Pembayaran',
                    'tanggal_transaksi' => $pembayaran->tanggal_pembayaran,
                ],
                [
                    'nominal_transaksi' => $pembayaran->nominal_angsuran,
                ]
            );
        }
    
        return response()->json([
            'status' => true,
            'message' => 'Riwayat Pembayaran berhasil dibuat untuk Akun ID: ' . $id,
        ], 201);
    }

    // READ: Menampilkan semua riwayat transaksi berdasarkan user yang login
    public function index()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login

        // Ambil riwayat transaksi berdasarkan nomor_akun user login
        $riwayats = Riwayat::where('nomor_akun', $user->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'Riwayat transaksi berhasil diambil.',
            'data' => $riwayats,
        ], 200);
    }
}
