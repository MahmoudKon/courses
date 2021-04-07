<!-- Categories -->
<div class="sidebar_section">
    <div class="sidebar_section_title">Categories</div>
    <div class="sidebar_categories">
        <ul class="categories_list">
            @foreach($categories as $category)
                @if($category->posts->count() > 0)
                <li><a href="/posts/?category={{ $category->id }}&name={{ $category->name }}" class="clearfix">{{ $category->name }}<span>({{ $category->posts->count() }})</span></a></li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
