<?php

namespace App\Http\Controllers\Dashboard;

use App\CommentCourse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentCourseController extends Controller
{
    public function index(Request $request)
    {
        $comments = CommentCourse::where('course_id', '=', $request->id)->get();
        return view('dashboard.layouts.comment', compact('comments'));
    } // this method do show all comments for a specific course

    public function save_comment(Request $request)
    {
        $comment = CommentCourse::create([
            'comment'   => $request->comment,
            'user_id'   => $request->user,
            'course_id' => $request->model,
        ]);
        $comments = CommentCourse::where('course_id', '=', $request->model)->get();
        return view('dashboard.layouts.comment', compact('comments'));
    } // this method do save new comment for a specific course

    public function delete(Request $request)
    {
        CommentCourse::findOrFail($request->id)->delete();
    } // this method do delete the comment for a specific course
}
