<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Course;
class Video extends Model
{
    protected $fillable = ['title', 'description', 'category_id', 'course_id', 'tags', 'video'];

    public function category()
    {
        return $this->belongsTo(Category::class);

    }//end fo category

    public function course()
    {
        return $this->belongsTo(Course::class);

    }//end fo category

    public function comments()
    {
        return $this->hasMany(CommentVideo::class);

    }//end fo category

    public function getVideoPathAttribute(){
        return asset('uploads/videos/' . $this->video);
    }
}
