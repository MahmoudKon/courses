<div class="row courses_row mt-0">

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <!-- Course -->
            @include('ui.posts_page.post')
        @endforeach
    @else
    <div class="col-lg-12 course_col">
        <h4 class="alert alert-warning text-center">No Data</h4>
    </div>
    @endif

    <div class="col-lg-12"> {{ $posts->links() }} </div>
</div>
