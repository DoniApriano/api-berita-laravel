<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
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
        if (!$user) {
            return response()->json(['error' => 'Email tidak ditemukan'], 401);
        } else if (!Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Kata sandi salah'], 401);
        }

        return new AuthResource(true, 'Berhasil Login', $user, $user->createToken('user login')->plainTextToken);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        $request->user()->currentAccessToken()->delete();
        return new UserResource(true, 'Berhasil Logout', $user);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'profile_picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|square_image',
        ]);

        $image = $request->profile_picture;
        $image->storeAs('/public/userProfilePicture/' . $image->hashName());

        $role = "normal";
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_picture' => $image->hashName(),
            'role' => $role,
        ]);

        return new UserResource(true, 'Berhasil Register', $user);
    }

    public function me(Request $request)
    {
        $user = Auth::user();
        return new UserResource(true, 'Berhasil Fetch Me', $user);
    }
}
