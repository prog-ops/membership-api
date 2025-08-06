<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect user ke halaman otentikasi Google.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Tangani callback dari Google setelah otentikasi.
     */
    public function callback()
    {
        try {
            // Mendapatkan data user dari Google
            $googleUser = Socialite::driver('google')->user();

            // Cari user di db berdasarkan provider_id,
            // atau buat user baru jika tidak ditemukan
            $user = User::updateOrCreate(
                [
                    'provider_id' => $googleUser->getId(),
                    'provider_name' => 'google',
                ],
                [
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'email_verified_at' => now(), // Anggap email dari Google sudah terverifikasi
                ]
            );

            // Login user
            Auth::login($user);

            // Redirect ke dashboard
            return redirect('/dashboard');

        } catch (\Throwable $th) {
            // Jika ada error, kembali ke halaman login
            // Log::error('Google login failed: ' . $th->getMessage());
            return redirect('/login')->with('error', 'Login with Google failed.');
        }
    }
}
