<!-- Videos -->
<div class="sidebar_section">
    <div class="sidebar_section_title">Course List</div>
    <div class="sidebar_categories">
        <ul>
            @foreach($list as $index)
            <li class="{{ $index->id == request()->index ? 'active' : '' }}">
                <a href="/courses/videos/watch?list={{ str_replace(' ', '-', $index->course->title) }}&index={{ $index->id }}">
                    {{ strlen($index->title) > 25 ? substr($index->title, 0, 25) . '...' : $index->title }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
