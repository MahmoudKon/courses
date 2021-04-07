@if ($rows->count() > 0)
    @foreach ($rows as $index=>$row)
    <tr class="check">
        <td class="check"> {{ $index + 1 }} <input type="checkbox" name="multiDelete[]" value="{{ $row->id }}"></td>
        <td><img src="{{ $row->image_path }}" width="80px"></td>
        <td>{!! strlen($row->title) > 70 ? substr($row->title, 0, 70) . ' ...' : $row->title !!}</td>
        <td>{!! strlen($row->description) > 200 ? substr($row->description, 0, 200) . ' ...' : $row->description !!}</td>
        <td>{{ $row->category->name }}</td>
        <td>{{ $row->user->name }}</td>
        <td>
            @php $tags = explode(",",$row->tags) @endphp
            @foreach($tags as $tag)
            <span class="badge bg-purple" style="margin-bottom: 5px;">{{ $tag }}</span>
            @endforeach
        </td>
        <td>{{ $row->created_at->diffForHumans() }}</td>
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