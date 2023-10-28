<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user()->username;
        $userRole = Auth::user()->role;
        $profilePicture = Auth::user()->profile_picture;
        return view('admin.index',compact(['user','userRole','profilePicture']));
    }

    public function indexRoot()
    {
        $user = Auth::user()->username;
        $userRole = Auth::user()->role;
        $profilePicture = Auth::user()->profile_picture;
        return view("admin.index",compact(["user","userRole","profilePicture"]));
    }
}
