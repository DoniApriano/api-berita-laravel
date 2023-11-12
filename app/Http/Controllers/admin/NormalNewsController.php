<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NormalNewsController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $profilePicture = Auth::user()->profile_picture;
        $news = News::where('user_id', $userId)->paginate(4);
        $category = Category::get();
        $newsId = $request->input('news_id');
        $pageTitle = "Halaman Berita";

        return view('admin.news', compact(['news', 'category', 'profilePicture', 'pageTitle']));
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

        $newsId = $news->id;
        $notif = Notification::create([
            'news_id' => $newsId,
            'user_id' => Auth::user()->id,
            'description' => 'Menambahkan berita',
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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'news_content' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|dimensions:ratio=16/9',
        ]);

        $news = News::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->storeAs('/public/newsImage/'.$image->hashName());

            Storage::delete('/public/newsImage'. $news->image);

            $news->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'category_id'=> $request->category,
                'news_content' => $request->news_content,
            ]);
        } else {
            $news->update([
                'title' => $request->title,
                'category_id'=> $request->category_id,
                'news_content' => $request->news_content,
            ]);
        }

        return back()->with('success','Berhasil Update Berita');

    }
}
