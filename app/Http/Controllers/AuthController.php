<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class AuthController extends Controller
{
    public static function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //event(new Registered($user));

        return response()->noContent();
    }

    public static function verifyEmail(Request $request)
    {
        //
    }

    public static function createToken(Request $request)
    {
        // Have the user provide their username and password in the
        // req.  Find them in the db, then issue the token
        //$request->user
    }

    private function authenticateUser(Request $request)
    {
        $credentials = $request->validate([
            "email" => ['required', 'email'],
            "password" => ['password'],
        ]);

        if (Auth::attempt($credentials))
        {
            // Get the user from the request
            Auth::user();
        }

        // else throw a 403 - Unauthorized/invalid credentials

    }
}
