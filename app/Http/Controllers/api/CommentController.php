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
        $comment = Comment::where('status', 'true')->with('user')->with('news')->get();

        return new CommentResource(true, 'Berhasil Fetch Comment', $comment);
    }

    public function showCommentByNews($id)
    {
        $comment = Comment::where('status', 'true')->with('news')->with('user')->where('news_id', $id)->get();

        return new CommentResource(true, 'Berhasil Fetch Comment', $comment);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'news_id' => 'required',
            'text' => 'required',
        ]);

        $userId = Auth::user()->id;

        $comment = Comment::create([
            'news_id'     => $request->news_id,
            'text'     => $request->text,
            'user_id' => $userId,
        ]);
        return new CommentResource(true, 'Berhasil Fetch Data', [$comment]);
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return new CommentResource(true, 'Berhasil Hapus Komentar', [$comment]);
    }
}
