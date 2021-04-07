@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.videos')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.videos.index') }}"> @lang('site.videos')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form action="{{ route('dashboard.videos.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="row">
                            <!-- Title Input & Image Input & Tags Input & Categories Select & Status Select -->
                            <div class="col-md-7">
                                <!-- User Input -->
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                                <!-- title Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.title')</label>
                                    <input type="text" name="title" class="form-control" placeholder="@lang('site.title')" value="{{ old('title') }}">
                                    <span class="glyphicon glyphicon-header form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                                </div>

                                <!-- Video Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.video')</label>
                                    <input type="file" name="video" class="form-control image" placeholder="@lang('site.video')">
                                    <span class="glyphicon glyphicon-video form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('video') : '' }}</div>
                                </div>

                                <!-- Tags Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.tags')</label>
                                    <input type="text" name="tags" id="tags" class="form-control image" placeholder="@lang('site.tags')" value="{{ old('tags') }}">
                                    <span class="glyphicon glyphicon-tags form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('tags') : '' }}</div>
                                </div>

                                <!-- Categories Select -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.category')</label>
                                    <select name="category_id" id="category" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('category_id') : '' }}</div>
                                </div>

                                <!-- courses Select -->
                                <div class="form-group has-feedback">
                                    <label for="courses">@lang('site.courses_list')</label>
                                    <select name="course_id" id="courses" class="form-control">
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('courses') : '' }}</div>
                                </div>
                            </div>

                            <!-- Show Video -->
                            <div class="col-md-5">
                                <!-- Show Video -->
                                <div class="form-group has-feedback">
                                    <video style="width: 100%; max-height: 349px" controls class="image-preview img-bordered-sm">
                                        <source src="" type="">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>

                            <!-- Description Textarea -->
                            <div class="col-md-12">
                                <!-- Show Image -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.description')</label>
                                    <textarea name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
