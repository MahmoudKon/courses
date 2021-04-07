<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    protected $fillable = ['id', 'name'];

    public function images()
    {
        return $this->hasMany(SlideImages::class);
    }
}
