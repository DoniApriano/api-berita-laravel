<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "following",
    ];

    public function followings()
    {
        return $this->belongsTo(User::class,'following','id');
    }
    public function followers()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
