<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NormalNewsController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $news = News::where('user_id', $userId)->get();
        $category = Category::get();
        $newsId = $request->input('news_id');

        return view('admin.news', compact(['news', 'category']));
    }
}
