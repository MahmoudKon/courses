<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\CommentPost;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_posts'])->only(['index']);
        $this->middleware(['permission:create_posts'])->only('create');
        $this->middleware(['permission:update_posts'])->only('edit');
        $this->middleware(['permission:delete_posts'])->only(['destroy']);
    } // end of constructor

    public function index(Request $request)
    {
        $categories = Category::get();
        $count = Post::count();
        return view('dashboard.posts.index', compact('count', 'categories'));
    } // end of index page

    public function rows(Request $request)
    {
        if($request->ajax()) :
            $paginate = $request->paginateNumber;
            $rows = Post::when($request->search, function ($q) use ($request) {
                return $q->Where($request->columnName, 'like', '%' . str_replace('-', ' ', $request->search) . '%');
            })->latest()->paginate($paginate);
            return view('dashboard.posts.rows', compact('rows'));
        endif;
    } // end of show all rows by ajax

    public function create()
    {
        $categories = Category::get();
        return view('dashboard.posts.create', compact('categories'));
    } // end of create page

    public function store(Request $request)
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

        Post::create($request_data);
        alert()->success(__('site.added_successfully'), __('site.good_job'));
        return redirect('dashboard/posts');

    } // end of store the new row

    public function show(Post $post)
    {
        $comments = CommentPost::where('post_id', $post->id)->get();
        return view('dashboard.posts.show', compact('post', 'comments'));
    } // end of show the row

    public function edit(Post $post)
    {
        $categories = Category::get();
        $comments = CommentPost::where('post_id', '=', $post->id)->get();
        return view('dashboard.posts.edit', compact('post', 'categories', 'comments'));
    } // end of edit page

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'description'   => 'required',
            'tags'          => 'required',
            'image'         => 'image|mimes:jpeg,jpg,png,gif',
            'category_id'   => 'required',
        ]);
        $request_data = $request->except('image');

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
        alert()->success(__('site.updated_successfully'), __('site.good_job'));
        return redirect('dashboard/posts');
    } // end of update the row

    public function destroy(Post $post)
    {
        if($post->image){
            Storage::disk('public_uploads')->delete('/posts/' . $post->image);
        }
        $post->delete();
        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect('dashboard/posts');
    }//end of destroy the single row or multi rows

    public function multidelete(Request $request)
    {
        $ids = explode(',', $request->ids); // to make the all id is array
        $posts = Post::whereIn('id', $ids)->get(); // get the rows by id to remove his image first and delete him

        foreach($posts as $post) :
            if($post->image){
                Storage::disk('public_uploads')->delete('/posts/' . $post->image);
            }
            $post->delete();
        endforeach; //end foreach to remove the row's image and delete him
        
        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.posts.index');
    } // end of destroy multi rows

} // end of controller
