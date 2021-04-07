<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\CommentCourse;
use App\CommentPost;
use App\CommentVideo;
use App\Course;
use App\Post;
use App\Slides;
use App\Video;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', '=', 'Active')->take(3)->get();
        $categories = Category::latest()->get();
        $slider     = Slides::where('name', 'home')->first();
        return view('ui.index', compact('courses', 'categories', 'slider'));
    }

    public function courses(Request $request)
    {
        $query = $request->all();
        $categories = Category::get();
        $latest = Course::latest()->take(3)->get();
        $tags = DB::table('courses')->select('tags')->groupBy('tags')->take(5)->get();
        return view('ui.courses', compact('query', 'categories', 'latest', 'tags'));
    }

    public function showCourses(Request $request)
    {
        if($request->ajax())
        {
            if($request->category == 'All Categories'){
                $request->category = '';
            }
            $courses = Course::where('status', '=','Active')->when($request->course, function ($q) use ($request) {
                            return $q->where('title', 'like', '%' . $request->course . '%');
                        })->when($request->category, function ($q) use ($request) {
                            return $q->where('category_id', '=', $request->category);
                        })->when($request->tag, function ($q) use ($request) {
                            return $q->where('tags', 'like', '%' . $request->tag . '%');
                        })->paginate(6);
            return view('ui.courses_page.courses_list', compact('courses'));
        }
    }

    public function singleCourse($slug)
    {
        $course  = Course::where('title', str_replace('-', ' ', $slug))->first();
        $courses = Course::where('id', '<>', $course->id)->get();
        $latest = Course::latest()->take(3)->get();
        return view('ui.course', compact('course', 'courses', 'latest'));
    }

    public function videos(Request $request)
    {
        $query = $request->all();
        $categories = Category::get();
        $latest = Course::latest()->take(3)->get();
        $tags = DB::table('courses')->select('tags')->groupBy('tags')->get();
        return view('ui.videos_list', compact('query', 'categories', 'latest', 'tags'));
    }

    public function showVideos(Request $request)
    {
        if($request->ajax())
        {
            $videos = Video::when($request->video, function ($q) use ($request) {
                return $q->where('title', 'like', '%' . $request->video . '%');
            })->when($request->category, function ($q) use ($request) {
                return $q->where('category_id', '=', $request->category);
            })->when($request->tag, function ($q) use ($request) {
                return $q->where('tags', 'like', '%' . $request->tag . '%');
            })->when($request->course, function ($q) use ($request) {
                return $q->where('course_id', '=', $request->course);
            })->whereHas('course', function($q) use ($request) {
                return $q->where('status', '=','Active');
            })->paginate(4);

            return view('ui.videos_page.videos_list', compact('videos'));
        }
    }

    public function watchVideo(Request $request)
    {

        $video = Video::where('id', '=', $request->index)
                        ->wherehas('course', function($q){
                            return $q->where('status', '=', 'Active');
                        })->get()->first();
        $list       = Video::where('course_id', '=', $video->course_id)->get();
        $popular    = Video::where('id', '<>', $video->id)->whereHas('course', function($q) {
                                return $q->where('status', '=', 'Active');
                                    })->inRandomOrder()->take(10)->get();
        return view('ui.watch_video', compact('video', 'list', 'popular'));
    }

    public function profile(User $user)
    {
        return view('ui.profile', compact('user'));
    }

    public function posts(Request $request)
    {
        $query = $request->all();
        $categories = Category::get();
        return view('ui.blog', compact('query', 'categories'));
    }

    public function postDelete(Request $request)
    {
        if($request->ajax())
        {
            Post::findOrFail($request->id)->delete();
        }
    }

    public function postEdit(Request $request)
    {
        if($request->ajax())
        {
            return Post::FindOrFail($request->id);
        }
    }

    public function postUpdate(Request $request)
    {
        if($request->ajax())
        {
            $request->validate([
                'description'   => 'required',
                'tags'          => 'required',
                'image'         => 'image|mimes:jpeg,jpg,png,gif',
                'category_id'   => 'required',
                'id'            => 'required',
            ]);
            $post = Post::findOrFail($request->id);
            $request_data = $request->except('image', 'id');
            $request_data['tags'] = strip_tags($request_data['tags']);

            if ($request->image) {
                if($post->image){
                    Storage::disk('public_uploads')->delete('/posts/' . $post->image);
                }
                Image::make($request->image)
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/posts/' . $request->image->hashName()));
                $request_data['image'] = $request->image->hashName();
            } //end of if

            $post->update($request_data);
            return response($post);

        }
    }

    public function showPosts(Request $request)
    {
        if($request->ajax())
        {
            $posts = Post::when($request->post, function ($q) use ($request) {
                return $q->where('description', 'like', '%' . $request->post . '%')
                            ->orWhere('title', 'like', '%' . $request->post . '%');
            })->when($request->category, function ($q) use ($request) {
                return $q->where('category_id', '=', $request->category);
            })->when($request->tag, function ($q) use ($request) {
                return $q->where('tags', 'like', '%' . $request->tag . '%');
            })->latest()->paginate(6);
            return view('ui.posts_page.posts_list', compact('posts'));
        }
    }

    public function singlePost($id) {
        $post       = Post::findOrFail($id);
        $latest     = Post::latest()->take(3)->get();
        $categories = Category::get();
        return view('ui.single_post', compact('post', 'latest', 'categories'));
    }

    public function post_comment(Request $request)
    {
        if($request->ajax()) {
            $comment = CommentPost::create([
                'comment'   => $request->comment,
                'user_id'   => $request->user,
                'post_id'  => $request->post,
            ]);
            return view('ui.single_post_page.comment', compact('comment'));
        }
    }

    public function createPost(Request $request)
    {
        if($request->ajax())
        {
            $request->validate([
                'user_id'       => 'required',
                'description'   => 'required',
                'tags'          => 'required',
                'image'         => 'image|mimes:jpeg,jpg,png,gif',
                'category_id'   => 'required',
            ]);
            $request_data = $request->except('image');

            if ($request->image) {
                Image::make($request->image)
                    ->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('uploads/posts/' . $request->image->hashName()));
                $request_data['image'] = $request->image->hashName();
            } //end of if

            $post = Post::create($request_data);
            return view('ui.posts_page.post', compact('post'));
        }
    }

    public function course_comment(Request $request)
    {
        if($request->ajax()) {
            $comment = CommentCourse::create([
                'comment'   => $request->comment,
                'user_id'   => $request->user,
                'course_id'  => $request->course,
            ]);
            return view('ui.single_course_page.comment', compact('comment'));
        }
    }

    public function video_comment(Request $request)
    {
        if($request->ajax()) {
            $comment = CommentVideo::create([
                'comment'   => $request->comment,
                'user_id'   => $request->user,
                'video_id'  => $request->video,
            ]);
            return view('ui.watch_page.comment', compact('comment'));
        }
    }

}
