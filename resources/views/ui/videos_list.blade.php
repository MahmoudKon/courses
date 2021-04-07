@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/courses.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/courses_responsive.css') }}">
    <style>
        div.load_icon {
            position: absolute;
            top: 10%;
            left: 38%;
            z-index: 2;
            color: #000;
            background: #757575;
            padding: 8px 35px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 0 10px 10px #111;
            display: none;
        }

        div.load_icon p {
            font-size: 25px !important;
            color: #000;
            font-weight: bold;
        }

        div.load_icon i {
            font-size: 50px !important;
        }
    </style>
@endpush

@section('content')
@include('ui.layouts.menu')
<div class="courses" style="padding: 50px 0;">
    <input type="hidden" value="{{ isset($query['tags']) ? $query['tags'] : '' }}" id="queryTags">
    <input type="hidden" value="{{ isset($query['title']) ? $query['title'] : '' }}" id="queryTitle">
    <input type="hidden" value="{{ isset($query['category']) ? $query['category'] : '' }}" id="queryCategory">
    <input type="hidden" value="{{ isset($query['course']) ? $query['course'] : '' }}" id="queryCourse">
    <div class="container">
        <div class="row">

            <!-- Courses Main Content -->
            <div class="col-lg-3">
                <div class="courses_search_container">
                    <form action="/courses" id="courses_search_form" class="courses_search_form d-flex flex-row align-items-center justify-content-start">
                        @csrf
                        <input type="search" class="courses_search_input mr-0" placeholder="Search Courses" name="title" style="width: 100% !important;" value="{{ request()->title }}">
                    </form>

                    <div class="sidebar pl-0">
                        <!-- Categories -->
                        @include('ui.layouts.categories')
                    </div>
                </div>

            </div>

            <!-- Courses Sidebar -->
            <div class="col-lg-8">

                <div class="load_icon">
                    <p>Loading...</p>
                    <i class="fa fa-cog fa-spin" style="font-size:24px"></i>
                </div>

                <div class="courses_container" id="courses_list">
                    <!-- The Data Coming By -->
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('ui/js/courses.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.load_icon').css('display', 'block');
            var tag      = $('input#queryTags').val(),
                course   = $('input#queryCourse').val(),
                video    = $('input#queryTitle').val(),
                category = $('input#queryCategory').val();
                url      = "{{ route('courses.videos.filter') }}";
            function loadData(url, tag, course, video, category){
                $('.load_icon').css('display', 'block');
                $.ajax({
                    url: url,
                    type: "get",
                    data: {tag: tag, category: category, video: video, course: course},
                    success: function(data, textStatus, jqXHR) {
                        $('.load_icon').css('display', 'none');
                        $('#courses_list').empty();
                        $('#courses_list').html(data);
                        tag      = '',
                        course   = '',
                        video    = '',
                        category = '';
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                });
            }

            loadData(url, tag, course, video, category);

            $('input[name=title]').keyup(function() {
                course   = '{{ request()->course }}';
                video    = $(this).val();
                loadData(url, tag, course, video, category);
            });

            $('a.category_name').click(function(e) {
                e.preventDefault();
                course   = '{{ request()->course }}';
                category = $(this).data('id');
                loadData(url, tag, course, video, category);
            });

            $('body').on('click', '.tags_list', function(e) {
                e.preventDefault();
                course   = '{{ request()->course }}';
                tag = $(this).data('tag');
                loadData(url, tag, course, video, category);
            });

            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();
                course   = '{{ request()->course }}';
                url      = $(this).attr('href');
                loadData(url, tag, course, video, category);
            });
        })
    </script>
@endpush
