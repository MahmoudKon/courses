<div class="course">
    <div class="course_image"><img src="{{ $course->image_path }}" width="100%"></div>
    <div class="course_body">
        <h3 class="course_title"><a href="/courses/single/{{ str_replace(' ', '-', $course->title) }}">
            {!! strlen($course->title) > 25 ? substr($course->title, 0, 25) . '...' : $course->title !!}
        </a></h3>
        <div class="course_teacher">{{ $course->user->name }}</div>
        <div class="course_text">
            <p>{!! strlen($course->description) > 40 ? substr($course->description, 0, 40) . '...' : $course->description !!}</p>
        </div>
    </div>
    <div class="course_footer">
        <div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
            <div class="course_info">
                <i class="fa fa-tag" aria-hidden="true"></i>
            </div>
            <div class="course_info">
            @php $tags = explode(",",$course->tags) @endphp
            @foreach($tags as $tag)
                <a href="/courses?tags={{ $tag }}" data-tag="{{ $tag }}" class="btn btn-outline-dark btn-sm tags_list">{{ $tag }}</a>
            @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <a href="/courses/videos?course={{ $course->id }}&name={{ str_replace(' ', '-', $course->title) }}" class="btn btn-dark d-block">Watch</a>
        </div>
        <div class="col-md-6">
            <a data-id={{ $course->id }} class="btn btn-dark text-white d-block sign" data-toggle="modal" data-target="#sign">Sign</a>
        </div>
    </div>
</div>
