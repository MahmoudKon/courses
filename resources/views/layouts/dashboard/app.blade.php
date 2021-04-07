<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{--<!--Bootstrap3.3.7-->--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/skin-blue.min.css') }}">

    {{--<!--inputTags-->--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/inputTags/css/jquery.tag-editor.css') }}">

    {{--Slider--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/slider/style.css') }}">

    @if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE-rtl.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/bootstrap-rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/rtl.css') }}">

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
    @else
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_files/css/AdminLTE.min.css') }}">
    @endif

    <style>
        .mr-2 {
            margin-right: 5px;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #367FA9;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 1s linear infinite;
            /* Safari */
            animation: spin 1s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .loading {
            position: fixed;
            left: 50%;
            font-size: 35px;
            color: #3c8dbc;
            display: none;
        }
    </style>

    {{--<!-- jQuery 3 -->--}}
    <script src="{{ asset('dashboard_files/js/jquery.min.js') }}"></script>

    {{--<!-- iCheck -->--}}
    <link rel="stylesheet" href="{{ asset('dashboard_files/plugins/icheck/all.css') }}">

    {{--<!-- Date Plugin -->--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{--html in  ie--}}
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    @stack('css')

</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">

        <header class="main-header">

            {{--<!-- Logo -->--}}
            <a href="{{ route('home') }}" class="logo" style="position: fixed;">
                {{--<!-- mini logo for sidebar mini 50x50 pixels -->--}}
                <span class="logo-mini"><b>D</b>|L</span>
                <span class="logo-lg"><b>Delta</b>|Learning</span>
            </a>

            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        {{--<!-- Tasks: style can be found in dropdown.less -->--}}
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('dashboard_files/img/flags/' . @Lang::locale() . '.png') }}" width=23px>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    {{--<!-- inner menu: contains the actual data -->--}}
                                    <ul class="menu">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        {{--<!-- User Account: style can be found in dropdown.less -->--}}
                        <li class="dropdown user user-menu">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ auth()->user()->image_path }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                            </a>
                            <ul class="dropdown-menu">

                                {{--<!-- User image -->--}}
                                <li class="user-header">
                                    <img src="{{ auth()->user()->image_path }}" class="img-circle" alt="User Image">

                                    <p>
                                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                        <small>@lang('site.member') {{ auth()->user()->created_at->diffForHumans(now()) }}</small>
                                    </p>
                                </li>

                                {{--<!-- Menu Footer-->--}}
                                <li class="user-footer">

                                    <a href="{{ route('dashboard.users.show', auth()->user()) }}" class="btn btn-default btn-flat">@lang('site.profile')</a>

                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">@lang('site.logout')</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

        </header>

        @include('layouts.dashboard._aside')

        @yield('content')

        <footer class="main-footer text-center">
            <strong>@lang('site.copyright') &copy; 2019 - 2020
                <a href="https://www.facebook.com/profile.php?id=100005142946296"><i>Famous</i></a>.</strong>
            @lang('site.rights').
        </footer>

    </div><!-- end of wrapper -->

    {{--<!-- Bootstrap 3.3.7 -->--}}
    <script src="{{ asset('dashboard_files/js/bootstrap.min.js') }}"></script>

    {{--Slider--}}
    <script src="{{ asset('dashboard_files/plugins/slider/script.js') }}"></script>

    {{--icheck--}}
    <script src="{{ asset('dashboard_files/plugins/icheck/icheck.min.js') }}"></script>

    {{--<!-- FastClick -->--}}
    <script src="{{ asset('dashboard_files/js/fastclick.js') }}"></script>

    {{--ckeditor standard--}}
    <script src="{{ asset('dashboard_files/plugins/ckeditor/ckeditor.js') }}"></script>

    {{--print this--}}
    <script src="{{ asset('dashboard_files/js/printThis.js') }}"></script>


    {{-- chart --}}
    <script src="{{ asset('dashboard_files/plugins/chart/chart.js') }}"></script>

    {{-- inputTags --}}
    <script src="{{ asset('dashboard_files/plugins/inputTags/js/jquery.tag-editor.min.js') }}"></script>

    {{--<!-- AdminLTE App -->--}}
    <script src="{{ asset('dashboard_files/js/adminlte.min.js') }}"></script>

    {{--custom js--}}
    <script src="{{ asset('dashboard_files/js/custom/image_preview.js') }}"></script>

    <!-- To Create Tags ON Inputs -->
    <script>
        $(document).ready(function() {
            CKEDITOR.config.language = "{{ app()->getLocale() }}";
            $('#tags').tagEditor({
                initialTags: [],
                delimiter: ', ',
                placeholder: 'Click Space To ADD Tag...'
            });
        }); //end of ready
    </script>

    @stack('script')

    <!-- Sweet Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    @include('sweet::alert')

        {{-- When Click On TR on The Table Will Do The Checkbox toggel --}}
        <script>
            $(document).ready(function () {
                $('table .check').on("click", function() {
                    console.log("done");
                    var ele = $(this).find('input[type=checkbox]');
                    if(ele.prop('checked') == true)
                    {
                        ele.prop("checked", false);
                    } else {
                        ele.prop("checked", true);
                    }
                });
                $('tr td input[type=checkbox]').click(function() {
                    if($(this).prop('checked') == true)
                    {
                        $(this).prop("checked", false);
                    } else {
                        $(this).prop("checked", true);
                    }
                });
            
            });
        </script>

    <!-- This Code Ajax To Load The Data On Table and Make Search On It -->
    @if(Request::segment(3) != '' && Request::segment(4) == '')
    <script>
        $(document).ready(function() {
            // This Url To Goto Method That Do Retrun The Rows
            var url = "{{ route('dashboard.'. Request::segment(3) .'.rows') }}",
                search = $('input[name=search]').val(),
                columnName = $('.columns-names').val(),
                paginateNumber = $('.paginateNumber').val();

            // Function To Excute Ajax Code To Get The Rows
            function getRows(url, search, columnName, paginateNumber) {
                $('.loading').css('display', 'block');
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        search: search,
                        columnName: columnName,
                        paginateNumber: paginateNumber,
                    },
                    success: function(data, textStatus, jqXHR) {
                        $('.loading').css('display', 'none');
                        $('table #dataRows').html(data);
                    },
                });
            }

            // To Get The Rows Before The Page Loading
            getRows(url, search, columnName, paginateNumber);

            // To Create Paginate Numaber
            $("body").on("change", ".paginateNumber", function() {
                var search = $('input[name=search]').val();
                var columnName = $('.columns-names').val();
                var paginateNumber = $(this).val();
                getRows(url, search, columnName, paginateNumber);
            });
            
            // When The Click On Paginate Links, The Page Will Not Make Load
            $("body").on("click", ".pagination a", function(e) {
                e.preventDefault();
                var page = "?" + $(this).attr('href').split("?").pop();
                    search = $('input[name=search]').val(),
                    columnName = $('.columns-names').val(),
                    paginateNumber = $('.paginateNumber').val();
                getRows(url+page, search, columnName, paginateNumber);
            });

            // To Get The Rows When Write Something On Input Search
            $('input[name=search]').keyup(function() {
                var search = $(this).val();
                    columnName = $('.columns-names').val();
                    paginateNumber = $('.paginateNumber').val();
                getRows(url, search, columnName, paginateNumber);
            });

            // To Get The Rows When Write Something On Input Search
            $('.columns-names').change(function() {
                columnName = $(this).val();
                search = $('input[name=search]').val();
                paginateNumber = $('.paginateNumber').val();
                getRows(url, search, columnName, paginateNumber);
            });

            // Delete The Row
            $("body").on("click", ".delete", function(e) {
                e.preventDefault();
                var btn = $(this);
                swal({
                    title: "Are you sure to delete this row?",
                    text: "You will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: [
                        'No, cancel it!',
                        'Yes, I am sure!'
                    ],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        btn.closest('form').submit();
                    } else {
                        swal("Cancelled", "Your imaginary file is safe", "error");
                    }
                });
            });

            // Multi Delete The Rows
            $('#multi-delete').click(function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var ids = [];
                $('#dataRows :checkbox:checked').each(function(i){
                    ids[i] = $(this).val();
                });
                $('#multi-ID').val(ids);
                swal({
                    title: "Are you sure to delete selected rows ?",
                    text: "You will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: [
                        'No, cancel it!',
                        'Yes, I am sure!'
                    ],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        form.submit();
                    } else {
                        swal("Cancelled", "Your imaginary file is safe", "error");
                    }
                });
            });
        });
    </script>
    @endif
    <!-- /End Load The Rows -->

    <!-- This Code Ajax To Display The Comments On Edit Pages [Courses , Videos , Posts] and Make ADD and Delete -->
    @if((Request::segment(3) == 'courses' || Request::segment(3) == 'videos' || Request::segment(3) == 'posts') && Request::segment(5) == 'edit')
    <script>
        $(document).ready(function() {
            // This Function To Get All Comments
            function getComments() {
                $.ajax({
                    url: "{{ route('dashboard.'. Request::segment(3) .'Comments') }}",
                    type: "get",
                    data: {
                        id: '{{ Request::segment(4) }}',
                    },
                    success: function(data, textStatus, jqXHR) {
                        $('.direct-chat-messages').html(data);
                    },
                });
            }

            // Load Comments On Element
            getComments();

            // ADD Comment
            $("body").on("click", ".addComment", function(e) {
                e.preventDefault();
                var btn = $(this),
                    input = btn.parent('span').prev('input');
                if (input.val() != '') {
                    $.ajax({
                        url: "{{ route('dashboard.' . Request::segment(3) . 'Comments.save') }}",
                        type: "get",
                        data: {
                            comment: input.val(),
                            user: btn.data('user'),
                            model: btn.data('model'),
                        },
                        success: function(data, textStatus, jqXHR) {
                            $('.direct-chat-messages').html(data);
                            input.val('');
                            $('.box-tools span').text(parseInt($('.box-tools span').text()) + 1);
                        }
                    });
                }
            });

            // Delete Comment
            $("body").on("click", ".deleteComment", function(e) {
                e.preventDefault();
                var btn = $(this);
                swal({
                    title: "Are you sure to delete this row?",
                    text: "You will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: ["No, cancel it!", "Yes, I am sure!"],
                    dangerMode: true
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('dashboard.' . Request::segment(3) . 'Comments.delete') }}",
                            type: "get",
                            data: {
                                id: btn.data('comment_id'),
                            },
                            success: function(data, textStatus, jqXHR) {
                                getComments();
                                $('.box-tools span').text(parseInt($('.box-tools span').text()) - 1);
                            }
                        });
                    }
                });
            });
        });
    </script>
    @endif
    <!-- /End Display Comments -->

    <script>
        $(document).ready(function () {
            $("body").on("click", "tr.check", function(e) {
                var ele = $(this).find('input[type=checkbox]');
                if(ele.prop('checked') == true)
                {
                    ele.prop("checked", false);
                } else {
                    ele.prop("checked", true);
                }
            });
            $("body").on("click", "tr td input[type=checkbox]", function(e) {
                if($(this).prop('checked') == true)
                {
                    $(this).prop("checked", false);
                } else {
                    $(this).prop("checked", true);
                }
            });
        
        });
    </script>

    @stack('js')

</body>

</html>