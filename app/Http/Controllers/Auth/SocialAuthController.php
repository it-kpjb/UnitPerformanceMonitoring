<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and log them in.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google authentication failed. Please try again.');
        }

        // Find existing user by email or create a new one
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Create new user from Google data
            $user = User::create([
                'name'              => $googleUser->getName(),
                'email'             => $googleUser->getEmail(),
                'password'          => bcrypt(Str::random(24)),
                'email_verified_at' => now(),
            ]);

            // Assign default role to new user
            $role = Role::where('name', 'Admin Document')->first();
            if ($role) {
                $user->assignRole($role);
            }
        }

        // Log the user in and regenerate session to fix CSRF/logout issues
        Auth::login($user, true);
        session()->regenerate();

        return redirect('/home');
    }
}
