@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    @include('dashboard.layouts.content-header')
    <!-- end of Content header -->

    <section class="content">

        <div class="box box-primary">

            @php $columns = ['name'] @endphp
            @include('dashboard.layouts.box-header', ['columns' => $columns])
            <!-- end of box header -->

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    @lang('site.name')
                                    <img src="{{ asset('dashboard_files/img/flags/' . @Lang::locale() . '.png') }}" width=20px>
                                </th>
                                <th>@lang('site.action')</th>
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
