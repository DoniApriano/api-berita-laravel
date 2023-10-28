<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootUserController extends Controller
{
    public function index() {
        $user = User::where('email','!=','root@gmail.com')->get();
        $profilePicture = Auth::user()->profile_picture;
        return view("admin.user",compact(["user","profilePicture"]));
    }
    
}
