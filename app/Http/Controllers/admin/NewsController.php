<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $news = News::where('user_id', $userId)->get();
        $category = Category::get();

        return view('admin.news', compact(['news', 'category']));
    }
}
