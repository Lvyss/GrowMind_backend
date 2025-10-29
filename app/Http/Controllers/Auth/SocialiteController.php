<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Cek user, buat baru kalau belum ada
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
            ]
        );

        // Generate token Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Redirect ke frontend dengan token
        $frontendUrl = "http://localhost:5173/modules?token=$token";
        return redirect($frontendUrl);
    }
}
