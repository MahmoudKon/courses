@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/blog_single.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/blog_single_responsive.css') }}">
@endpush

@section('content')
@include('ui.layouts.menu')
<div class="courses" style="padding: 50px 0;">
    <div class="container">
        <div class="row">
            <!-- Blog Main Content -->
            <div class="col-lg-8">
                <!-- post -->
                @include('ui.single_post_page.post')
                <!-- Comments -->
                @include('ui.single_post_page.comments')
            </div>

            <!-- Blog Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                <!-- Categories -->
                @include('ui.single_post_page.category')
                <!-- Latest -->
                @include('ui.single_post_page.latest')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('ui/js/blog_single.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('form#post_comment').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "/posts/createComment",
                    type: "post",
                    data: $(this).serialize(),
                    success: function(data, textStatus, jqXHR) {
                        $('.comments_list').append(data);
                        $('.comments_title span').text(parseInt($('.comments_title span').text()) + 1)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                });
            });
        });
    </script>
@endpush
