<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NormalNewsController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $profilePicture = Auth::user()->profile_picture;
        $news = News::where('user_id', $userId)->get();
        $category = Category::get();
        $newsId = $request->input('news_id');

        return view('admin.news', compact(['news', 'category', 'profilePicture']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'news_content' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:ratio=16/9',
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

        return redirect()->route('normal.news.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if (Storage::exists('/public/newsImage/' . $news->image)) {
            Storage::delete('/public/newsImage/' . $news->image);
        }
        $comment = Comment::where('news_id', $news->id);

        $comment->delete();
        $news->delete();
        return back()->with('success', 'Berhasil Hapus');
    }
}
