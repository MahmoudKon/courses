<div class="box box-success direct-chat direct-chat-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Courses</h3>
        <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="" class="badge bg-green" data-original-title="{{ $courses->count() }} New Courses">
                {{ $courses->count() }} New Courses
            </span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->

    <div class="box-body p-0">
        <div class="table-responsive">
            @if($courses->count() > 0)
            <table class="table m-0">
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>
                            <img src="{{ $course->image_path }}" class="img-thumbnail show-image-course">
                        </td>
                        <td width='65%'>
                            <a href="{{ route('dashboard.users.index') }}?search={{ str_replace(' ', '-', $course->user->name) }}">
                                <span class="users-list-name">
                                    {{ $course->user->name }}
                                    <span class="users-list-date pull-right">{{ date('l j F Y', strtotime($course->created_at)) }}</span>
                                </span>
                            </a>

                            <span class="users-list-date">Category: {{ $course->category->name }} </span>

                            <a href="{{ route('dashboard.courses.index') }}?search={{ str_replace(' ', '-', $course->title) }}" class="users-list-name title">
                                {!! strlen($course->title) > 50 ? substr($course->title, 0, 50) . ' ...' : $course->title !!}
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                @else
                <p class="alert alert-danger"> There are no Courses to display during this period </p>
                @endif
            </table>
        </div>
    </div>
    @if($posts->count() > 0)
    <!-- /.card-body -->
    <div class="box-footer text-center">
        <a href="{{ route('dashboard.courses.index') }}">View All Courses</a>
    </div>
    <!-- /.box-footer -->
    @endif
</div>
