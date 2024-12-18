<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
// use App\Http\Controllers\Log;
class AkunController extends Controller
{
    // Register Method
    public function showViewRegister()
{
    return view('Register');
}

    public function register(Request $request)
{

    // Log::info('Register function called', ['data' => $request->all()]);
    

    try {

        $request->validate([
            'npm' => 'required|unique:akuns,npm',
            'nama_akun' => 'required',
            'pin' => 'required',
            'password' => 'required',
        ]);
        $nomorRekening = mt_rand(1000000000, 9999999999);
        //$nomorRekening = 'NR' . strtoupper(uniqid()) . m  t_rand(1000, 9999);
        $akun = Akun::create(attributes: [
            'npm' => $request['npm'],
            'nomor_rekening' => $nomorRekening,
            'nama_akun' => $request['nama_akun'],
            'saldo' => 0,
            'pin' => $request['pin'],
            'password' => Hash::make($request['password']),
            'isAdmin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        return redirect()->route('Login.view')->with('message', 'Registration successful. Please log in.');
    } catch (Exception $e) {
        return response()->json([
            "status" => false,
            "message" => "Something went wrong",
            "error" => $e->getMessage(),
        ], 400);
    }
}


public function showViewLogin()
{
    return view('Login');
}


    // Login Method
    public function login(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'npm' => 'required',
            'password' => 'required',
            'pin' => 'required',
        ]);

        // Find the user account by npm
        $akun = Akun::where('npm', $request->npm)->first();

        // If account doesn't exist
        if (!$akun) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials: Account not found.",
            ], 401);
        }

        // Check if PIN matches
        if (strval($akun->pin) !== strval($request->pin)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials: Incorrect PIN.",
            ], 401);
        }

        // Check if password matches
        if (!Hash::check($request->password, $akun->password)) {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials: Incorrect password.",
            ], 401);
        }
        if($akun->isAdmin){
            return response()->json([
                'status' => true,
                'message' => 'Halo Admin',
  // Send the token in the response
            ], 200);
        }

        

        // Try to create a token and return it
        try {
            $token = $akun->createToken('Personal Access Token')->plainTextToken;

            session(['token' => $token]);

            return response()->json([
                'status' => true,
                'message' => 'Login successful.',
                'token' => $token,  // Send the token in the response
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error creating token: " . $e->getMessage(),
            ], 500);
        }
    }

    // Logout Method
    public function logout (Request $request)
    {
        if(Auth::check()){
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logged out successfully']);
        }

        return response()->json(['message' => 'Not logged in'], 401);
    }

    public function show(Request $request)
    {
        // Mendapatkan pengguna yang sedang login
        $user = Auth::user();

        // Jika tidak ada pengguna yang login
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access',
            ], 401); // 401 Unauthorized
        }

        // Mendapatkan data akun berdasarkan ID pengguna yang login
        $akun = Akun::find($user->id);

        // Jika akun tidak ditemukan
        if (!$akun) {
            return response()->json([
                'status' => false,
                'message' => 'Akun not found',
            ], 404); // 404 Not Found
        }

        return response()->json([
            'status' => true,
            'message' => 'Akun retrieved successfully',
            'data' => $akun,
        ], 200); // 200 OK
    }

    public function showNamaAkun()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Not authenticated'], 401);
        }

        $nama = $user->nama_akun;
        if (!$nama) {
            return response()->json(['message' => 'Name not found'], 404); // Fix: Missing a comma before the status code
        }

        return response()->json([
            'message' => 'Name found',
            'nama_akun' => $nama,
        ], 200); // Fix: Ensure you return 200 OK when the data is found
    }


    public function destroy($id)
{
    // Find the Akun record based on the provided ID
    $akun = Akun::find($id);

    if (!$akun) {
        return response()->json([
            'status' => false,
            'message' => 'Akun not found',
        ], 404);
    }

    // Delete the Akun record
    $akun->delete();

    return response()->json([
        'status' => true,
        'message' => 'Akun deleted successfully',
    ], 200);
}

    public function adminindex()
    {
        // Retrieve all accounts from the Akun model
        $akuns = Akun::where('isAdmin', '!=', 1)->get();

        // Return the data as a JSON response
        return response()->json([
            'status' => true,
            'message' => 'All accounts retrieved successfully.',
            'data' => $akuns
        ], 200);
    }

    public function updatePin(Request $request, $id)
    {
        // Validasi input untuk PIN
        $request->validate([
            'pin' => 'required',
        ]);

        // Temukan akun berdasarkan ID
        $akun = Akun::find($id);

        // Jika akun tidak ditemukan
        if (!$akun) {
            return response()->json([
                'status' => false,
                'message' => 'Akun not found.',
            ], 404);
        }

        // Update PIN akun
        $akun->update([
            'pin' => $request->input('pin'),
        ]);

        // Berikan respons berhasil
        return response()->json([
            'status' => true,
            'message' => 'PIN updated successfully.',
            'data' => $akun,
        ], 200);
    }
}