<!-- Tags -->
<div class="sidebar_section">
    <div class="sidebar_section_title">Tags</div>
    <div class="sidebar_tags">
        <ul class="tags_list">
            @php $arr = []; @endphp

            @foreach($tags as $tag)

            @php $ex_tag = explode(',', $tag->tags); @endphp

                @foreach($ex_tag as $single_tag)

                    @if(!in_array($single_tag, $arr))

                        @php $arr[] = $single_tag @endphp
                        <li><a href="#" data-tag="{{ $single_tag }}" class="tags_list">{{ $single_tag }}</a></li>

                    @endif

                @endforeach

            @endforeach
        </ul>
    </div>
</div>
