@foreach($rows as $index => $row)
<div class="col-md-4">
  <div class="box box-success">

    <div class="box-header with-border">
      <span data-toggle="tooltip" title="" class="badge bg-fuchsia">
        {{ $url == 'courses' ? $row->videos->count() . ' Video' : $row->comments->count() . ' Comment'  }}
      </span>
      <div class="box-tools pull-right">
        <span>
          From {{ $row->created_at->diffForHumans() }}
        </span>
      </div>
    </div>
    <!-- /.box-header -->

    <div class="box-body">
      @if(! empty($row->image))
      <img src="{{ $row->image_path }}" width="100%">
      @elseif(! empty($row->video))
      <video width="100%">
        <source src="{{ $row->video_path }}">
      </video>
      @endif
      <h4 class="box-title">
        <a href="{{ route('dashboard.'.$url.'.show', $row) }}">
          {{ strlen($row->title) > 65 ? substr($row->title, 0, 65) . '...' : $row->title }}
        </a>
      </h4>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      @php $tags = explode(",",$row->tags) @endphp
      @foreach($tags as $tag)
      <span class="badge bg-purple" style="margin-bottom: 5px;">{{ $tag }}</span>
      @endforeach
    </div>
    <!-- /.box-footer -->

    @if(isset($user) && auth()->user()->id == $user->id && Request::segment(3) == 'users')
      <div class="box-footer">
        <a href="{{ route('dashboard.'.$url.'.show', $row) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> @lang('site.show')</a>
        <a href="{{ route('dashboard.'.$url.'.edit', $row) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
      </div>
    <!-- /.box-footer [btns] -->
    @endif

  </div>
</div>
@endforeach
<div class="col-md-12">
  {!! $rows !!}
</div>