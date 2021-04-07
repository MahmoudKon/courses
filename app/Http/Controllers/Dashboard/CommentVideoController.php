<?php

namespace App\Http\Controllers\Dashboard;

use App\CommentVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentVideoController extends Controller
{
    public function index(Request $request)
    {
        $comments = CommentVideo::where('video_id', '=', $request->id)->get();
        return view('dashboard.layouts.comment', compact('comments'));
    } // this method do show all comments for a specific video

    public function save_comment(Request $request)
    {
        $comment = CommentVideo::create([
            'comment'   => $request->comment,
            'user_id'   => $request->user,
            'video_id'  => $request->model,
        ]);
        $comments = CommentVideo::where('video_id', '=', $request->model)->get();
        return view('dashboard.layouts.comment', compact('comments'));
    } // this method do save new comment for a specific video

    public function delete(Request $request)
    {
        CommentVideo::findOrFail($request->id)->delete();
    } // this method do delete the comment for a specific video
}
