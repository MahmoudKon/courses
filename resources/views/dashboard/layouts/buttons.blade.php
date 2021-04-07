@if (auth()->user()->hasPermission('update_' . Request::segment(3)))
<a href="{{ route('dashboard.'.Request::segment(3).'.edit', $row->id) }}" class="btn btn-info update btn-sm" style="width: 100%"><i class="fa fa-edit"></i> @lang('site.edit')</a>
@endif

@if (auth()->user()->hasPermission('delete_' . Request::segment(3)))
<form action="{{ route('dashboard.'.Request::segment(3).'.destroy', $row->id) }}" method="post" style="margin: 2px 0;">
  {{ csrf_field() }}
  {{ method_field('delete') }}
  <button type="submit" style="width: 100%" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
</form><!-- end of form -->
@endif

<a href="{{ route('dashboard.'.Request::segment(3).'.show', $row->id) }}" class="btn btn-success btn-sm" style="width: 100%"><i class="fa fa-eye"></i> @lang('site.show')</a>