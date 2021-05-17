<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use App\CommentVideo;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_videos'])->only(['index']);
        $this->middleware(['permission:create_videos'])->only('create');
        $this->middleware(['permission:update_videos'])->only('edit');
        $this->middleware(['permission:delete_videos'])->only(['destroy']);
    } // end of constructor

    public function index(Request $request)
    {
        $categories = Category::get();
        $count = Video::count();
        return view('dashboard.videos.index', compact('count', 'categories'));
    } // end of index page

    public function rows(Request $request)
    {
        if ($request->ajax()) :
            $paginate = $request->paginateNumber;
            $rows = Video::when($request->search, function ($q) use ($request) {
                return $q->where($request->columnName, 'like', '%' . $request->search . '%')
                    ->orWhereHas('course', function ($query) use ($request) {
                        $query->where('title', 'like', '%' . $request->search . '%')
                            ->orWhereHas('user', function ($q) use ($request) {
                                $q->where('name', 'like', '%' . $request->search . '%');
                            });
                    });
            })->latest()->paginate($paginate);

            return view('dashboard.videos.rows', compact('rows'));
        endif;
    } // end of rows all rows by ajax

    public function create()
    {
        $categories = Category::get();
        $courses    = Course::where('user_id', '=', auth()->user()->id)->get();
        return view('dashboard.videos.create', compact('categories', 'courses'));
    } // end of create page

    public function store(Request $request)
    {
        dd(phpinfo());
        $request->validate([
            'title'         => 'required|min:5',
            'tags'          => 'required|min:2',
            'category_id'   => 'required',
            'course_id'     => 'required',
            'user_id'       => 'required',
            'description'   => 'required|min:15',
            'video'         => 'required|mimes:mp4,mov,ogg | max:200000'
        ]);
        $request_data = $request->except(['video']);

        if ($request->hasfile('video')) {
            $file = $request->file('video');
            $extension = $request->video->getClientOriginalExtension();
            $fileName =  uniqid() . '.' . $extension;
            $file->move(public_path() . '/uploads/videos/', $fileName);
            $request_data['video'] = $fileName;
        }

        Video::create($request_data);
        alert()->success(__('site.added_successfully'), __('site.good_job'));
        return redirect('dashboard/videos');
    } // end of store the new row

    public function show(Video $video)
    {
        $comments = CommentVideo::where('video_id', $video->id)->get();
        return view('dashboard.videos.show', compact('video', 'comments'));
    } // end of show all rows by ajax

    public function edit(Video $video)
    {
        $categories = Category::get();
        $courses = Course::where('user_id', '=', $video->course->user_id)->get();
        $comments = CommentVideo::where('video_id', '=', $video->id)->get();
        return view('dashboard.videos.edit', compact('video', 'categories', 'courses', 'comments'));
    } // end of edit page

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title'         => 'required|min:5',
            'tags'          => 'required|min:2',
            'category_id'   => 'required',
            'course_id'    => 'required',
            'description'   => 'required|min:15',
        ]);

        $video->update($request->all());
        alert()->success(__('site.added_successfully'), __('site.good_job'));
        return redirect('dashboard/videos');
    } // end of update the row

    public function destroy(Video $video)
    {
        Storage::disk('public_uploads')->delete('/videos/' . $video->video);
        $video->delete();
        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect('dashboard/videos');
    } // end of destroy the single row or multi rows

    public function multidelete(Request $request)
    {
        $ids = explode(',', $request->ids); // to make the all id is array
        $videos = Video::whereIn('id', $ids)->get(); // get the rows by id to remove his image first and delete him

        foreach ($videos as $video) :
            Storage::disk('public_uploads')->delete('/videos/' . $video->video);
            $video->delete();
        endforeach; //end foreach to remove the video's video and delete him

        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.videos.index');
    } // end of destroy multi rows

} // end of controller
