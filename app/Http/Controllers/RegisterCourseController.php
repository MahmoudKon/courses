<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use App\Register;
use App\User;
use Illuminate\Http\Request;

class RegisterCourseController extends Controller
{
    public function register(Request $request)
    {
        if($request->ajax()) {
            $request->validate([
                'course_id' => 'required|exists:courses,id',
                'email' => 'required|email|exists:users,email',
                'phone' => 'required|min:10|max:15'
            ]);

            $user = User::where('email', $request->email)->first();

            $check = Register::where('user_id', $user->id)->where('course_id', $request->course_id)->get();
            if($check->count() > 0) {
                $data = ['code' => false, 'message' => 'This email is already registered!'];
                return $data;
            }

            $register = Register::create(['user_id' => $user->id, 'course_id' => $request->course_id, 'phone' => $request->phone]);
            if(!$register) {
                $data = ['code' => false, 'message' => 'You cannot register now!'];
                return $data;
            }

            $data = ['code' => true, 'message' => 'Successfully Registered!'];
            return $data;
        }
        $data = ['code' => false, 'message' => 'Something Is Wrong!'];
        return $data;
    }
}
