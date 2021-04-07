<?php

namespace App\Http\Controllers\Dashboard;

use App\CommentPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentPostController extends Controller
{
    public function index(Request $request)
    {
        $comments = CommentPost::where('post_id', '=', $request->id)->get();
        return view('dashboard.layouts.comment', compact('comments'));
    } // this method do show all comments for a specific post

    public function save_comment(Request $request)
    {
        $comment = CommentPost::create([
            'comment'   => $request->comment,
            'user_id'   => $request->user,
            'post_id'  => $request->model,
        ]);
        $comments = CommentPost::where('post_id', '=', $request->model)->get();
        return view('dashboard.layouts.comment', compact('comments'));
    } // this method do save new comment for a specific post

    public function delete(Request $request)
    {
        CommentPost::findOrFail($request->id)->delete();
    } // this method do delete the comment for a specific post
}
