<?php

use App\Http\Controllers\HomeController;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Psr7\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route To Go To Dashboard Pages
Route::get('/dashboard', function () {
    return redirect()->route('dashboard.welcome');
});
// End

Auth::routes();


// Route To View The Home Page
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/courses', 'HomeController@courses')->name('courses');
Route::get('/courses/filter', 'HomeController@showCourses')->name('courses.filter');
Route::get('/courses/single/{title}', 'HomeController@singleCourse')->name('singleCourse');
Route::post('/courses/createComment', 'HomeController@course_comment')->name('courses.comment');
Route::get('/courses/videos', 'HomeController@videos')->name('courses.videos');
Route::get('/courses/videos/filter', 'HomeController@showVideos')->name('courses.videos.filter');
Route::get('/courses/videos/watch', 'HomeController@watchVideo')->name('courses.videos.watch');
Route::post('/courses/videos/watch/createComment', 'HomeController@video_comment')->name('courses.videos.watch.createComment');

Route::get('register/course', 'RegisterCourseController@register')->name('register.course');


Route::get('/about', function () {
    return view('ui.about');
})->name('about');
Route::get('/profile/{user}', 'HomeController@profile')->name('profile');

Route::get('/posts', 'HomeController@posts')->name('posts');
Route::get('/posts/filter', 'HomeController@showposts')->name('posts.filter');
Route::get('/posts/id={id}', 'HomeController@singlePost')->name('posts.single');
Route::post('/posts/create', 'HomeController@createPost')->name('posts.create');
Route::post('/posts/createComment', 'HomeController@post_comment')->name('posts.comment');
Route::get('/posts/edit', 'HomeController@postEdit')->name('posts.edit');
Route::post('/posts/update', 'HomeController@postUpdate')->name('posts.update');
Route::get('/posts/delete', 'HomeController@postDelete')->name('posts.delete');
//End


// Route To Send Meassage In Contact Us Page
// Route To Send Meassage In Contact Us Page
Route::post('/contact/send', function () {
    return view('ui.contact');
});
Route::post('/contact/send', function () {
    $data = request()->validate([
        'name'      => 'required',
        'email'     => 'required|email',
        'phone'     => 'required',
        'message'   => 'required',
    ]);
    Mail::to('mahmoud_mohammed050@yahoo.com')->send(new ContactFormMail($data));
    return redirect()->route('contact')->with('message', ' Thanks for your message. We\'ll be in touch.');
})->name('contact.send');


Route::resource('user', 'UserController')->except('show');
Route::post('user/login', 'UserController@login')->name('user.login');
Route::get('user/login', 'UserController@signin')->name('user.signin');

Route::get('user/logout', 'UserController@logout')->name('user.logout');

// End

