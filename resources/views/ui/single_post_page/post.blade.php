<div class="blog_content">
    <div class="blog_title">{!! $post->title !!}</div>
    <div class="blog_meta">
        <ul>
            <li>Post on <a href="#">{{ date('l j F Y', strtotime($post->created_at)) }}</a></li>
            <li>By <a href="#">admin</a></li>
        </ul>
    </div>
    @if(isset($post->image))
    <div class="blog_image"><img src="{{ $post->image_path }}" alt="" width="100%"></div>
    @endif

    <div class="mt-3">
        {!! $post->description !!}
    </div>

    <div
        class="blog_extra d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
        <div class="blog_tags">
            <span>Tags: </span>
            <ul>
                @php $tags = explode(',', $post->tags) @endphp
                @foreach($tags as $tag)
                <li><a href="/posts?tag={{ $tag }}">{{ $tag }}</a>, </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
