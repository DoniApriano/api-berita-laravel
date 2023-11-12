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
    public function index(Request $request)
    {
        $search = $request->input("search");
        $categorySearch = $request->input("category_search");

        $news = News::with('user')->with('category')->when($search, function ($query) use ($search) {
            return $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('username', 'like', '%' . $search . '%');
            })->orWhereHas('category', function ($newsQuery) use ($search) {
                $newsQuery->where('title', 'like', '%' . $search . '%');
            })->orWhere('title', 'like', '%' . $search . '%')->orWhere('news_content', 'like', '%' . $search . '%');
        })->when($categorySearch, function ($query) use ($categorySearch) {
            return $query->whereHas('category', function ($categoryQuery) use ($categorySearch) {
                $categoryQuery->where('id', 'like', '%' . $categorySearch . '%');
            });
        })->latest()->paginate(5);

        $category = Category::get();
        $author = User::get();
        $profilePicture = Auth::user()->profile_picture;
        $pageTitle = "Semua Berita";

        return view('admin.news', compact(['news', 'category', 'profilePicture', 'pageTitle', 'author']));
    }

    public function show($search)
    {
        $news = News::with('user')->with('category')->when($search, function ($query) use ($search) {
            return $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('username', 'like', '%' . $search . '%');
            })->orWhereHas('category', function ($newsQuery) use ($search) {
                $newsQuery->where('title', 'like', '%' . $search . '%');
            })->orWhere('title', 'like', '%' . $search . '%')->orWhere('news_content', 'like', '%' . $search . '%');
        })->latest()->paginate(5);

        $category = Category::get();
        $author = User::get();
        $profilePicture = Auth::user()->profile_picture;
        $pageTitle = "Semua Berita";

        return view('admin.news', compact(['news', 'category', 'profilePicture', 'pageTitle', 'author']));
    }
}
