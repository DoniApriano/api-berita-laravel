<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $fillable = [
        "news_id",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    public function news()
    {
        return $this->belongsTo(News::class, "news_id", "id");
    }
}
