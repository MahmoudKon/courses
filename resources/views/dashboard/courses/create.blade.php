@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.courses')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.courses.index') }}"> @lang('site.courses')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form action="{{ route('dashboard.courses.store') }}" method="post" enctype="multipart/form-data">

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
                                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                                </div>

                                <!-- Image Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control image" placeholder="@lang('site.image')">
                                    <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('image') : '' }}</div>
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

                                <!-- Status Select -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.status')</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Unactive" selected>Unactive</option>
                                    </select>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('status') : '' }}</div>
                                </div>
                            </div>

                            <!-- Show Image -->
                            <div class="col-md-5">
                                <!-- Show Image -->
                                <div class="form-group has-feedback">
                                    <img src="{{ asset('uploads/courses_images/default.png') }}" class="img-thumbnail image-preview" style="width: 100%; max-height: 349px">
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
