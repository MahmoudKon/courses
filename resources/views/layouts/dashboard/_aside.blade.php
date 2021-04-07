<aside class="main-sidebar" style="position: fixed">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> @lang('site.online')</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ Request::segment(3) == '' ? 'active' : '' }}">
                <a href="{{ route('dashboard.welcome') }}">
                    <i class="fa fa-th"></i><span>@lang('site.dashboard')</span>
                </a>
            </li>

            @if (auth()->user()->hasPermission('read_users'))
            <li class="{{ Request::segment(3) == 'users' ? 'active' : '' }}">
                <a href="{{ route('dashboard.users.index') }}">
                    <i class="fa fa-users"></i>
                    <span>@lang('site.users')</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->hasPermission('read_categories'))
            <li class="{{ Request::segment(3) == 'categories' ? 'active' : '' }}">
                <a href="{{ route('dashboard.categories.index') }}">
                    <i class="fa fa-bookmark"></i>
                    <span>@lang('site.categories')</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->hasPermission('read_courses'))
            <li class="{{ Request::segment(3) == 'courses' ? 'active' : '' }}">
                <a href="{{ route('dashboard.courses.index') }}">
                    <i class="fa fa-book"></i>
                    <span>@lang('site.courses')</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->hasPermission('read_videos'))
            <li class="{{ Request::segment(3) == 'videos' ? 'active' : '' }}">
                <a href="{{ route('dashboard.videos.index') }}">
                    <i class="fa fa-youtube"></i>
                    <span>@lang('site.videos')</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->hasPermission('read_videos'))
            <li class="{{ Request::segment(3) == 'posts' ? 'active' : '' }}">
                <a href="{{ route('dashboard.posts.index') }}">
                    <i class="fa fa-question"></i>
                    <span>@lang('site.posts')</span>
                </a>
            </li>
            @endif

            @if (auth()->user()->hasPermission('read_videos'))
            <li class="{{ Request::segment(3) == 'slides' ? 'active' : '' }}">
                <a href="{{ route('dashboard.slides.index') }}">
                    <i class="fa fa-image"></i>
                    <span>@lang('site.slides')</span>
                </a>
            </li>
            @endif

    </section>

</aside>

