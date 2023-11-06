<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

    $users = User::where('role', 'normal')
                 ->when($search, function ($query) use ($search) {
                     return $query->where('username', 'like', '%' . $search . '%')
                                  ->orWhere('email', 'like', '%' . $search . '%');
                 })
                 ->paginate(5);
        $profilePicture = Auth::user()->profile_picture;
        $pageTitle = 'Halaman Semua Pengguna';

        $followers = []; // Inisialisasi array followers

        foreach ($users as $user) {
            $followerCount = Follow::where('following', $user->id)->count();
            $followers[$user->id] = $followerCount;
        }

        return view("admin.user", compact(["users", "profilePicture", "pageTitle", "followers"]));
    }
}
