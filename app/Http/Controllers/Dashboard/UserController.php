<?php

namespace App\Http\Controllers\Dashboard;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:read_users'])->only(['index']);
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only(['destroy']);
    } // end of constructor

    public function index(Request $request)
    {
        $count = User::where('role', '<>', 'super_admin')->count();
        return view('dashboard.users.index', compact('count'));
    } // end of index page

    public function rows(Request $request)
    {
        if ($request->ajax()) :
            $paginate = $request->paginateNumber;
            $rows = User::where('role', '<>', 'super_admin')->where(function ($q) use ($request) {
                return $q->when($request->search, function ($query) use ($request) {
                    return $query->where($request->columnName, 'like', '%' . str_replace('-', ' ', $request->search) . '%');
                });
            })->latest()->paginate($paginate);
            return view('dashboard.users.rows', compact('rows'));
        endif;
    } // end of rows all rows by ajax

    public function create()
    {
        return view('dashboard.users.create');
    } // end of create page

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:5',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|confirmed',
            'address'       => 'required|min:5',
            'phone'         => 'required|min:15',
            'birthday'      => 'required',
            'image'         => 'mimes:jpeg,jpg,png,gif',
            'gender'        => 'required',
            'status'        => 'required',
            'role'          => 'required',
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {
            Image::make($request->image)
                ->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } else {
            if ($request->gender == 'male') {
                $request_data['image'] = 'male.png';
            } else {
                $request_data['image'] = 'female.jpg';
            }
        } //end of if

        $user = User::create($request_data);
        $user->attachRole($request_data['role']);
        $user->syncPermissions($request->permissions);

        alert()->success(__('site.added_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.users.index');
    } // end of store new row

    public function show(User $user, Request $request)
    {
        if ($request->ajax() && $request->modal == 'courses') {
            $rows = Course::where('user_id', $user->id)->whereHas('videos')->paginate(3);
            $url  = 'courses';
            return view('dashboard.layouts.list', compact('rows', 'url'));
        } else if ($request->ajax() && $request->modal == 'posts') {
            $rows   = Post::where('user_id', $user->id)->paginate(3);
            $url  = 'posts';
            return view('dashboard.layouts.list', compact('rows', 'url'));
        }
        $courses = Course::where('user_id', $user->id)->whereHas('videos')->paginate(3);
        $posts   = Post::where('user_id', $user->id)->paginate(3);
        return view('dashboard.users.show', compact('user', 'courses', 'posts'));
    } // end of store new row

    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    } // end of edit page

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required|min:5',
            'email'         => 'required|email|' . Rule::unique("users")->ignore($user->id),
            'password'      => 'confirmed',
            'address'       => 'required|min:5',
            'phone'         => 'required|min:11',
            'birthday'      => 'required',
            'image'         => 'mimes:jpeg,jpg,png,gif',
            'gender'        => 'required',
            'status'        => 'required',
            'role'          => 'required',
        ]);

        $request_data = $request->except(['permissions', 'image', 'password', 'password_confirmation']);
        $roles = explode(' ', $request->role);

        if ($request->password) {
            dd($request->all());
            $request_data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->image != "male.png" && $user->image != "female.jpg") {
                Storage::disk('public_uploads')->delete('/users_images/' . $user->image);
            } //end of inner if
            Image::make($request->image)
                ->resize(100, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } else {
            if ($user->image != 'male.png' && $user->image != 'female.jpg') :
                $request_data['image'] = $user->image;
            endif;
        } //end of external if

        $user->update($request_data);
        $user->syncRoles($roles);
        $user->syncPermissions($request->permissions);

        alert()->success(__('site.updated_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.users.index');
    } // end of update the row

    public function destroy(Request $request, User $user)
    {
        if ($user->image != 'male.png' && $user->image != 'female.jpg') {
            Storage::disk('public_uploads')->delete('/users_images/' . $user->image);
        } //end of inner if
        $user->delete();
        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.users.index');
    } // end of destroy the single row

    public function multidelete(Request $request)
    {
        $ids = explode(',', $request->ids); // to make the all id is array
        $users = User::whereIn('id', $ids)->get(); // get the users by id to remove his image first and delete him

        foreach ($users as $user) :
            if ($user->image != 'male.png' && $user->image != 'female.jpg') :
                Storage::disk('public_uploads')->delete('/users_images/' . $user->image);
            endif; //end of inner if
            $user->delete();
        endforeach; //end foreach to remove the users image and delete him

        alert()->success(__('site.deleted_successfully'), __('site.good_job'));
        return redirect()->route('dashboard.users.index');
    } // end of destroy multi rows

} // end of controller
