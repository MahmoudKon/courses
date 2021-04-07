<!-- Latest News -->
<div class="sidebar_section">
    <div class="sidebar_section_title">Latest Posts</div>
    <div class="sidebar_latest">

        @foreach($latest as $last)
        <!-- Latest Post -->
        <div class="latest d-flex flex-row align-items-start justify-content-start">
            <div class="latest_image">
                <div><img src="{{ $last->image_path }}" alt=""></div>
            </div>
            <div class="latest_content">
                <div class="latest_title"><a href="{{ route('posts.single', $last->id) }}">{{ $last->title }}</a></div>
                <div class="latest_date">{{ date('l j F Y', strtotime($last->created_at)) }}</div>
            </div>
        </div>
        @endforeach

    </div>
</div>
