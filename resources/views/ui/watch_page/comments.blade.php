<!-- Comments -->
<div class="comments_container mt-2">

    <div class="add_comment_container">
        <div class="add_comment_title">Write a comment</div>
        @if(auth()->user() !== null)
        <form action="#" class="mt-2 mb-2" id="video_comment">
            <div>
                @csrf
                <input type="hidden" name="user" value="{{ auth()->user()->id !== null ? auth()->user()->id : '' }}">
                <input type="hidden" name="video" value="{{ $video->id }}">
                <textarea class="comment_input mb-2" required="required" name="comment"></textarea>
            </div>
            <a type="submit" href="#" class="btn btn-info">submit</a>
        </form>
        @else
        <div class="add_comment_text">You must be <a href="{{ route('user.login') }}">logged</a> in to post a comment.</div>
        @endif
    </div>

    <div class="comments_title"><span>{{ $video->comments->count() }}</span> Comments</div>
    <ul class="comments_list">
        @foreach($video->comments as $comment)
            @include('ui.watch_page.comment')
        @endforeach
    </ul>
</div>

