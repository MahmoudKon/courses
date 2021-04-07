@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.posts')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
            <li><a href="{{ route('dashboard.posts.index') }}"> @lang('site.posts')</a></li>
            <li class="active">@lang('site.edit')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->

            <div class="box-body">

                <form action="{{ route('dashboard.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}

                    <!-- Description Input & Image View -->
                    <div class="row">
                        <!-- Title Input -->
                        <div class="col-md-12">
                            <!-- Title Input -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.title')</label>
                                <textarea name="title" class="form-control ckeditor">{{ old('title') }}{{ $post->title }}</textarea>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('title') : '' }}</div>
                            </div>
                        </div>

                        <!-- Description Textarea -->
                        <div class="col-md-12">
                            <!-- Description Textarea -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.description')</label>
                                <textarea name="description" class="form-control ckeditor">{{ $post->description }}</textarea>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('description') : '' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tags Input & Categories Select -->
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
                                <img src="{{ $post->image_path }}" style="width: 100%; max-height: 323px" class="img-thumbnail image-preview">
                            </div>
                        </div>

                        <!-- Tags Input && Categories Select -->
                        <div class="col-md-6">
                            <!-- Tags Input -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.tags')</label>
                                <input type="text" name="tags" id="tags" class="form-control image" placeholder="@lang('site.tags')" value="{{ $post->tags }}">
                                <span class="glyphicon glyphicon-tags form-control-feedback"></span>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('tags') : '' }}</div>
                            </div>

                            <!--  -->
                            <div class="form-group has-feedback">
                                <label for="status">@lang('site.category')</label>
                                <select name="category_id" id="category" class="form-control">
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->all() ? $errors->first('category_id') : '' }}</div>
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

@push('comments')
    <script src="{{ asset('dashboard_files/js/custom/comments.js') }}"></script>
@endpush
