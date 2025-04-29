<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Register
    public function register(Request $request)
    {
        // validasi input
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // simpan data user yang telah register ke database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // kirim response dengan format json dengan http status code 201
        return response()->json([
            'message' => 'User telah berhasil melakukan registrasi',
            'user' => $user,
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        // validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // ambil data user dengan email pada input 
        $user = User::where('email', $request->email)->first();

        // validasi apakah email user ada pada database dan password yang dimasukan sesuai pada database
        if(!$user || !Hash::check($request->password, $user->password))
        {
            // jika gagal lempar response error dengan message dan http code 422 (validasi gagal)
            throw ValidationException::withMessages([
                'email' => ['Email atau Password salah!'],
            ], 422);
        }

        // kalau berhasil generate token untuk user
        $token = $user->createToken('api-token')->plainTextToken;

        // kirim response dalam bentuk json dengan message dan token dan http status code 200 (OK)
        return response()->json([
            'message' => 'Login Berhasil',
            'token' => $token,
        ], 200);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Berhasil Logout',
        ], 200);
    }
}
