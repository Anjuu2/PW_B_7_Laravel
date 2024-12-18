<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PeminjamanController extends Controller
{
    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'nomor_akun' => 'required|integer',
    //         'nominal_peminjaman' => 'required|numeric|min:0',
    //         'tanggal_peminjaman' => 'required|date',
    //         'masa_peminjaman' => 'required|integer|min:1',
    //         'ktm' => 'required|string',
    //         'deskripsi_peminjaman' => 'required|string',
    //     ]);

    //     $peminjaman = Peminjaman::create($request->all());

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Peminjaman created successfully.',
    //         'data' => $peminjaman,
    //     ], 201);
    // }

    public function Adminindex()
    {
        $peminjaman = Peminjaman::whereNull('tanggal_peminjaman')->get();

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman retrieved successfully.',
            'data' => $peminjaman,
        ], 200);
    }

    public function Adminshow($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman not found.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman retrieved successfully.',
            'data' => $peminjaman,
        ], 200);
    }

    public function Adminupdate(Request $request, $id)
    {
        $request->validate([
            'nominal_peminjaman' => 'required',  
            'masa_peminjaman' => 'required',
            'tanggal_peminjaman' => 'required',
        ]);

        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman not found.',
            ], 404);
        }

        $peminjaman->update($request->all());
        
        return response()->json([
            'status' => true,
            'message' => 'Peminjaman updated successfully.',
            'data' => $peminjaman,
        ], 200);
    }

    public function Admindelete($id)
    {
        $peminjaman = Peminjaman::find($id);

        if (!$peminjaman) {
            return response()->json([
                'status' => false,
                'message' => 'Peminjaman not found.',
            ], 404);
        }

        $peminjaman->delete();

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman deleted successfully.',
        ], 200);
    }

    ///////////////////////////////////////////// USER /////////////////////////////////////////

    public function create(Request $request)
    {
        // Ambil ID user yang sedang login
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'nominal_peminjaman' => 'required',
            'masa_peminjaman' => 'required',
            'deskripsi_peminjaman' => 'required',
        ]);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated',
            ], 401);
        }
        $peminjaman = Peminjaman::create([
            'nomor_akun' => $user->id,
            'nominal_peminjaman' => $request->nominal_peminjaman,
            'masa_peminjaman' => $request->masa_peminjaman,
            'deskripsi_peminjaman' => $request->deskripsi_peminjaman,
            'nominal_fix' => $request->nominal_peminjaman,
        ]);

        // Kembalikan respons JSON
        return response()->json([
            'status' => true,
            'message' => 'Peminjaman created successfully.',
            'data' => $peminjaman,
        ], 201);
    }


    public function index()
    {
        $user = Auth::user();

        $peminjaman = Peminjaman::where('nomor_akun', $user->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'Peminjamans retrieved successfully.',
            'data' => $peminjaman,
        ], 200);
    }

    public function show()
    {
        $user = Auth::user();

        // Find Peminjaman where 'tanggal_peminjaman' is not null and matches the user's account number
        $peminjaman = Peminjaman::with('akun')
                                ->whereNotNull('tanggal_peminjaman')
                                ->where('nomor_akun', $user->id)
                                ->first();

        if (!$peminjaman) {
            return response()->json([
                'status' => false,
                'message' => 'No Peminjaman found with a valid tanggal_peminjaman.',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Peminjaman retrieved successfully.',
            'data' => $peminjaman,
            'user' => $user,
        ], 200);
    }
}
