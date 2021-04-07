<!-- Comments -->
<div class="comments_container">
    <ul class="comments_list">
        @foreach($course->comments as $comment)
            @include('ui.single_course_page.comment')
        @endforeach
    </ul>
    <div class="add_comment_container">
        <div class="add_comment_title">Write a comment</div>
        @if(auth()->user() !== null)
        <form action="#" class="comment_form" id="post_comment">
            <div>
                @csrf
                <input type="hidden" name="user" value="{{ auth()->user()->id !== null ? auth()->user()->id : '' }}">
                <input type="hidden" name="course" value="{{ $course->id }}">
                <div class="form-group">
                    <label for="comment">Write a comment</label>
                    <textarea class="form-control" id="comment" required="required" name="comment"></textarea>
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-info">submit</button>
            </div>
        </form>
        @else
        <div class="add_comment_text">You must be <a href="#">logged</a> in to post a comment.</div>
        @endif
    </div>
</div>
