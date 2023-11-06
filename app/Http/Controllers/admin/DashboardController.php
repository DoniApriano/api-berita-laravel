<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $username = Auth::user()->username;
        $userRole = Auth::user()->role;
        $profilePicture = Auth::user()->profile_picture;
        $pageTitle = "Halaman Dashboard";
        return view('admin.index',compact(['username','userRole','profilePicture','pageTitle']));
    }

    public function indexRoot()
    {
        $username = Auth::user()->username;
        $userRole = Auth::user()->role;
        $pageTitle = "Halaman Dashboard";
        $profilePicture = Auth::user()->profile_picture;
        return view("admin.index",compact(["username","userRole","profilePicture","pageTitle"]));
    }
}
