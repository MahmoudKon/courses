@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    @include('dashboard.layouts.content-header')

    <section class="content">

        <div class="box box-primary">
            @php $columns = ['name', 'email', 'phone', 'gender', 'status'] @endphp
            @include('dashboard.layouts.box-header', ['columns' => $columns])

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.address')</th>
                                <th>@lang('site.phone')</th>
                                <th>@lang('site.gender')</th>
                                <th>@lang('site.status')</th>
                                <th width="8%">@lang('site.action')</th>
                            </tr>
                        </thead>

                        <!-- Loading Icon -->
                        <tr>
                            <td class="loading"> <i class="fa fa-cog fa-spin"></i> </td>
                        </tr>

                        <tbody id="dataRows">
                        </tbody>

                    </table><!-- end of table -->
                </div>
            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->
</div><!-- end of content wrapper -->

@endsection
