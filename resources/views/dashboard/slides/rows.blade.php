
@if ($rows->count() > 0 )
    @foreach ($rows as $index=>$row)
    <tr class="check">
        <td class="check"> {{ $index + 1 }} <input type="checkbox" name="multiDelete[]" value="{{ $row->id }}"></td>
            <td> {{ $row->name }} </td>
            <td width='10%'>{{ $row->images->count() }}</td>
            <td>
                <div>
                    @foreach($row->images as $image)
                        <img src="{{ $image->image_path }}" class="mr-2" width="100px">
                    @endforeach
                </div>
            </td>
            <td width='15%'>
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
