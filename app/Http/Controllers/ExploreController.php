<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class ExploreController extends Controller
{
    public function getUser()
    {
        try {
            $data = User::orderBy('name', 'asc')->get();
            return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }
    public function searchUser(Request $request)
    {
        try {
            $request->validate([
                'key' => 'required'
            ]);
    
            $key = $request->key;
    
            $data = User::where('nis', 'LIKE', "%$key%")
                ->orWhere('name', 'LIKE', "%$key%")
                ->orWhere('romble', 'LIKE', "%$key%")
                ->orderBy('name', 'asc')
                ->get();
    
            if ($data->isEmpty()) {
                return response()->json(['status' => false, 'message' => 'Data not found'], 404);
            }
    
            return response()->json(['status' => true, 'message' => 'Data found', 'data' => $data]);
    
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Server error', 'error' => $e->getMessage()], 500);
        }
    }
    
}
