<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getUser($id)
    {
        $user = User::where("id", $id)->first();
        return new UserResource(true, 'Berhasil Get User', $user);
    }

    public function update(Request $request)
    {
        $userId = Auth::user()->id;

        $user = User::findOrFail($userId);

        $this->validate($request, [
            'profile_picture' => 'image|mimes:png,jpg|max:2048|square_image',
            'username' => 'required'
        ]);

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $profilePicture->storeAs('public/userProfilePicture', $profilePicture->hashName());
            Storage::delete('public/userProfilePicture/' . basename($user->profile_picture));
            $user->update([
                'username' => $request->username,
                'profile_picture' => $profilePicture->hashName(),
            ]);
        } else {
            $user->update([
                'username' => $request->username,
            ]);
        }

        return new UserResource(true, 'Berhasil update profil', $user);
    }
}
