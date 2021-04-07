@extends('layouts.app')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/about.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/about_responsive.css') }}">
@endpush

@section('content')

    @include('ui.layouts.menu')

    @include('ui.about_page.about')

    @include('ui.about_page.why_us')

    @include('ui.layouts.team')

    @include('ui.layouts.counter')

    @include('ui.about_page.partners')
    <div class="pt-5 pb-5"></div>

@endsection

@push('js')
<script src="{{ asset('ui/js/custom.js') }}"></script>
<script src="{{ asset('ui/js/about.js') }}"></script>
@endpush
