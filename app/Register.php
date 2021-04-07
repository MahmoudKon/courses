<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $fillable = [
        'user_id', 'course_id', 'phone',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);

    }//end of users

    public function courses()
    {
        return $this->belongsToMany(Course::class);

    }//end of courses
}
