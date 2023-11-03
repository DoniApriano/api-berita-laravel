<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        "reporter_user_id",
        "reported_user_id",
        "type",
        "description",
    ];

    public function reporter()
    {
        return $this->belongsTo(Report::class,'reporter_user_id','id');
    }

    public function reported()
    {
        return $this->belongsTo(Report::class,'reported_user_id','id');
    }
}
