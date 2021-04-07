@if ($rows->count() > 0)
    @foreach ($rows as $index=>$row)
    <tr class="check">
        <td> {{ $index + 1 }} <input type="checkbox" name="multiDelete[]" value="{{ $row->id }}"></td>
        <td width=10%>
            <img src="{{ $row->course->image_path }}" class="img-thumbnail">
        </td>
        <td>{!! strlen($row->title) > 50 ? substr($row->title, 0, 50) . ' ...' : $row->title !!}</td>
        <td>{!! strlen($row->description) > 150 ? substr($row->description, 0, 150) . ' ...' : $row->description !!}</td>
        <td>{{ $row->course->title }}</td>
        <td>{{ $row->category->name }}</td>
        <td>
            @php $tags = explode(",",$row->tags) @endphp
            @foreach($tags as $tag)
            <span class="badge bg-purple" style="margin-bottom: 5px;">{{ $tag }}</span>
            @endforeach
        </td>
        <td>
            @include('dashboard.layouts.buttons')
        </td>
    </tr>

    @endforeach

    <tr>
        <td colspan="100">
            {!! $rows->links() !!}
        </td>
    </tr>

@else
    <tr>
        <td colspan="15">
            <h3 class="text-center alert alert-danger">@lang('site.no_data_found')</h3>
        </td>
    </tr>
@endif
