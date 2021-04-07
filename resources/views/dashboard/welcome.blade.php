@extends('layouts.dashboard.app')

@section('content')

<div class="content-wrapper">

    <section class="content-header">

        <h1>@lang('site.dashboard')</h1>

        <ol class="breadcrumb">
            <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            {{-- Users--}}
            <div class="col-md-2 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $count['users'] }}</h3>

                        <p>@lang('site.users')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">
                        @lang('site.read') <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- Categories--}}
            <div class="col-md-2 col-xs-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $count['categories'] }}</h3>

                        <p>@lang('site.categories')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">
                        @lang('site.read') <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- Courses --}}
            <div class="col-md-2 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $count['courses'] }}</h3>

                        <p>@lang('site.courses')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="{{ route('dashboard.courses.index') }}" class="small-box-footer">
                        @lang('site.read') <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- Videos --}}
            <div class="col-md-2 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $count['videos'] }}</h3>

                        <p>@lang('site.videos')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-youtube"></i>
                    </div>
                    <a href="{{ route('dashboard.videos.index') }}" class="small-box-footer">
                        @lang('site.read') <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- Posts --}}
            <div class="col-md-2 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ $count['posts'] }}</h3>

                        <p>@lang('site.posts')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-question-circle"></i>
                    </div>
                    <a href="{{ route('dashboard.posts.index') }}" class="small-box-footer">
                        @lang('site.read') <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            {{-- Comments --}}
            <div class="col-md-2 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $count['comments'] }}</h3>

                        <p>@lang('site.comments')</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <a href="javascript:void(0)" class="small-box-footer">
                        ...
                    </a>
                </div>
            </div>

        </div><!-- end of row -->

        <!-- Start OF Section Have Products Active -->
        <div class="box box-solid">
            <div class="box-header">
                <!-- ADD Header -->
            </div>
            <div class="box-body border-radius-none">
                <div class="row">

                    <div class="col-md-7">
                        <!-- Latest Courses Section -->
                        @include('dashboard.welcome.latest_courses')
                        <!-- Latest Courses Section -->

                        <!-- Latest Courses Section -->
                        @include('dashboard.welcome.latest_videos')
                        <!-- Latest Courses Section -->
                    </div>

                    <div class="col-md-5">
                        <!-- Latest Users Section -->
                        @include('dashboard.welcome.latest_users')
                        <!-- /Latest Users Section -->

                        <!-- Latest Posts Section -->
                        @include('dashboard.welcome.latest_posts')
                        <!-- Latest Posts Section -->

                        <!-- Latest Sliders Section -->
                        @include('dashboard.welcome.latest_sliders')
                        <!-- Latest Sliders Section -->
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-12">
                            @include('dashboard.welcome.chart')
                        </div>
                    </div>

                </div>

            </div><!-- /.box-body -->
        </div><!-- end of box -->
        <!-- End OF Section Have Products Active -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection
