@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.courses')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.courses.index') }}"> @lang('site.courses')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form action="{{ route('dashboard.videos.update', $video->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="row">
                            <!-- Title Input & Image Input & Tags Input & Categories Select & Status Select -->
                            <div class="col-md-7">
                                <!-- title Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.title')</label>
                                    <input type="text" name="title" class="form-control" placeholder="@lang('site.title')" value="{{ $video->title }}">
                                    <span class="glyphicon glyphicon-header form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                                </div>

                                <!-- Tags Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.tags')</label>
                                    <input type="text" name="tags" id="tags" class="form-control image" placeholder="@lang('site.tags')" value="{{ $video->tags }}">
                                    <span class="glyphicon glyphicon-tags form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('tags') : '' }}</div>
                                </div>

                                <!-- Categories Select -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.category')</label>
                                    <select name="category_id" id="category" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $video->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('category_id') : '' }}</div>
                                </div>

                                <!-- courses Select -->
                                <div class="form-group has-feedback">
                                    <label for="courses">@lang('site.courses_list')</label>
                                    <select name="course_id" id="courses" class="form-control">
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ $video->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('courses') : '' }}</div>
                                </div>
                            </div>

                            <!-- Show Video -->
                            <div class="col-md-5">
                                <!-- Show Video -->
                                <div class="form-group has-feedback">
                                    <video style="width: 100%; max-height: 349px" controls class="img-bordered-sm">
                                        <source src="{{ $video->video_path }}" type="">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>

                            <!-- Description Textarea -->
                            <div class="col-md-12">
                                <!-- Show Image -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.description')</label>
                                    <textarea name="description" class="form-control ckeditor">{{ $video->description }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

                @if($comments->count() > 0)
                    @include('dashboard.layouts.comments')
                @endif

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
