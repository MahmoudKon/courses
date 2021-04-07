<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SlideImages;
use App\Slides;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SlidesController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_slides'])->only(['index']);
        $this->middleware(['permission:create_slides'])->only('create');
        $this->middleware(['permission:update_slides'])->only('edit');
        $this->middleware(['permission:delete_slides'])->only(['destroy']);

        $sliders = Slides::get();
        foreach($sliders as $slider) :
            if($slider->images->count() == 0) :
                $slider->delete();
            endif;
        endforeach;
    } // end of construct

    public function index()
    {
        $count = Slides::count();
        return view('dashboard.slides.index', compact('count'));
    } // end of index page

    public function rows(Request $request)
    {
        if($request->ajax()) :
            $paginate = $request->paginateNumber;
            $rows = Slides::where(function ($q) use ($request) {
                return $q->when($request->search, function ($query) use ($request) {
                    return $query->where($request->columnName, 'like', '%' . str_replace('-', ' ', $request->search) . '%');
                });
            })->latest()->paginate($paginate);

            return view('dashboard.slides.rows', compact('rows'));
        endif;
    } // end of rows all rows by ajax

    public function create()
    {
        return view('dashboard.slides.create');
    } // end of create page

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required',
            'title.*'         => 'required',
            'description.*'   => 'required',
            'image.*'         => 'required',
        ]);
        $all_data = $request->all();
        $slide = Slides::create(['name' => $all_data['name']]);

        for($i = 0; $i < count($all_data['title']); $i++)
        {
            Image::make($all_data['image'][$i])
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/slider_images/' . $all_data['image'][$i]->hashName()));
            $all_data['image'][$i] = $all_data['image'][$i]->hashName();
            
            $slide->images()->create([
                'title'       => $all_data['title'][$i],
                'description' => $all_data['description'][$i],
                'image'       => $all_data['image'][$i],
            ]);
        }

        alert()->success(__('site.added_successfully'), __('site.good_job'));
        return redirect('dashboard/slides');
    } // end of store the new row

    public function show(Slides $slide)
    {
        return view('dashboard.slides.show', compact('slide'));
    } // end of show the row

    public function edit($id)
    {
        $slider = Slides::findOrFail($id);
        return view('dashboard.slides.edit', compact('slider'));
    } // end of edit page

    public function update(Request $request, $id)
    {
        $request->validate([
            'title.*'         => 'required',
            'description.*'   => 'required',
            'image.*'         => 'image',
        ]);
        $data = $request->except(['_token', '_method', 'sliderID']);
        $slider = Slides::findOrFail($id);

        foreach($data as $image) :
            
            // If Isset Image Upload IT
            if(isset($image['image'])) :
                Image::make($image['image'])
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/slider_images/' . $image['image']->hashName()));
                $image['image'] = $image['image']->hashName();
            endif;

            // If Isset Image ID Then This Row Is Isset on Database Then Make Update
            if(isset($image['id'])) : 
                $img = SlideImages::findOrFail($image['id']);
                if(isset($image['image'])) :
                    Storage::disk('public_uploads')->delete('/slider_images/' . $img->image);
                endif;
                $img->update($image);

            // Else This Row Is Not Exist On Database Then Make Create For IT
            else : 
                $slider->images()->create($image);
            endif;

        endforeach;
        alert()->success(__('site.updated_successfully'), __('site.good_job'));
        return redirect('dashboard/slides');
    } // end of update the row

    public function destroy($id)
    {
        $slider = Slides::findOrFail($id);
        foreach($slider->images as $image)
        {
            Storage::disk('public_uploads')->delete('/slider_images/' . $image->image);
        } //end of inner if
        $slider->delete();
        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.slides.index');
    } // end of destroy the single row or multi rows

    public function multidelete(Request $request)
    {
        $ids = explode(',', $request->ids); // to make the all id is array
        $sliders = Slides::whereIn('id', $ids)->get(); // get the rows by id to remove his image first and delete him

        foreach($sliders as $slider) :
            foreach($slider->images as $image) :
                Storage::disk('public_uploads')->delete('/slider_images/' . $image->image);
            endforeach;
            $slider->delete();
        endforeach; //end foreach to remove the slider's image and delete him
        
        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.slides.index');
    } // end of destroy multi rows

} // end of controller
