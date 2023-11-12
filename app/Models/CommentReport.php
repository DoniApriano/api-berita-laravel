<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        "reporter_user_id",
        "reported_user_id",
        "comment_id",
        "description",
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class,'reporter_user_id','id');
    }

    public function reported()
    {
        return $this->belongsTo(User::class,'reported_user_id','id');
    }
    public function comment()
    {
        return $this->belongsTo(Comment::class,'comment_id','id');
    }
}
