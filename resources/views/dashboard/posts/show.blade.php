@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

  <section class="content-header">

    <h1>@lang('site.' . Request::segment('3'))</h1>

    <ol class="breadcrumb">
      <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
      <li><a href="{{ route('dashboard.' . Request::segment('3') . '.index') }}"> @lang('site.' . Request::segment('3'))</a></li>
      <li class="active">@lang('site.show')</li>
    </ol>
  </section>

  <section class="content">

    <div class="box box-primary">

      <div class="box-header">
        <h3 class="box-title">@lang('site.show')</h3>
      </div><!-- end of box header -->

      <div class="box-body">
        <div class="form-group">
          <a href="{{ URL::previous() }}" class="btn btn-success"> <i class="fa fa-arrow-left"></i> @lang('site.back')</a>
          <a href="{{ route('dashboard.'.Request::segment('3').'.edit', $post) }}" class="btn btn-info pull-right"> <i class="fa fa-edit"></i> @lang('site.edit')</a>
        </div>

        <div class="row">
          <div class="col-md-7">
            <!-- User Input -->
            <div class="form-group">
              <label>User Name</label>
              <input type="text" class="form-control" value="{{ $post->user->name }}" readonly>
            </div>

            <!-- Title Input -->
            <div class="form-group">
              <label>Title</label>
              <textarea class="form-control" readonly>{{ $post->title }}</textarea>
            </div>

            <!-- Description Input -->
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" readonly>{!! $post->description !!}</textarea>
            </div>

            <!-- Catgeory Input -->
            <div class="form-group">
              <label>Catgeory Name</label>
              <input type="text" class="form-control" value="{{ $post->category->name }}" readonly>
            </div>

            <!-- Tags Input -->
            <div class="form-group">
              @php $tags = explode(",",$post->tags) @endphp
              <label>Tags</label>
              <input type="text" class="form-control" value="@foreach($tags as $tag) {{ $tag }} | @endforeach" readonly>
            </div>
          </div>

          <div class="col-md-5">
            <!-- Show Image -->
            <div class="form-group has-feedback">
              <img src="{{ $post->image_path }}" class="img-thumbnail image-preview" style="width: 100%; height: 255px">
            </div>
          </div>

        </div>
        @if(count($comments) > 0)
          @include('dashboard.layouts.comments', ['noForm'=>'none'])
        @endif

      </div><!-- end of box body -->

    </div><!-- end of box -->

  </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
