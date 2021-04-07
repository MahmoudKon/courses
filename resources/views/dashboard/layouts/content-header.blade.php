<section class="content-header">
  <h1>@lang('site.' . Request::segment(3))</h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
    <li class="active">@lang('site.' . Request::segment(3)))</li>
  </ol>
</section>