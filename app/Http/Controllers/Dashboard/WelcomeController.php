<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\CommentCourse;
use App\CommentPost;
use App\CommentVideo;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Slides;
use App\User;
use App\Video;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_dashboard'])->only(['index']);
        $this->middleware(['permission:create_dashboard'])->only('create');
        $this->middleware(['permission:update_dashboard'])->only('edit');
        $this->middleware(['permission:delete_dashboard'])->only(['destroy']);
    } // end of constructor

    public function index(Request $request)
    {
        $users      = User::where('role', '<>', 'super_admin')->whereBetween('created_at', array(Carbon::now()->subDays(200), Carbon::now()))->take(5)->get();
        $categories = Category::whereBetween('created_at', array(Carbon::now()->subDays(200), Carbon::now()))->take(5)->get();
        $courses    = Course::whereBetween('created_at', array(Carbon::now()->subDays(100), Carbon::now()))->take(5)->get();
        $videos     = Video::whereHas('course', function ($q) {
            return $q->where('status', 'Active');
        })
            ->whereBetween('created_at', array(Carbon::now()->subDays(200), Carbon::now()))->take(5)->get();
        $posts      = Post::whereBetween('created_at', array(Carbon::now()->subDays(200), Carbon::now()))->take(5)->get();
        $sliders    = Slides::whereBetween('created_at', array(Carbon::now()->subDays(200), Carbon::now()))->take(5)->get();

        // Get Count To All Modeols
        $count['users']      = User::where('role', '<>', 'super_admin')->count();
        $count['categories'] = Category::count();
        $count['courses']    = Course::where('status', 'Active')->count();
        $count['videos']     = Video::whereHas('course', function ($q) {
            return $q->where('status', 'Active');
        })->count();
        $count['posts']      = Post::count();
        $count['sliders']    = Slides::count();
        $count['comments']   = CommentCourse::count() + CommentVideo::count() + CommentPost::count();

        return view('dashboard.welcome', compact('users', 'categories', 'courses', 'videos', 'posts', 'sliders', 'count'));
    } // end of index page

} // end of controller
