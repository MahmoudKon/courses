<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;
use App\Video;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name'];

    public function courses()
    {
        return $this->hasMany(Course::class);

    }//end of products

    public function videos()
    {
        return $this->hasMany(Course::class);

    }//end of products

    public function posts()
    {
        return $this->hasMany(Post::class);

    }//end of products
}
