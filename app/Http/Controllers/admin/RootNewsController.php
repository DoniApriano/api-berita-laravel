<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootNewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        $category = Category::get();
        $author = User::get();
        $profilePicture = Auth::user()->profile_picture;
        $pageTitle = "Semua Berita";

        return view('admin.news', compact(['news', 'category','profilePicture','pageTitle','author']));
    }
}
