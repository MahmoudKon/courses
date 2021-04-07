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
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">{{ __('Login') }} <a href="{{ route('user.create') }}" class="pull-right">Register</a> </div>

                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('user.login') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="row">
                            <div class="col-md-12">
                                <!-- Email Input -->
                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control" value="{{ old('email') ?? 'super_admin@app.com' }}" placeholder="@lang('site.email')">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('email') : '' }}</div>
                                </div>

                                <!-- Password Input -->
                                <div class="form-group has-feedback">
                                    <input type="password" name="password" class="form-control" value='123' placeholder="@lang('site.password')">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    <div>{{ $errors->all() ? $errors->first('password') : '' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
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
