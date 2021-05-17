<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function create()
    {
        return view('ui.login.register');
    } //end of create

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|min:5',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|confirmed',
            'address'       => 'required|min:5',
            'phone'         => 'required|min:15',
            'birthday'      => 'required',
            'image'         => 'image|mimes:jpeg,jpg,png,gif',
            'gender'        => 'required',
            'status'        => 'required',
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);
        $request_data['role'] = 'user';

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('uploads/users_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        } //end of if
        $user = User::create($request_data);
        $user->attachRole($request_data['role']);
        $user->syncPermissions($request->permissions);

        auth()->login($user);
        return redirect()->to('/home');
    } //end of store

    public function signin()
    {
        return view('ui.login.login');
    } //end of create

    public function login(Request $request)
    {
        $request->validate([
            'email'         => 'required',
            'password'      => 'required',
        ]);

        $request_data['email'] = $request->email;
        $request_data['password'] = $request->password;

        if (Auth::attempt($request_data)) {
            return redirect()->route('home');
        } else {
            return back()->with('error', 'Wrong Login Details');
        }
    } //end of store

    public function logout()
    {
        auth()->logout();

        return redirect()->back();
    }
}//end of controller
