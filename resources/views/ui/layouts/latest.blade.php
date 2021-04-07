<!-- Latest Course -->
<div class="sidebar_section">
    <div class="sidebar_section_title">Latest Courses</div>
    <div class="sidebar_latest">

    @foreach($latest as $last)
        <!-- Latest Course -->
        <div class="latest d-flex flex-row align-items-start justify-content-start">
            <div class="latest_image">
                <div><img src="{{ $last->image_path }}" alt=""></div>
            </div>
            <div class="latest_content">
                <div class="latest_title"><a href="/courses/single/{{ str_replace(' ', '-', $last->title) }}">{{ $last->title }}</a></div>
                <div class="latest_price">{{ $last->user->name }}</div>
            </div>
        </div>
    @endforeach

    </div>
</div>
