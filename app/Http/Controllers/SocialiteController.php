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
    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Redirect user ke halaman otentikasi provider.
     */
    public function redirect(string $provider)
    {
        // Method dinamis berdasarkan provider dari URL
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Tangani callback dari Google setelah otentikasi.
     */
    public function callbackGoogle()
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

    /**
     * Tangani callback dari provider setelah otentikasi.
     */
    public function callback(string $provider)
    {
        try {
            // Dapatkan data user dari provider yang sesuai
            $providerUser = Socialite::driver($provider)->user();

            // Logika find or create sekarang juga dinamis
            $user = User::updateOrCreate(
                [
                    'provider_id' => $providerUser->getId(),
                    'provider_name' => $provider,
                ],
                [
                    'name' => $providerUser->getName(),
                    'email' => $providerUser->getEmail(),
                    'email_verified_at' => now(),
                ]
            );

            Auth::login($user);

            return redirect('/dashboard');

        } catch (\Throwable $th) {
            Log::error('Socialite login failed for provider: '.$provider, ['error' => $th->getMessage()]);
            return redirect('/login')->with('error', 'Login with ' . ucfirst($provider) . ' failed.');
        }
    }
}
