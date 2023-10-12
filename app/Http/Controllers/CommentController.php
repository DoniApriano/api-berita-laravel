<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comment = Comment::with('user:id,username')->with('news:id,title,user_id')->get();

        return new CommentResource(true, 'Berhasil Fetch Comment', $comment);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
                
        ]
        );
    }
}
