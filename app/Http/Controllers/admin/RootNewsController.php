<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class RootNewsController extends Controller
{
    public function index()
    {
        $news = News::get();
        $category = Category::get();

        return view('admin.news', compact(['news', 'category']));
    }
}
