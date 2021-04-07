<li>
    <div class="comment_item d-flex flex-row align-items-start jutify-content-start">
        <div class="comment_image">
            <div><img src="{{ $comment->user->image_path }}" alt=""></div>
        </div>
        <div class="comment_content">
            <div class="comment_title_container d-flex flex-row align-items-center justify-content-start">
                <div class="comment_author"><a href="#">{{ $comment->user->name }}</a></div>
                <div class="comment_rating">
                    <div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div>
                </div>
                <div class="comment_time ml-auto">{{ $comment->created_at->diffForHumans() }}</div>
            </div>
            <div class="comment_text">
                <p>{{ $comment->comment }}</p>
            </div>
            <div class="comment_extras d-flex flex-row align-items-center justify-content-start">
                <div class="comment_extra comment_likes"><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>108</span></a></div>
                <div class="comment_extra comment_reply"><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Reply</span></a></div>
            </div>
        </div>
    </div>
</li>
