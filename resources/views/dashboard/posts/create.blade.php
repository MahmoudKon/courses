@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.posts')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.posts.index') }}"> @lang('site.posts')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form action="{{ route('dashboard.posts.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <!-- User Input -->
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <!-- Title && Description Input -->
                        <div class="row">
                            <!-- Title Input -->
                            <div class="col-lg-12">
                                <!-- Title Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.title')</label>
                                    <textarea name="title" class="form-control ckeditor">{{ old('title') }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                                </div>
                            </div>

                            <!-- Description Textarea -->
                            <div class="col-lg-12">
                                <!-- Description Textarea -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.description')</label>
                                    <textarea name="description" class="form-control ckeditor">{{ old('description') }}</textarea>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Image & Tags Input & Categories Select -->
                        <div class="row">
                            <!-- Image Input & Image View -->
                            <div class="col-md-6">
                                <!-- Image Input -->
                                <div class="form-group has-feedback">
                                    <label for="status">@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control image" placeholder="@lang('site.image')">
                                    <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first('image') : '' }}</div>
                                </div>

                                <!-- Show Image -->
                                <div class="form-group has-feedback">
                                    <img src="{{ asset('uploads/posts/default.png') }}" style="width: 100%; max-height: 323px" class="img-thumbnail image-preview">
                                </div>
                            </div>

                            <!-- Categories Select & Tags Input -->
                            <div class="col-md-6">
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
