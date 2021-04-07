<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Videos</h3>

        <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="" class="badge bg-red" data-original-title="{{ $videos->count() }} New Videos">
                {{ $videos->count() }} New Videos
            </span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
        @if($videos->count() > 0)
        <div class="table-responsive">
            <table class="table m-0">
                <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td>
                            <img src="{{ $video->course->image_path }}" class="img-thumbnail">
                        </td>
                        <td width='65%'>
                            <a href="{{ route('dashboard.users.index') }}?search={{ str_replace(' ', '-', $video->course->user->name) }}">
                                <span class="users-list-name">
                                    {{ $video->course->user->name }}
                                    <span class="users-list-date pull-right">{{ date('l j F Y', strtotime($video->created_at)) }}</span>
                                </span>
                            </a>

                            <span class="users-list-date">Category: {{ $video->category->name }} </span>

                            <a href="{{ route('dashboard.videos.index') }}?search={{ str_replace(' ', '-', $video->title) }}" class="users-list-name">
                                {!! strlen($video->title) > 50 ? substr($video->title, 0, 50) . ' ...' : $video->title !!}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="alert alert-danger"> There are no Videos to display during this period </p>
        @endif
    </div>
    <!-- /.box-body -->
    @if($videos->count() > 0)
    <div class="box-footer text-center">
        <a href="{{ route('dashboard.videos.index') }}" class="uppercase">View All Videos</a>
    </div>
    @endif
    <!-- /.box-footer -->
</div>
