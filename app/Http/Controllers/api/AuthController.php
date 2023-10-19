<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provide credentials is incorrect'],
            ]);
        }

        // return response()->json([
        //         'user' => [
        //             'username' => $user->email,
        //             'email' => $user->username
        //         ],
        //         'token' => $user->createToken('user login')->plainTextToken
        //     ]);

        return new AuthResource($user);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function register()
    {
    }

    public function me(Request $request)
    {
        $user = Auth::user();
        $post = News::where('user', $user);
        return response()->json(Auth::user());
    }
}
