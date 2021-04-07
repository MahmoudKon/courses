<div class="col-md-6 course_col">
    <div class="course">
        @if(auth()->user() != null)
            @if(auth()->user()->id == $post->user_id)
            <div class="btn-group btns">
                <button class="btn btn-dark btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 1px 3px 0px 0px;">

                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item editPost" data-id="{{ $post->id }}">Edit</a>
                    <a href="#" class="dropdown-item deletePost" data-id="{{ $post->id }}">Delete</a>
                </div>
            </div>
            @endif
        @endif

        @if($post->image != null)
            <div class="course_image">
                <img src="{{ $post->image_path }}" width='100%' alt="">
            </div>
        @endif

        <div class="course_body">
            <h3 class="course_title"><a href="{{ route('posts.single', $post->id) }}">
                {!! strlen($post->title) > 33 ? substr($post->title, 0, 33) . '...' : $post->title !!}
            </a></h3>
            <div class="course_teacher">{{ $post->user->name }} <span class="pull-right">{{ $post->created_at->diffForHumans() }}</span></div>
            <div class="course_text">
                {!! strlen($post->description) > 40 ? substr($post->description, 0, 40 ) . ' ...' : $post->description !!}
            </div>
        </div>

        <div class="course_footer">
            <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
                <div class="course_info">
                    <i class="fa fa-tag" aria-hidden="true"></i>
                </div>
                <div class="course_info tags-list">
                    @php $tags = explode(",",$post->tags) @endphp
                    @foreach($tags as $tag)
                    <a href="/posts?tag={{ $tag }}" data-tag="{{ $tag }}" class="btn btn-outline-dark btn-sm tag_name">{{ $tag }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <a href="{{ route('posts.single', $post->id) }}" class="btn btn-dark d-block">Read More</a>
    </div>
</div>
