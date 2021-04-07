<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Intervention\Image\Facades\Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user             = $data->except(['password', 'password_confirmation', 'image']);
        $user['password'] = bcrypt($data['password']);
        if($data['image'])
        {
            Image::make($data['image'])
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/clients_images/' . $data['image']->hashName()));
            $user['image'] = $data['image']->hashName();
        }else{
            $user['image'] = 'default.png';
        }
        return User::create($user);
    }
}
