<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleLoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Allowed emails
            $allowedEmails = [
                'yoelflemming8@gmail.com',
                'smkaladelphi.tigabinanga@gmail.com'
            ];

            // Check if the email is allowed
            if (!in_array($googleUser->email, $allowedEmails)) {
                return redirect()->route('login')->with('error', 'Akun Google Anda tidak memiliki akses ke halaman admin.');
            }

            // Find or create the user
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Create a new user if not exists
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random(16)), // Random password
                ]);
            }

            // Log the user in
            Auth::login($user, true);

            return redirect()->route('admin.dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login menggunakan Google. Silakan coba lagi.');
        }
    }
}
