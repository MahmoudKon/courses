<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'image', 'tags', 'category_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(CommentPost::class);
    }

    public function getImagePathAttribute()
    {
        if($this->image !== '')
        {
            return asset('uploads/posts/' . $this->image);
        }

    }//end of get image path
}
