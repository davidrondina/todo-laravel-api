<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'exists:users,email', 'email'],
            'password' => ['required', 'string']
        ]);

        // $request->authenticate();

        // $request->session()->regenerate();

        // return response()->noContent();



        $user = User::where('email', $request->email)->first();

        if (Hash::check($request->password, $user->getAuthPassword())) {
            return [
                'token' => $user->createToken(time())->plainTextToken
            ];
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        // Auth::guard('web')->logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();

        // return response()->noContent();



        // $request->user->currentAccessToken()->delete();

        auth()->user()->currentAccessToken()->delete();

        // return response()->noContent();

        return response()->json(['message' => 'Logged out'], 200);
    }
}
