<!-- Comments -->
<div class="comments_container">
    <div class="comments_title"><span>{{ $post->comments->count() }}</span> Comments</div>
    <ul class="comments_list">
        @foreach($post->comments as $comment)
            @include('ui.single_post_page.comment')
        @endforeach
    </ul>

    <div class="add_comment_container">
        <div class="add_comment_title">Write a comment</div>
        @if(auth()->user() !== null)
        <form action="#" class="comment_form" id="post_comment">
            <div>
                @csrf
                <input type="hidden" name="user" value="{{ auth()->user()->id !== null ? auth()->user()->id : '' }}">
                <input type="hidden" name="post" value="{{ $post->id }}">
                <textarea class="comment_input comment_textarea" required="required" name="comment"></textarea>
            </div>
            <div>
                <button type="submit" class="comment_button trans_200">submit</button>
            </div>
        </form>
        @else
        <div class="add_comment_text">You must be <a href="{{ route('user.login') }}">logged</a> in to post a comment.</div>
        @endif
    </div>
</div>

