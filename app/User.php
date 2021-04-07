<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Course;
use App\Post;
use App\CommentPost;

class User extends Authenticatable
{
    use LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'address', 'phone', 'image', 'password', 'birthday', 'gender', 'status', 'role',
    ];

    protected $appends = ['image_path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function registers()
    {
        return $this->hasMany(Register::class);

    }//end of registers

    public function courses()
    {
        return $this->hasMany(Course::class);

    }//end of products

    public function posts()
    {
        return $this->hasMany(Post::class);

    }//end of products

    public function commentsCourse()
    {
        return $this->hasMany(CommentCourse::class);

    }//end of products

    public function commentsVideo()
    {
        return $this->hasMany(CommentVideo::class);

    }//end of products

    public function commentsPost()
    {
        return $this->hasMany(CommentPost::class);

    }//end of products

    public function getImagePathAttribute()
    {
        return asset('uploads/users_images/' . $this->image);

    }//end of get image path

}//end of model
