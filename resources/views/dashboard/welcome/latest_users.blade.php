<div class="box box-primary direct-chat direct-chat-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Members</h3>
        <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="" class="badge bg-aqua" data-original-title="{{ $users->count() }} New Members">
                {{ $users->count() }} New Members
            </span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->

    <div class="box-body p-0">
        <!-- User List -->
        @if($users->count() > 0)
        <ul class="users-list clearfix">
            @foreach($users as $user)
                <li style="height: 155px">
                    <img src="{{ $user->image_path }}" alt="User Image">
                    <a class="users-list-name" href="{{ route('dashboard.users.index') }}">
                    {{ request()->session()->put('search', str_replace(' ', '-', $user->name)) }}
                        {{ $user->name }}
                    </a>
                    <span class="users-list-date">{{ date('l j F Y', strtotime($user->created_at)) }}</span>
                </li>
            @endforeach
        </ul>
        @else
        <p class="alert alert-danger"> There are no Users to display during this period </p>
        @endif
        <!--/.User List-->
    </div>
    @if($users->count() > 0)
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="{{ route('dashboard.users.index') }}">View All Users</a>
    </div>
    <!-- /.box-footer -->
    @endif
</div>
