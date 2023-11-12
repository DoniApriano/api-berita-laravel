<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Follow;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $category = Category::get();
        $users = User::where('role', 'normal')
            ->when($search, function ($query) use ($search) {
                return $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->latest()->paginate(5);
        $profilePicture = Auth::user()->profile_picture;
        $pageTitle = 'Halaman Semua Pengguna';

        $followers = [];
        $following = [];
        $news = [];
        $allNews = [];
        $allFollowers = [];
        $allFollowing = [];

        foreach ($users as $user) {
            $followerCount = Follow::where('following', $user->id)->count();
            $followingCount = Follow::where('user_id', $user->id)->count();
            $newsCount = News::where('user_id', $user->id)->count();
            $allNewsGet = News::where('user_id', $user->id)->get();
            $allFollowersGet = Follow::where('following', $user->id)->with('followers')->get();
            $allFollowingGet = Follow::where('user_id', $user->id)->with('followings')->get();
            $followers[$user->id] = $followerCount;
            $following[$user->id] = $followingCount;
            $news[$user->id] = $newsCount;
            $allNews[$user->id] = $allNewsGet;
            $allFollowers[$user->id] = $allFollowersGet;
            $allFollowing[$user->id] = $allFollowingGet;
        }

        return view("admin.user", compact(["users", "profilePicture", "pageTitle", "followers", "following", "news", "allNews", "category", "allFollowers", "allFollowing"]));
    }

    public function show($search)
    {

        $category = Category::get();
        $users = User::where('role', 'normal')
            ->when($search, function ($query) use ($search) {
                return $query->where('username', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })->latest()->paginate(5);
        $profilePicture = Auth::user()->profile_picture;
        $pageTitle = 'Halaman Semua Pengguna';

        $followers = [];
        $following = [];
        $news = [];
        $allNews = [];
        $allFollowers = [];
        $allFollowing = [];

        foreach ($users as $user) {
            $followerCount = Follow::where('following', $user->id)->count();
            $followingCount = Follow::where('user_id', $user->id)->count();
            $newsCount = News::where('user_id', $user->id)->count();
            $allNewsGet = News::where('user_id', $user->id)->get();
            $allFollowersGet = Follow::where('following', $user->id)->with('followers')->get();
            $allFollowingGet = Follow::where('user_id', $user->id)->with('followings')->get();
            $followers[$user->id] = $followerCount;
            $following[$user->id] = $followingCount;
            $news[$user->id] = $newsCount;
            $allNews[$user->id] = $allNewsGet;
            $allFollowers[$user->id] = $allFollowersGet;
            $allFollowing[$user->id] = $allFollowingGet;
        }

        return view("admin.user", compact(["users", "profilePicture", "pageTitle", "followers", "following", "news", "allNews", "category", "allFollowers", "allFollowing"]));
    }
}
