<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SlideImages;
use Illuminate\Support\Facades\Storage;

class SlideImagesController extends Controller
{
    public function delete(Request $request)
    {
        if($request->ajax())
        {
            $image = SlideImages::findOrFail($request->id);
            Storage::disk('public_uploads')->delete('/slider_images/' . $image->image);
            $image->delete();
            alert()->success(__('site.added_successfully'), __('site.good_job'));
        }
    } // end of delete the image specific slider

} // end of controller
