<div class="box-header with-border">
  <h3 class="box-title" style="margin-bottom: 15px">@lang('site.' . Request::segment(3)) : {{ $count }}</h3>

  <div class="row">

    <!-- Input Text To Seach -->
    <div class="col-md-3">
      <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ str_replace('-', ' ', request()->search) }}">
    </div>
    <!-- End -->

    <!-- Select The Name of Columns -->
    <div class="col-md-2">
      <div class="form-group">
        <select class="form-control columns-names" name="columns-names">
          @foreach($columns as $column)
          <option value="{{ $column }}">{{ ucfirst($column) }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <!-- End -->

    <!-- Select The Number of Paginate -->
    <div class="col-md-2">
      <div class="form-group mb-3">
        <select class="form-control paginateNumber" name="paginateNumber">
          <option value="5">5 Records</option>
          <option value="10">10 Records</option>
          <option value="25">25 Records</option>
          <option value="50">50 Records</option>
          <option value="100">100 Records</option>
        </select>
      </div>
    </div>
    <!-- End -->

    <div class="col-md-2"></div>

    <!-- Buttons To Creat New Record Or Multi Delete -->
    <div class="col-md-3">
      <div class="pull-right">
        <!-- Delete Button -->
        @if (auth()->user()->hasPermission('delete_' . Request::segment(3)))
        <form action="{{ route('dashboard.' . Request::segment(3) . '.multidelete') }}" method="post" style="display: inline-block">
          {{ csrf_field() }}
          <input type="hidden" name="ids" id="multi-ID" value="">
          <button class="btn btn-danger btn-sm" id="multi-delete"><i class="fa fa-trash"></i> @lang('site.multi-delete')</button>
        </form><!-- end of form -->
        @else
        <a href="#" class="btn btn-danger btn-sm disabled" style="display: block; margin-top: 10px"><i class="fa fa-trash"></i> @lang('site.multi-delete')</a>
        @endif

        @if (auth()->user()->hasPermission('create_' . Request::segment(3)))
        <a href="{{ route('dashboard.' . Request::segment(3) . '.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> @lang('site.add')</a>
        @else
        <a href="#" class="btn btn-primary btn-sm disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
        @endif
      </div>
    </div>

  </div>
</div><!-- end of box header -->