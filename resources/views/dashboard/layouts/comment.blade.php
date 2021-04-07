@foreach($comments as $index=>$comment)
<div class="direct-chat-msg {{ $index % 2 == 0 ? '' : 'right' }}">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name {{ $index % 2 == 0 ? 'pull-left' : 'pull-right' }}">{{ $comment->user->name }}</span>
        <span class="direct-chat-timestamp {{ $index % 2 == 0 ? 'pull-right' : 'pull-left' }}">{{ $comment->created_at->diffForHumans() }}</span>
    </div>
    <!-- /.direct-chat-info -->
    <img class="direct-chat-img" src="{{ $comment->user->image_path }}" alt="message user image">
    <!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        {{ $comment->comment }}
        @if(! isset($noForm))
        <button class="btn btn-sm deleteComment {{ $index % 2 == 0 ? 'btn-light' : 'btn-warning' }}" data-comment_id="{{ $comment->id }}">
            <i class="fa fa-times"></i>
        </button>
        @endif
    </div>
    <!-- /.direct-chat-text -->
</div>
@endforeach
