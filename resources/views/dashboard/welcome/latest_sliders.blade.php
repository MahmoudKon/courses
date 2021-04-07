<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Sliders</h3>
        <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="" class="badge bg-fuchsia" data-original-title="{{ $sliders->count() }} New Sliders">
                {{ $sliders->count() }} New Sliders
            </span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        <div class="table-responsive">
            @if($sliders->count() > 0)
            <table class="table m-0">
                <thead>
                    <tr>
                        <th width="70%">@lang('site.name')</th>
                        <th>@lang('site.image_count')</th>
                        <th width="15%">@lang('site.date')</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($sliders as $slide)
                    <tr>
                        <td>
                            <a href="{{ route('dashboard.slides.index') }}?search={{ str_replace(' ', '-', $slide->name) }}">
                                {{ $slide->name }}
                            </a>
                        </td>
                        <td>{{ $slide->images->count() }}</td>
                        <td>
                            {{ date('l j F Y', strtotime($slide->created_at)) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <p class="alert alert-danger"> There are no Sliders to display during this period </p>
            @endif
        </div>
    </div>
    <!-- /.box-body -->
    @if($sliders->count() > 0)
    <div class="box-footer text-center">
        <a href="{{ route('dashboard.slides.index') }}" class="uppercase">View All slides</a>
    </div>
    <!-- /.box-footer -->
    @endif
</div>
