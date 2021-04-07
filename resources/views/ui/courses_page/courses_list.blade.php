<div class="row courses_row">

    @if($courses->count() > 0)
    @foreach($courses as $course)
    <!-- Course -->
    <div class="col-lg-6 course_col">
        @include('ui.layouts.course')
    </div>
    @endforeach
    @else
    <div class="col-lg-12 course_col">
        <h4 class="alert alert-warning text-center">No Data</h4>
    </div>
    @endif

    <div class="col-lg-12"> {{ $courses->appends(request()->query())->links() }} </div>
</div>
