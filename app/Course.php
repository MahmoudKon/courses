<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\User;
use App\Video;
class Course extends Model
{
    protected $fillable = ['title', 'description','user_id', 'category_id', 'tags', 'image', 'status'];


    public function registers()
    {
        return $this->hasMany(Register::class);

    }//end of registers

    public function category()
    {
        return $this->belongsTo(Category::class);

    }//end fo category

    public function user()
    {
        return $this->belongsTo(User::class);

    }//end fo category

    public function videos()
    {
        return $this->hasMany(Video::class);

    }//end fo category

    public function comments()
    {
        return $this->hasMany(CommentCourse::class);

    }//end fo category

    public function getImagePathAttribute()
    {
        return asset('uploads/courses_images/' . $this->image);

    }//end of get image path
}
