<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Course;
use App\CommentCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Video;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_courses'])->only(['index']);
        $this->middleware(['permission:create_courses'])->only('create');
        $this->middleware(['permission:update_courses'])->only('edit');
        $this->middleware(['permission:delete_courses'])->only(['destroy']);
    } //end of constructor

    public function index(Request $request)
    {
        $categories = Category::get();
        $count = Course::count();
        return view('dashboard.courses.index', compact('count', 'categories'));
    } // end of index page

    public function rows(Request $request)
    {
        if ($request->ajax()) :
            $paginate = $request->paginateNumber;
            $rows = Course::when($request->search, function ($q) use ($request) {
                return $q->where($request->columnName, 'like', '%' . $request->search . '%');
            })->latest()->paginate($paginate);
            return view('dashboard.courses.rows', compact('rows'));
        endif;
    } // end of rows all rows by ajax

    public function create()
    {
        $categories = Category::get();
        return view('dashboard.courses.create', compact('categories'));
    } // end of create page

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|min:15',
            'description' => 'required|min:15',
            'image'       => 'required|mimes:jpeg,jpg,png,gif',
            'tags'        => 'required|min:2',
            'category_id' => 'required',
            'user_id'     => 'required',
            'status'      => 'required',
        ]);

        $request_data = $request->except(['image']);
        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/courses_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if
        Course::create($request_data);
        alert()->success(__('site.added_successfully'), __('site.good_job'));
        return redirect('dashboard/courses');
    } // end of store the new row

    public function show(Course $course, Request $request)
    {
        if ($request->ajax()) {
            $rows = Video::where('course_id', $course->id)->paginate(2);
            $url  = 'videos';
            return view('dashboard.layouts.list', compact('rows', 'url'));
        }
        $videos = Video::where('course_id', $course->id)->paginate(3);
        $comments = CommentCourse::where('course_id', $course->id)->get();
        return view('dashboard.courses.show', compact('course', 'videos', 'comments'));
    } // end of show the row

    public function edit(Course $course)
    {
        $categories = Category::get();
        $comments = CommentCourse::where('course_id', '=', $course->id)->get();
        return view('dashboard.courses.edit', compact('course', 'categories', 'comments'));
    } // end of edit page

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title'       => 'required|min:15',
            'description' => 'required|min:15',
            'image'       => 'mimes:jpeg,jpg,png,gif',
            'tags'        => 'required|min:2',
            'category_id' => 'required',
            'status'      => 'required',
        ]);
        $request_data = $request->except(['image']);

        if ($request->image) {
            File::delete('uploads/courses_images/' . $course->image);
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/courses_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if

        $course->update($request_data);
        alert()->success(__('site.updated_successfully'), __('site.good_job'));
        return redirect('dashboard/courses');
    } // end of update the row

    public function destroy(Course $course)
    {
        File::delete('uploads/courses_images/' . $course->image);
        $course->delete();
        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect('dashboard/courses');
    } //end of destroy the single row or multi rows

    public function multidelete(Request $request)
    {
        $ids = explode(',', $request->ids); // to make the all id is array
        $courses = Course::whereIn('id', $ids)->get(); // get the rows by id to remove his image first and delete him

        foreach ($courses as $course) :
            File::delete('uploads/courses_images/' . $course->image);
            $course->delete();
        endforeach; //end foreach to remove the row's image and delete him

        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.courses.index');
    } // end of destroy multi rows

} // end of controller
