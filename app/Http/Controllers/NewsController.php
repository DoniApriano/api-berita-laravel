<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsDetailResource;
use App\Http\Resources\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::get();
        return new NewsResource(true,'Berhasil Fetch Data',$news);
    }

    public function show($id)
    {
        $news = News::with('category:id,name')->with('user:id,username')->findOrFail($id);
        return new NewsDetailResource(true,'Berhasil Fetch Data',$news);
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
        return new NewsDetailResource(true,'Berhasil Fetch Data',$news);
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->storeAs('/public/newsImage/' . $image->hashName());

            Storage::delete('/public/newsImage/' . $news->image);
            $news->update($request->all());
            return response()->json([$news]);
        } else {
            $news->update($request->all());
            return response()->json([$news]);
        }
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return response()->json(['berhasil']);
    }
}
