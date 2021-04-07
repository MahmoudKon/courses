<div class="box box-warning direct-chat direct-chat-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Latest Posts</h3>
        <div class="box-tools pull-right">
            <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="{{ $posts->count() }} Posts">
                {{ $posts->count() }} New Posts
            </span>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.box-header -->

    <div class="box-body">
        <!-- Conversations are loaded here -->
        @if($posts->count() > 0)
        <div class="direct-chat-messages">
            
            <!-- Message. Default to the left -->
            @foreach($posts as $index=>$post)
                <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <a href="{{ route('dashboard.users.index') }}?search={{ str_replace(' ', '-',$post->user->name) }}">
                            <span class="direct-chat-name">{{ $post->user->name }}</span>
                        </a>
                        <span class="direct-chat-timestamp pull-right">{{ date('l j F Y', strtotime($post->created_at)) }}</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="{{ $post->user->image_path }}" alt="post user image">
                    <!-- /.direct-chat-img -->
                    <a href="{{ route('dashboard.posts.index') }}?search={{ str_replace(' ', '-', $post->description) }}">
                        <div class="direct-chat-text">
                            {!! strlen($post->description) > 120 ? substr($post->description, 0, 120) . ' ...' : $post->description !!}
                        </div>
                    </a>
                    <!-- /.direct-chat-text -->
                </div>
            @endforeach
            <!-- /.direct-chat-msg -->
        </div>
        @else
        <p class="alert alert-danger mt-1"> There are no Posts to display during this period </p>
        @endif
        <!--/.direct-chat-messages-->
    </div>
    @if($posts->count() > 0)
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="{{ route('dashboard.posts.index') }}">View All Posts</a>
    </div>
    <!-- /.box-footer -->
    @endif
</div>
