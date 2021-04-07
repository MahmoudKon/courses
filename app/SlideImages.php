<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlideImages extends Model
{
    protected $fillable = ['id', 'title', 'description', 'image', 'slides_id'];

    protected $appends = ['image_path'];

    public function slides()
    {
        return $this->belongsTo(Slides::class);
    }

    public function getImagePathAttribute()
    {
        return asset('uploads/slider_images/' . $this->image);

    }//end of get image path
}
