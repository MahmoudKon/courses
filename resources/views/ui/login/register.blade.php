@extends('layouts.app')

@if(isset(Auth::user()->email))
    <script>window.location = "/home";</script>
@endif

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/about.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/about_responsive.css') }}">
@endpush

@section('content')
@include('ui.layouts.menu')
<div class="container mt-3 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }} <a href="{{ route('user.signin') }}" class="pull-right">Login</a> </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="row">
                            <!-- Name Input -->
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <input type="text" name="name" class="form-control" placeholder="@lang('site.name')">
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('name') : '' }}</div>
                                </div>

                                <!-- Password Input -->
                                <div class="form-group has-feedback">
                                    <input type="password" name="password" class="form-control" placeholder="@lang('site.password')">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('password') : '' }}</div>
                                </div>

                                <!-- Address Input -->
                                <div class="form-group has-feedback">
                                    <input type="text" name="address" class="form-control" placeholder="@lang('site.address')">
                                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('address') : '' }}</div>
                                </div>

                                <!-- Birthday Input -->
                                <div class="form-group has-feedback">
                                    <label for="birthday">@lang('site.birthday')</label>
                                    <input type="date" id='birthday' name="birthday" class="form-control" placeholder="@lang('site.birthday')" style="line-height: 17px;">
                                    <span class="glyphicon glyphicon-heart form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('birthday') : '' }}</div>
                                </div>

                                <!-- Gender Input -->
                                <div class="form-group has-feedback">
                                    <label for="gender">@lang('site.gender')</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div>{{ $errors->all() ? $errors->first('gender') : '' }}</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Email Input -->
                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control" placeholder="@lang('site.email')">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('email') : '' }}</div>
                                </div>

                                <!-- Confirmed Password Input -->
                                <div class="form-group has-feedback">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('site.password_confirmation')">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('password_confirmation') : '' }}</div>
                                </div>

                                <!-- Phone Input -->
                                <div class="form-group has-feedback">
                                    <input type="text" name="phone" class="form-control" placeholder="@lang('site.phone')">
                                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('phone') : '' }}</div>
                                </div>

                                <!-- Image Input -->
                                <div class="form-group has-feedback">
                                    <label for="avatar">@lang('site.avatar')</label>
                                    <input type="file" id="avatar" name="image" class="form-control form-control-sm image" placeholder="@lang('site.image')">
                                    <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('image') : '' }}</div>
                                </div>

                                <!-- Status Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.status')</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Single">Single</option>
                                        <option value="In Relation">In Relation</option>
                                        <option value="Married">Married</option>
                                    </select>
                                    <div>{{ $errors->all() ? $errors->first('status') : '' }}</div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <!-- Show Image -->
                                <div class="form-group has-feedback">
                                    <img src="{{ asset('uploads/users_images/default.png') }}" class="img-thumbnail image-preview" style="width: 100%; height: 255px">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('dashboard_files/js/custom/image_preview.js') }}"></script>
@endpush
