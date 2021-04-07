<div class="course">
    <div class="course_image">
        <video width="100%">
            <source src="{{ $video->video_path }}">
        </video>
    </div>
    <div class="course_body">
        <h3 class="course_title">
            <a href="/courses/videos/watch?list={{ str_replace(' ', '-', $video->course->title) }}&index={{ $video->id }}">
            {!! strlen($video->title) > 25 ? substr($video->title, 0, 25) . ' ...' : $video->title !!}
            </a>
        </h3>
        <div class="course_teacher">{{ $video->course->user->name }}</div>
        <div class="course_text">
            <p>{!! strlen($video->description) > 40 ? substr($video->description, 0, 40) . ' ...' : $video->description !!}</p>
        </div>
    </div>
    <div class="course_footer">
        <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
            <div class="course_info">
                <i class="fa fa-tag" aria-hidden="true"></i>
            </div>
            <div class="course_info">
            @php $tags = explode(",",$video->tags) @endphp
            @foreach($tags as $tag)
                <a href="/courses/videos?tags={{ $tag }}" data-tag="{{ $tag }}" class="btn btn-outline-dark btn-sm tags_list">{{ $tag }}</a>
            @endforeach
            </div>
        </div>
    </div>
    <a href="/courses/videos/watch?list={{ str_replace(' ', '-', $video->course->title) }}&index={{ $video->id }}" class="btn btn-dark d-block">Watch</a>
</div>
