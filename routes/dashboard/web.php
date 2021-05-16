<?php

Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'WelcomeController@index')->name('welcome');
            Route::get('/charts', 'ChartController@getMonthlyPostData')->name('charts');



            // CRUD To [ Users ] Pages.
            // To Make Read Method On Users and Load The Data On Table By Ajax
            Route::get('users/rows', 'UserController@rows')->name('users.rows');
            // To Make Create , Update, Delete Methods On Users
            Route::resource('users', 'UserController');
            // To Make Multi Delete Users
            Route::post('users/multidelete', 'UserController@multidelete')->name('users.multidelete');
            // End [ Users ] Pages

            // CRUD To [ Categories ] Pages.
            // To Make Create , Update, Delete Methods On Categories
            Route::resource('categories', 'CategoryController');
            // To Make Read Method On Categories and Load The Data On Table By Ajax
            Route::get('categories/rows', 'CategoryController@show')->name('categories.rows');
            // To Make Multi Delete Categories
            Route::post('categories/multidelete', 'CategoryController@multidelete')->name('categories.multidelete');
            // End [ Categories ] Pages

            // CRUD To [ Courses ] Pages and His Comments.
            // To Make Read Method On Videos and Load The Data On Table By Ajax
            Route::get('courses/rows', 'CourseController@rows')->name('courses.rows');
            // To Make Create , Update, Delete Methods On Courses
            Route::resource('courses', 'CourseController');
            // To Make Multi Delete Courses
            Route::post('courses/multidelete', 'CourseController@multidelete')->name('courses.multidelete');
            // To Load The Comments On Edit Page
            Route::get('coursesComments', 'CommentCourseController@index')->name('coursesComments');
            // To Add New Comment
            Route::get('coursesComments/save', 'CommentCourseController@save_comment')->name('coursesComments.save');
            // To Delete The Comment
            Route::get('coursesComments/delete', 'CommentCourseController@delete')->name('coursesComments.delete');
            // End [ Courses ] Pages

            // CRUD To [ Videos ] Pages and His Comments.
            // To Make Read Method On Videos and Load The Data On Table By Ajax
            Route::get('videos/rows', 'VideoController@rows')->name('videos.rows');
            // To Make Create , Update, Delete Methods On Videos
            Route::resource('videos', 'VideoController');
            // To Make Multi Delete Videos
            Route::post('videos/multidelete', 'VideoController@multidelete')->name('videos.multidelete');
            // To Load The Comments On Edit Page
            Route::get('videosComments', 'CommentVideoController@index')->name('videosComments');
            // To Add New Comment
            Route::get('videosComments/save', 'CommentVideoController@save_comment')->name('videosComments.save');
            // To Delete The Comment
            Route::get('videosComments/delete', 'CommentVideoController@delete')->name('videosComments.delete');
            // End [ Videos ] Pages

            // CRUD To [ Posts ] Pages and His Comments.
            // To Make Read Method On posts and Load The Data On Table By Ajax
            Route::get('posts/rows', 'PostController@rows')->name('posts.rows');
            // To Make Create , Update, Delete Methods On Posts
            Route::resource('posts', 'PostController');
            // To Make Multi Delete Posts
            Route::post('posts/multidelete', 'PostController@multidelete')->name('posts.multidelete');
            // To Load The Comments On Edit Page
            Route::get('postsComments', 'CommentPostController@index')->name('postsComments');
            // To Add New Comment
            Route::get('postsComments/save', 'CommentPostController@save_comment')->name('postsComments.save');
            // To Delete The Comment
            Route::get('postsComments/delete', 'CommentPostController@delete')->name('postsComments.delete');
            // End [ Posts ] Pages

            // CRUD To [ Slides ] Pages and His Comments.
            // To Make Read Method On Slides and Load The Data On Table By Ajax
            Route::get('slides/rows', 'SlidesController@rows')->name('slides.rows');
            // To Make Create , Update, Delete Methods On Slides
            Route::resource('slides', 'SlidesController');
            // To Make Multi Delete Slides
            Route::post('slides/multidelete', 'SlidesController@multidelete')->name('slides.multidelete');

            // Delete The Image and His Info When Edite The Sliders By Ajax
            Route::get('images/delete', 'SlideImagesController@delete');
            // End [ Slides ] Pages

        }); //end of dashboard routes
    }
);


Route::get('/', function () {
    return redirect()->route('login');
})->name('/');
