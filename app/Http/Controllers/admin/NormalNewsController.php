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

    public function store(Request $request)
    {
        $this->validate($request, [
            'news_content' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);

        $userId = Auth::user()->id;

        $image = $request->image;
        $image->storeAs('/public/newsImage/' . $image->hashName());

        $news = News::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'news_content'     => $request->news_content,
            'user_id'     => $userId,
            'category_id'     => $request->category_id,
        ]);

        return redirect()->route('normal.news.index')->with('success','Data Berhasil Ditambahkan');
    }
}
