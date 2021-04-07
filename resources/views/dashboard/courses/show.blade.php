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
          <a href="{{ route('dashboard.'.Request::segment('3').'.edit', $course) }}" class="btn btn-info pull-right"> <i class="fa fa-edit"></i> @lang('site.edit')</a>
        </div>

        <div class="row">
          <div class="col-md-8">
            <!-- User Input -->
            <div class="form-group">
              <label>User Name</label>
              <div class="form-control" readonly> {{ $course->user->name }} </div>
            </div>

            <!-- Title Input -->
            <div class="form-group">
              <label>Title</label>
              <div class="form-control" readonly>{{ $course->title }}</div>
            </div>

            <!-- Description Input -->
            <div class="form-group">
              <label>Description</label>
              <div style="padding: 8px 15px; border: 1px solid #b9b9b9; background: #eee;">{!! $course->description !!}</div>
            </div>

            <!-- Catgeory Input -->
            <div class="form-group">
              <label>Catgeory Name</label>
              <div class="form-control" readonly> {{ $course->category->name }} </div>
            </div>

            <!-- Tags Input -->
            <div class="form-group">
              @php $tags = explode(",",$course->tags) @endphp
              <label>Tags</label>
              <div class="form-control" readonly>
                @foreach($tags as $tag) {{ $tag }} @if(!$loop->last) | @endif @endforeach
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <!-- Show Image -->
            <div class="form-group has-feedback">
              <img src="{{ $course->image_path }}" class="img-thumbnail image-preview" style="width: 100%; height: 255px">
            </div>
          </div>
        </div>

        @if(count($videos) > 0)
          <div class="box box-primary direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title">His Videos</h3>
                <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-yellow">{{ $course->videos->count() }}</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="row">
                @include('dashboard.layouts.list', ['rows'=>$videos, 'url'=>'videos'])
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        @endif

        @if(count($comments) > 0)
          @include('dashboard.layouts.comments', ['noForm'=>'none'])
        @endif
      </div><!-- end of box body -->

    </div><!-- end of box -->

  </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection

@push('js')
<script>
  $(function() {
    $('body').on('click', '.pagination a', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      var ele = $(this).closest('.row');
      $.ajax({
        url: url,
        method: 'get',
        success: function(data){
          ele.html(data);
        }
      });
    });
  });
</script>
@endpush
