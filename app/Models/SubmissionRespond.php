<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionRespond extends Model
{
    use HasFactory;

    protected $fillable = [
        "submission_request_id",
        "user_id",
        "text",
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function submissionRequest()
    {
        return $this->belongsTo(SubmissionRequest::class,'submission_request_id','id');
    }
}
