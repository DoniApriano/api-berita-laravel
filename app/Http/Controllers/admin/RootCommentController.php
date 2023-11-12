<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootCommentController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $profilePicture = $user->profile_picture;
        $pageTitle = "Halaman Komentar";

        $search = $request->input("search");

        $comment = Comment::with('user')->with('news')->when($search, function ($query) use ($search) {
            return $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('username', 'like', '%' . $search . '%');
            })->orWhereHas('news', function ($newsQuery) use ($search) {
                $newsQuery->where('title', 'like', '%' . $search . '%');
            })->orWhere('text', 'like', '%' . $search . '%');
        })->latest()->paginate(8);

        return view("admin.comment", compact(["profilePicture", "pageTitle", "comment"]));
    }

    public function show($search)
    {
        $user = Auth::user();
        $profilePicture = $user->profile_picture;
        $pageTitle = "Halaman Komentar";

        $comment = Comment::with('user')->with('news')->when($search, function ($query) use ($search) {
            return $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('username', 'like', '%' . $search . '%');
            })->orWhereHas('news', function ($newsQuery) use ($search) {
                $newsQuery->where('title', 'like', '%' . $search . '%');
            })->orWhere('text', 'like', '%' . $search . '%');
        })->latest()->paginate(8);

        return view("admin.comment", compact(["profilePicture", "pageTitle", "comment"]));
    }
}
