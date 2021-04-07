@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/blog_single.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/blog_single_responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/courses.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/courses_responsive.css') }}">
    <style>
    .active , .active a{
        color: #384158 !important;
    }

    .sidebar_section{
        height: 300px;
        background:#f2f4f5;
        padding: 15px;
        color: #384158;
        overflow-y: scroll;
    }
    </style>
@endpush

@section('content')
@include('ui.layouts.menu')
<div class="courses" style="padding: 50px 0;">
    <div class="container">
        <div class="row">

            <!-- Courses Main Content -->
            <div class="col-lg-3">
                @include('ui.watch_page.list')
            </div>

            <!-- Courses Sidebar -->
            <div class="col-lg-6">
                <div class="courses_container" id="courses_list">

                    <div class="card">
                        <div class="card-header">
                            {{ $video->title }}
                        </div>
                        <div class="card-body">
                            <video width="100%" controls>
                                <source src="{{ $video->video_path }}">
                            </video>
                            <h5 class="card-title">
                                <span> Category : {{ $video->category->name }} </span>
                                <span class="float-right"> From {{ $video->created_at->diffForHumans() }} </span>
                            </h5>
                            <h5 class="card-title">
                                Tags :
                                @php $tags = explode(",",$video->tags) @endphp
                                @foreach($tags as $tag)
                                    <button class="btn btn-sm">{{ $tag }}</button>
                                @endforeach
                            </h5>
                            <p class="card-text">{!! $video->description !!}</p>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Courses Main Content -->
            <div class="col-lg-3">
                @include('ui.watch_page.popular')
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                @include('ui.watch_page.comments')
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('ui/js/courses.js') }}"></script>
    <script>
            $(document).ready(function() {
                $('form#video_comment').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "/courses/videos/watch/createComment",
                        type: "post",
                        data: $(this).serialize(),
                        success: function(data, textStatus, jqXHR) {
                            $('.comments_list').append(data);
                            $('.comment_input').val('')
                        },
                        error: function(jqXHR, textStatus, errorThrown) {

                        }
                    });
                });
            });
    </script>
@endpush
