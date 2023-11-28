<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsDetailResource;
use App\Http\Resources\NewsResource;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\News;
use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category:id,name')->with('user')->latest()->get();
        return new NewsResource(true, 'Berhasil Fetch Data', $news);
    }

    public function show($id)
    {
        $news = News::with('category:id,name')->with('user')->findOrFail($id);
        return new NewsDetailResource(true, 'Berhasil Fetch Data', $news);
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
        $views = 0;
        $news = News::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'news_content'     => $request->news_content,
            'user_id'     => $userId,
            'category_id'     => $request->category_id,
            'views'     => $views,
        ]);
        return new NewsDetailResource(true, 'Berhasil Fetch Data', $news);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'news_content' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|',
        ]);

        $news = News::findOrFail($id);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->storeAs('/public/newsImage/' . $image->hashName());

            Storage::delete('/public/newsImage/' . $news->image);

            $news->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'category_id' => $request->category_id,
                'news_content' => $request->news_content,
            ]);
        } else {
            $news->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'news_content' => $request->news_content,
            ]);
        }

        return new NewsResource(true, "Berhasil update", $news);
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);
        if (Storage::exists('/public/newsImage/' . $news->image)) {
            Storage::delete('/public/newsImage/' . $news->image);
        }
        $comment = Comment::where('news_id', $news->id);
        $notif = Notification::where('news_id', $news->id);
        $notif->delete();
        $comment->delete();
        $news->delete();
        return new NewsDetailResource(true, 'Berhasil Delete News', $news);
    }

    public function latestNews()
    {
        $news = News::with('category:id,name')->with('user')->latest()->paginate(5);
        return new NewsDetailResource(true, 'Berhasil fetch', $news);
    }

    public function showNewsByUserId($id)
    {
        $news = News::with("user")->with("category")->where('user_id', $id)->orderBy('id', 'desc')->get();
        return new NewsResource(true, "Berhasil fetch news dari id user '$id'", $news);
    }

    public function showNewsByCategoryIdPaginate($id)
    {
        $news = News::with('category:id,name')->with('user')->where('category_id', $id)->latest()->paginate(2);
        return new NewsResource(true, "Berhasil fetch news dari id category '$id'", $news);
    }

    public function showNewsByCategoryIdAll($id)
    {
        $news = News::with('category:id,name')->with('user')->where('category_id', $id)->latest()->get();
        return new NewsResource(true, "Berhasil fetch news dari id category '$id'", $news);
    }

    public function showNewsByFollowing()
    {
        $userId = Auth::user()->id;

        $following = Follow::where('user_id', $userId)->get();
        $news = [];
        foreach ($following as $follow) {
            $allNews = News::with('user', 'category')->where('user_id', $follow->following)->orderBy('id', 'desc')->get();
            $news = array_merge($news, $allNews->toArray());
        }

        usort($news, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return new NewsResource(true, 'Berhasil fetch', $news);
    }

    public function searchNewsAndUser($search)
    {
        $news = News::with('user', 'category')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('username', 'like', '%' . $search . '%');
                })
                    ->orWhereHas('category', function ($newsQuery) use ($search) {
                        $newsQuery->where('title', 'like', '%' . $search . '%');
                    })
                    ->orWhere(function ($newsQuery) use ($search) {
                        $newsQuery->where('title', 'like', '%' . $search . '%')
                            ->orWhere('news_content', 'like', '%' . $search . '%');
                    });
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('category', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        return new NewsResource(true, "Berhasil fetch $search", [
            'news' => $news,
            'users' => User::where('username', 'like', '%' . $search . '%')->get(),
        ]);
    }

    public function addTren(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $news->increment("views");

        return new NewsResource(true, 'Berhasil post tren', $news);
    }

    public function getTren()
    {
        $trendingNews = News::with('user', 'category')
            ->where('created_at', '<=', Carbon::tomorrow())
            ->where('views', '>', 0)
            ->orderBy('views', 'desc')
            ->get();

        return new NewsResource(true, 'Trending news for today', $trendingNews);
    }
}
