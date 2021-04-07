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
          <a href="{{ route('dashboard.'.Request::segment('3').'.edit', $user) }}" class="btn btn-info pull-right"> <i class="fa fa-edit"></i> @lang('site.edit')</a>
        </div>

        <div class="row">
          <div class="col-md-8">
            <!-- Name Input -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control" value="Name : {{ $user->name }}" readonly>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <!-- Email Input -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control" value="Email : {{ $user->email }}" readonly>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <!-- Address Input -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control" value="Addres : {{ $user->address }}" readonly>
              <span class="glyphicon glyphicon-home form-control-feedback"></span>
            </div>

            <!-- Birthday Input -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control" value="Birthday : {{ $user->birthday }}" readonly>
              <span class="glyphicon glyphicon-heart form-control-feedback"></span>
            </div>

            <!-- Phone Input -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control" value="Phone : {{ $user->phone }}" readonly>
              <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>

            <!-- Status Input -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control" value="Status : {{ $user->status }}" readonly>
              <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>

            <!-- Gender Input -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control" value="Gender : {{ $user->gender }}" readonly>
              <span class="glyphicon glyphicon-phone form-control-feedback"></span>
            </div>

            <!-- Role Input -->
            <div class="form-group has-feedback">
              <input type="text" class="form-control" value="Role : {{ $user->role }}" readonly>
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

          </div>

          <div class="col-md-4">
            <!-- Show Image -->
            <div class="form-group has-feedback">
              <img src="{{ $user->image_path }}" class="img-thumbnail image-preview" style="width: 100%; height: 255px">
            </div>
          </div>

          @if(auth()->user()->id != $user->id)
            @if($user->role == 'admin')
            <div class="col-md-12">
              <!-- Permissions Input -->
              <div class="form-group">
                <input type="text" class="form-control" value="Permissions : @foreach($user->permissions as $per) {{ $per->display_name }} | @endforeach" readonly>
              </div>
            </div>
            @endif
          @endif
        </div>

        @if(count($courses) > 0)
          <div class="box box-primary direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title">His Courses</h3>
                <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-yellow">{{ $user->courses->count() }}</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="row" id="courses">
                @include('dashboard.layouts.list', ['rows'=>$courses, 'url'=>'courses'])
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        @endif

        @if(count($posts) > 0)
          <div class="box box-danger direct-chat direct-chat-warning">
            <div class="box-header with-border">
                <h3 class="box-title">His Posts</h3>
                <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="" class="badge bg-yellow">{{ $user->posts->count() }}</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <div class="row" id="posts">
                @include('dashboard.layouts.list', ['rows'=>$posts, 'url'=>'posts'])
              </div>
            </div>
            <!-- /.box-body -->
          </div>
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
        data:{'modal':ele.attr('id')},
        success: function(data){
          ele.html(data);
        }
      });
    });
  });
</script>
@endpush
