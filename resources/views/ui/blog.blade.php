@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/courses.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/courses_responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/blog/css/style.css') }}">
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
        .btns{
            position: absolute;
            top: 0;
            z-index: 95;
        }
    </style>
@endpush

@section('content')
@include('ui.layouts.menu')
<div class="courses" style="padding: 50px 0;">
    <input type="hidden" value="{{ isset($query['tag']) ? $query['tag'] : '' }}" id="queryTag">
    <input type="hidden" value="{{ isset($query['post']) ? $query['post'] : '' }}" id="querypost">
    <input type="hidden" value="{{ isset($query['category']) ? $query['category'] : '' }}" id="queryCategory">
    <div class="container">
        @include('ui.posts_page.create')
        <div class="row">
            <!-- Blog Main Content -->
            <div class="col-lg-9">
                <div class="load_icon">
                    <p>Loading...</p>
                    <i class="fa fa-cog fa-spin" style="font-size:24px"></i>
                </div>

                <div class="courses_container" id="courses_list">
                    <!-- The Data Coming By -->
                </div>
            </div>

            <!-- Blog Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar">

                    <div class="mb-4">
                        <input type="search" class="courses_search_input" placeholder="Search Post" name="description" value="">
                    </div>

                    <!-- Categories -->
                    @include('ui.layouts.categories')

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
            // To Load All Posts
            var tag      = $('input#queryTag').val(),
                post     = $('input#queryPost').val(),
                category = $('input#queryCategory').val(),
                url      = '/posts/filter';
            function loadData(url, tag, post, category){
                $('.load_icon').css('display', 'block');
                $.ajax({
                    url: url,
                    type: "get",
                    data: {tag: tag, post: post, category: category},
                    success: function(data, textStatus, jqXHR) {
                        $('.load_icon').css('display', 'none');
                        $('#courses_list').empty();
                        $('#courses_list').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                });
            }

            loadData(url, tag, post, category);

            // Pagination links
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                loadData(url, tag, post, category);
            });

            // Search About Post By Input
            $('input[name=description]').keyup(function() {
                post = $(this).val();
                loadData(url, tag, post, category);
            });

            // Search About Post By Category Name Link
            $('a.category_name').click(function(e) {
                e.preventDefault();
                category = $(this).data('id');
                loadData(url, tag, post, category);
            });

            // Search About Post By Tag Name Link
            $("body").on("click", "a.tag_name", function(e) {
                e.preventDefault();
                tag = $(this).data('tag');
                loadData(url, tag, post, category);
            });

            // Create Post
            $('#addPost').submit(function(e) {
                e.preventDefault();
                $('.load_icon').css('display', 'block');
                var form = $(this)[0];
                var data = new FormData(form);
                $.ajax({
                    type:"POST",
                    url: "/posts/create",
                    enctype: 'multipart/form-data',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $('#createPostModal').modal('hide');
                        $('.load_icon').css('display', 'none');
                        $('.courses_row').prepend(data);
                        $('input[name=title]').val('');
                        $('input[name=description]').val('');
                        $('input[name=tags]').val('');
                        $('textarea').val('');
                    },
                    error: function(data){

                    }
                });
            });

            // To Open Modal and Show The Data Post On The Modal To Make Edit
            $("body").on("click", "a.editPost", function(e) {
                e.preventDefault();
                var btn = $(this).data('id');
                $(this).closest('.course').find('img').attr('id', 'img');
                $(this).closest('.course').find('.course_title a').attr('id', 'title');
                $(this).closest('.course').find('.course_text').attr('id', 'desc');
                $(this).closest('.course').find('.tags-list').attr('id', 'tags-list');
                $.ajax({
                    url: "/posts/edit",
                    type: "get",
                    data: {id: btn},
                    success: function(data, textStatus, jqXHR) {
                        $('#updatePost').modal('show');
                        $('#updateTitle').val(data.title);
                        $('#updateDescription').val(data.description);
                        $('#updateCategory').val(data.category_id);
                        $('#updateTags').val(data.tags);
                        $('#id').val(data.id);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                });
            });

            // Send The New Data To Controller To Save IT
            $("body").on("submit", "#editPost", function(e) {
                $.ajaxSetup({
                    header: $('meta[name="_token"]').attr('content')
                });
                e.preventDefault();
                $('.load_icon').css('display', 'block');
                var form = $(this)[0];
                var data = new FormData(form);

                $.ajax({
                    type:"POST",
                    url: "/posts/update",
                    enctype: 'multipart/form-data',
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data){
                        $('#updatePost').modal('hide');
                        $('.load_icon').css('display', 'none');

                        if(data.image != ''){
                            $('.course #img').attr('src', 'http://5dmat-web/uploads/posts/' + data.image);
                        }else{
                            $('.course #img').parent('.course_image').remove();
                        }

                        if (data.title.length > 30) {
                            $('.course #title').html(data.title.substr(0, 30) + ' ...');
                        }else{
                            $('.course #title').html(data.title);
                        }

                        if (data.description.length > 45) {
                            $('.course #desc').html(data.description.substr(0, 45) + ' ...');
                        }else{
                            $('.course #desc').html(data.description);
                        }

                        var tags = data.tags.split(',');
                        var tagList = '';
                        for (var i = 0; i < tags.length; i++) {
                            tagList += '<a href="/posts?tag='+tags[i]+'" data-tag="'+tags[i]+'" class="btn btn-outline-dark mr-1 btn-sm tag_name">'+tags[i]+'</a>';
                        }
                        $('.course #tags-list').empty();
                        $('.course #tags-list').append(tagList);

                        $('.course #img').removeAttr('id', 'img');
                        $('.course #title').removeAttr('id', 'title');
                        $('.course #desc').removeAttr('id', 'desc');
                        $('.course #tags-list').removeAttr('id', 'tags-list');
                    },
                    error: function(data){

                    }
                });

            });

            // To Delete The Post
            $("body").on("click", "a.deletePost", function(e) {
                e.preventDefault();
                var btn = $(this);
                $('.load_icon').css('display', 'block');
                $.ajax({
                    url: "/posts/delete",
                    type: "get",
                    data: {id: btn.data('id')},
                    success: function(data, textStatus, jqXHR) {
                        $('.load_icon').css('display', 'none');
                        btn.closest('.course_col').remove();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    }
                });
            });
        });
    </script>
@endpush
