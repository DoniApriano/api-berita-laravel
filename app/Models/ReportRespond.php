<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportRespond extends Model
{
    use HasFactory;

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
    public function commentReport()
    {
        return $this->belongsTo(CommentReport::class,'comment_report_id','id');
    }
}
