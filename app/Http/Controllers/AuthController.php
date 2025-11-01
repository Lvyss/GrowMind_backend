<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Redirect user ke halaman Google
    public function redirectToGoogle() {
        return Socialite::driver('google')->stateless()->redirect();
    }

    // Callback dari Google
    public function handleGoogleCallback() {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Cek user di DB
        $user = User::where('google_id', $googleUser->getId())->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => Hash::make(Str::random(24)),
            ]);
        }

        // Buat Sanctum Token
        $token = $user->createToken('growmind_token')->plainTextToken;

        // Redirect ke frontend dengan token
        $redirectUrl = env('FRONTEND_URL') . '/auth/callback?token=' . $token;

        return redirect($redirectUrl);
    }

    // Logout
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    // Info user login
    public function me(Request $request) {
        return response()->json($request->user());
    }
}
