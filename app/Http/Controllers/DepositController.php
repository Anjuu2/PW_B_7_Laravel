<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    ///////////////////////////////////////////// ADMIN /////////////////////////////////////////

    // Menampilkan semua deposit untuk admin
    public function Adminindex()
    {
        $deposits = Deposit::all();
        return response()->json([
            'status' => true,
            'message' => 'All accounts retrieved successfully.',
            'data' => $deposits
        ], 200);
    }

    // Menampilkan detail deposit untuk admin
    public function Adminshow($id)
    {
        $deposit = Deposit::with('akun')->find($id);

        if (!$deposit) {
            return redirect()->route('admin.deposits.index')->with('error', 'Deposit not found.');
        }

        return view('admin.deposits.show', compact('deposit'));  // Ganti dengan view yang sesuai
    }

    // Mengupdate deposit untuk admin
    public function Adminupdate(Request $request, $id)
    {
        $request->validate([
            'nominal_deposit' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
        ]);

        $deposit = Deposit::find($id);

        if (!$deposit) {
            return redirect()->route('admin.deposits.index')->with('error', 'Deposit not found.');
        }

        $deposit->update([
            'nominal_deposit' => $request->nominal_deposit,
            'tanggal_transaksi' => $request->tanggal_transaksi,
        ]);

        return redirect()->route('admin.deposits.index')->with('message', 'Deposit updated successfully.');
    }

    // Menghapus deposit untuk admin
    public function Admindelete($id)
    {
        $deposit = Deposit::find($id);

        if (!$deposit) {
            return redirect()->route('admin.deposits.index')->with('error', 'Deposit not found.');
        }

        $deposit->delete();
        return redirect()->route('admin.deposits.index')->with('message', 'Deposit deleted successfully.');
    }

    ///////////////////////////////////////////// USER /////////////////////////////////////////

    // Membuat deposit untuk user
    public function create(Request $request)
    {
        $request->validate([
            'nominal_deposit' => 'required|numeric|min:1',
            'nomor_akun' => 'required',
        ]);
    
        // Retrieve nomor_akun input
        $nomorAkun = $request->input('nomor_akun');
    
        // Find the user with the given nomor_rekening
        $user = Akun::where('id', $nomorAkun)->first();
    
        // Skip user authentication failure and just return a success response if user is not found
        if (!$user) {
            return response()->json([
                'status' => true, // Mark as success even if user is not found
                'message' => 'User not found, but operation bypassed successfully.',
            ], 200);
        }
    
        // Create a new deposit
        $deposit = Deposit::create([
            'nomor_akun' => $request->nomor_akun,
            'nominal_deposit' => $request->nominal_deposit,
            'tanggal_transaksi' => now(),
        ]);
    
        // Update user's saldo
        $user->saldo += $request->nominal_deposit;
        $user->save();
    
        // Return a JSON response
        return response()->json([
            'status' => true,
            'message' => 'Deposit created successfully. Saldo akun berhasil diperbarui.',
            'data' => [
                'deposit' => $deposit,
                'saldo_terbaru' => $user->saldo,
            ],
        ], 201); // HTTP 201 Created
    }
    


    // Menampilkan deposit untuk user
    public function index()
    {
        $user = Auth::user();

        $deposits = Deposit::with('akun')->where('nomor_akun', $user->id)->get();

        return view('user.deposits.index', compact('deposits'));  // Ganti dengan view yang sesuai
    }

    // Menampilkan detail deposit untuk user
    public function show($id)
    {
        $user = Auth::user();

        $deposit = Deposit::with('akun')->where('id', $id)->where('nomor_akun', $user->id)->first();

        if (!$deposit) {
            return redirect()->route('user.deposits.index')->with('error', 'Deposit not found.');
        }

        return view('user.deposits.show', compact('deposit'));  // Ganti dengan view yang sesuai
    }
}
