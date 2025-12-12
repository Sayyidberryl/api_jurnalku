<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginUser(Request $request)
    {
        try {


            $validator = Validator::make($request->all(), [
                'auth' => 'required',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->first()], 400);
            }

            $user = User::where('nis', $request->auth)
                ->orWhere('username', $request->auth)
                ->first();

            if (!$user) {

                return response()->json(['status' => false, 'message' => 'Email, username, atau telepon tidak ditemukan'], 404);
            }

            if (!Hash::check($request->password, $user->password)) {

                return response()->json(['status' => false, 'message' => 'Password salah'], 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login sukses',
                'token' => $token,
                'user' => $user,

            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function registerUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'name' => 'required',
                'password' => 'required',
                'nis' => 'required',
                'rayon' => 'required',
                'romble' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => 'Gagal menyimpan data', 'data' => $validator->errors()], 400);
            }

            if (User::where('username', $request->username)->exists()) {
                return response()->json(['status' => false, 'message' => 'Username sudah digunakan'], 400);
            }
            if (User::where('nis', $request->nis)->exists()) {
                return response()->json(['status' => false, 'message' => 'Telepon sudah digunakan'], 400);
            }

            $userdata = new User;
            $userdata->username = $request->username;
            $userdata->name = $request->name;
            $userdata->nis = $request->nis;
            $userdata->romble = $request->romble;
            $userdata->rayon = $request->rayon;
            $userdata->password = Hash::make($request->password);
            $userdata->save();

            return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }
    public function logoutUser(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logout berhasil'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal logout',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
