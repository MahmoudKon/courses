<!-- Categories -->
<div class="sidebar_section">
    <div class="sidebar_section_title">Categories</div>
    <div class="sidebar_categories">
        <ul>
            @foreach($categories as $category)

                @if($category->courses->count() > 0 || $category->videos->count() > 0)
                    @if(request()->categories != $category->id)
                        <li><a href="#" class="category_name" data-id="{{ $category->id }}">{{ $category->name }}</a></li>
                    @endif
                @endif

            @endforeach
        </ul>
    </div>
</div>
