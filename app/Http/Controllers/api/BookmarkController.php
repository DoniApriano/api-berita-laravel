<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookmarkResource;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $bookmark = Bookmark::with(['news.user', 'news.category'])->with("user")->where("user_id", $userId)->latest()->get();
        return new BookmarkResource(true, "Berhasil fetch", $bookmark);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "news_id" => "required"
        ]);

        $userId = Auth::user()->id;

        $bookmark = Bookmark::create([
            "user_id" => $userId,
            "news_id" => $request->news_id,
        ]);

        return new BookmarkResource(true, "Berhasil fetch", $bookmark);
    }

    public function delete($newsId)
    {
        $userId = Auth::user()->id;
        $bookmark = Bookmark::where('user_id', $userId)
            ->where('news_id', $newsId)
            ->delete();

        return new BookmarkResource(true, "Berhasil menghapus bookmark", $bookmark);
    }
}
