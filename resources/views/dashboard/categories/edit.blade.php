@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('site.users')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form action="{{ route('dashboard.categories.update', $category) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}



                        <div class="row">
                            <div class="col-md-6">

                                @foreach (config('translatable.locales') as $locale)
                                <div class="form-group has-feedback">
                                    <label>@lang('site.' . $locale . '.name')</label>
                                    <input type="text" name="{{ $locale }}[name]" class="form-control" placeholder="@lang('site.name')"  value="{{ $category->translate($locale)->name }}">
                                    <span class="form-control-feedback">
                                        <img src="{{ asset('dashboard_files/img/flags/' . $locale . '.png') }}" width= 20px>
                                    </span>
                                    <div class="invalid-feedback">{{ $errors->all() ? $errors->first($locale.'.name') : '' }}</div>
                                </div>
                                @endforeach

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.update')</button>
                                </div>
                            </div>

                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
