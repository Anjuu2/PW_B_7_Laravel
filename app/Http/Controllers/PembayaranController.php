<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Peminjaman;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'nomor_akun' => 'required|integer',
    //         'nominal_angsuran' => 'required|numeric|min:0',
    //         'tahapan_angsuran' => 'required|integer|min:1',
    //     ]);

    //     $pembayaran = Pembayaran::create([
    //         'nomor_akun' => $request->nomor_akun,
    //         'nominal_angsuran' => $request->nominal_angsuran,
    //         'tahapan_angsuran' => $request->tahapan_angsuran,
    //     ]);

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Pembayaran created successfully.',
    //         'data' => $pembayaran,
    //     ], 201);
    // }

    public function Adminindex()
    {
        $pembayarans = Pembayaran::whereNull('tanggal_pembayaran')->get();

        return response()->json([
            'status' => true,
            'message' => 'Pembayarans retrieved successfully.',
            'data' => $pembayarans,
        ], 200);
    }

    public function Adminshow($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran retrieved successfully.',
            'data' => $pembayaran,
        ], 200);
    }

    public function Adminupdate(Request $request, $id)
    {
        $request->validate([
            'tanggal_pembayaran' => 'required',
        ]);

        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran not found.',
            ], 404);
        }

        $pembayaran->update([
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran updated successfully.',
            'data' => $pembayaran,
        ], 200);
    }

    public function Admindelete($id)
    {
        $pembayaran = Pembayaran::find($id);

        if (!$pembayaran) {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran not found.',
            ], 404);
        }

        $pembayaran->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran deleted successfully.',
        ], 200);
    }
    
    ///////////////////////////////////////////// USER /////////////////////////////////////////

    public function create(Request $request)
    {
        $user = Auth::user();

        // Find the first 'Peminjaman' where 'tanggal_peminjaman' is not null
        $peminjaman = Peminjaman::whereNotNull('tanggal_peminjaman')->first();

        // Check if a valid 'Peminjaman' was found
        if (!$peminjaman) {
            return response()->json([
                'message' => "No Peminjaman found with a valid 'tanggal_peminjaman'.",
            ], 404);
        }

        // Menentukan tahapan_angsuran berikutnya
        $lastPayment = Pembayaran::where('id_peminjaman', $peminjaman->id)
                                ->orderBy('tahapan_angsuran', 'desc')
                                ->first();

        // Jika belum ada pembayaran sebelumnya, mulai dari tahapan 1
        $nextTahapan = $lastPayment ? $lastPayment->tahapan_angsuran + 1 : 1;

        $nominal_angsuran = $peminjaman->nominal_fix / $peminjaman->masa_peminjaman;

        // Create new payment record
        $pembayaran = Pembayaran::create([
            'nomor_akun' => $user->id,
            'id_peminjaman' => $peminjaman->id,
            'nominal_angsuran' => $nominal_angsuran,
            'tahapan_angsuran' => $nextTahapan,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran created successfully.',
            'data' => $pembayaran,
            'peminjaman' => $peminjaman,
            'akun' => $user,
        ], 201);
    }


    public function index()
    {
        $user = Auth::user();

        $pembayarans = Pembayaran::where('nomor_akun', $user->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'Pembayarans retrieved successfully.',
            'data' => $pembayarans,
        ], 200);
    }

    public function show()
    {
        $user = Auth::user();

        // Fetch the most recent Pembayaran for the authenticated user
        $pembayaran = Pembayaran::with('akun')
                                ->where('nomor_akun', $user->id)
                                ->orderBy('created_at', 'desc') // Sort by created_at in descending order
                                ->first(); // Get the most recent payment

        if (!$pembayaran) {
            return response()->json([
                'status' => false,
                'message' => 'Pembayaran not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Pembayaran retrieved successfully.',
            'data' => $pembayaran,
            'user' => $user,
        ], 200);
    }

}
