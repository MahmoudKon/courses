@if ($rows->count() > 0 )
    @foreach ($rows as $index=>$row)
    <tr class="check">
        <td class="check"> {{ $index + 1 }} <input type="checkbox" name="multiDelete[]" value="{{ $row->id }}"></td>
        <td><img src="{{ $row->image_path }}" style="width: 100px;" alt=""></td>
        <td style="padding-top: 25px">{{ $row->name }}</td>
        <td style="padding-top: 25px">{{ $row->email }}</td>
        <td style="padding-top: 25px">{{ $row->address }}</td>
        <td style="padding-top: 25px">{{ $row->phone }}</td>
        <td style="padding-top: 25px">{{ $row->gender }}</td>
        <td style="padding-top: 25px">{{ $row->status }}</td>
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
