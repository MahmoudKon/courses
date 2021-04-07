@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    @include('dashboard.layouts.content-header')
    <!-- end of Content header -->

    <section class="content">

        <div class="box box-primary">

            @php $columns = ['title', 'description', 'tags'] @endphp
            @include('dashboard.layouts.box-header', ['columns' => $columns])
            <!-- end of box header -->

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.title')</th>
                                <th>@lang('site.description')</th>
                                <th>@lang('site.category')</th>
                                <th>@lang('site.user')</th>
                                <th>@lang('site.tags')</th>
                                <th>@lang('site.time')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>

                        <!-- Loading Icon -->
                        <tr>
                            <td class="loading"> <i class="fa fa-cog fa-spin"></i> </td>
                        </tr>

                        <tbody id="dataRows">
                            <!-- The Data Loading Here By Ajax -->
                        </tbody>

                    </table><!-- end of table -->
                </div>
            </div><!-- end of box body -->


        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection