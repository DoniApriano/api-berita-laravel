<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsReport extends Model
{
    use HasFactory;

    protected $fillable = [
        "reporter_user_id",
        "reported_user_id",
        "news_id",
        "description",
    ];
}
