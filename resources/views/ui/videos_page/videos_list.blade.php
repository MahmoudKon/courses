<div class="row courses_row">

    @if($videos->count() > 0)
    @foreach($videos as $video)
    <!-- Course -->
    <div class="col-lg-6 course_col">
        @include('ui.layouts.video')
    </div>
    @endforeach
    @else
    <div class="col-lg-12 course_col">
        <h4 class="alert alert-warning text-center">No Data</h4>
    </div>
    @endif

    <div class="col-md-12">{{ $videos->appends(request()->query())->links() }}</div>
</div>
