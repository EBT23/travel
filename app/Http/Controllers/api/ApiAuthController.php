<?php

namespace App\Http\Controllers\api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken('user token')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data' => $token,
            'user' => $user,
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Logout berhasil'
        ]);
    }
    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
        ]);

        // simpan data ke database
        $data = new User;
        $data->nama = $validated['nama'];
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->no_hp = $request->no_hp;
        $data->role_id = 2;
        $data->save();

        // kirim response
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ]);
    }
}
