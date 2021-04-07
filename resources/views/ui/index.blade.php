@extends('layouts.app')

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/responsive.css') }}">
@endpush

@section('content')

    @include('ui.home_page.banner')

    @include('ui.home_page.features')

    @include('ui.home_page.courses')

    @include('ui.layouts.counter')

    @include('ui.home_page.events')

    @include('ui.layouts.team')

    @include('ui.home_page.news')

@endsection

@push('js')
<script src="{{ asset('ui/js/custom.js') }}"></script>
@endpush
