@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/courses.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/courses_responsive.css') }}">
    <style>
        div.load_icon {
            position: fixed;
            top: 40%;
            left: 38%;
            z-index: 100;
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
    <input type="hidden" value="{{ isset($query['tag']) ? $query['tag'] : '' }}" id="queryTag">
    <input type="hidden" value="{{ isset($query['post']) ? $query['post'] : '' }}" id="queryPost">
    <input type="hidden" value="{{ isset($query['id']) ? $query['id'] : '' }}" id="queryCategory">
    <div class="container">
        <div class="row">

            <!-- Courses Main Content -->
            <div class="col-lg-8">
                <div class="courses_search_container">
                    <form action="/courses" id="courses_search_form" class="courses_search_form d-flex flex-row align-items-center justify-content-start">
                        <input type="search" class="courses_search_input" placeholder="Search Courses" name="course" value="{{ request()->title }}">
                        <select id="courses_search_select" class="courses_search_select courses_search_input" name="category">
                            <option>All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request()->categories == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <button action="submit" class="courses_search_button ml-auto">search now</button>
                    </form>
                </div>

                <div class="load_icon">
                    <p>Loading...</p>
                    <i class="fa fa-cog fa-spin" style="font-size:24px"></i>
                </div>

                <div class="courses_container" id="courses_list">
                    <!-- The Data Coming By -->
                </div>
            </div>

            <!-- Courses Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">

                    <!-- Categories -->
                    @include('ui.layouts.categories')

                    <!-- Latest Course -->
                    @include('ui.layouts.latest')

                    <!-- Gallery -->
                    @include('ui.courses_page.gallery')

                    <!-- Tags -->
                    @include('ui.courses_page.tags')

                    <!-- Banner -->
                    @include('ui.courses_page.banner')
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
            var tag      = $('input#queryTag').val(),
                course   = $('input#queryPost').val(),
                category = $('input#queryCategory').val();
                url      = '/courses/filter';
            function loadData(url, tag, course, category){
                $('.load_icon').css('display', 'block');
                $.ajax({
                    url: url,
                    type: "get",
                    data: {tag: tag, category: category, course: course},
                    success: function(data, textStatus, jqXHR) {
                        $('.load_icon').css('display', 'none');
                        $('#courses_list').empty();
                        $('#courses_list').html(data);
                        tag      = '',
                        course   = '',
                        category = '';
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                });
            }

            loadData(url, tag, course, category);

            $('form').submit(function(e) {
                e.preventDefault();
                $('.load_icon').css('display', 'block');
                $.ajax({
                    url: "/courses/filter",
                    type: "get",
                    data: $(this).serialize(),
                    success: function(data, textStatus, jqXHR) {
                        $('.load_icon').css('display', 'none');
                        $('#courses_list').empty();
                        $('#courses_list').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                });
            });

            $('input[name=course]').keyup(function() {
                course = $(this).val();
                loadData(url, tag, course, category);
            });

            $('a.category_name').click(function(e) {
                e.preventDefault();
                category = $(this).data('id');
                loadData(url, tag, course, category);
            });

            $("body").on("click", "a.tags_list", function(e) {
                e.preventDefault();
                tag = $(this).data('tag');
                loadData(url, tag, course, category);
            });

            $("body").on("click", ".pagination a", function(e) {
                e.preventDefault();
                url = $(this).attr('href');
                loadData(url, tag, course, category);
            });
        })
    </script>
@endpush
