<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentVideo extends Model
{
    protected $fillable = ['comment', 'user_id', 'video_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
