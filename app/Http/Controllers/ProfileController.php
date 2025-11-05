<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        // Ambil user dari token (auth)
        $user = auth()->user();

        // Kalau token invalid / user tidak ada
        if (!$user) {
            return response()->json([
                'error' => 'Unauthorized. Token invalid or expired.'
            ], 401);
        }

        // Ambil profile, kalau tidak ada maka null
        $profile = $user->profile ?? null;

        // Return data aman
        return response()->json([
            'user' => $user,
            'profile' => $profile,
        ]);
    }
}
