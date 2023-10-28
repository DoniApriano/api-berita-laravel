<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comment = Comment::with('user:id,username')->with('news:id,title,user_id')->get();

        return new CommentResource(true, 'Berhasil Fetch Comment', $comment);
    }

    public function showCommentByNews($id)
    {
        $comment = Comment::with('news:id,title,user_id')->with('user:id,username,profile_picture')->where('news_id', $id)->get();

        return new CommentResource(true, 'Berhasil Fetch Comment', $comment);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'news_id' => 'required',
            'text' => 'required',
        ]);

        $userId = Auth::user()->id;

        $news = Comment::create([
            'news_id'     => $request->news_id,
            'text'     => $request->text,
            'user_id' => $userId,
        ]);
        return new CommentResource(true, 'Berhasil Fetch Data', [$news]);
    }
}
