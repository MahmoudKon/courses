<!DOCTYPE html>
<html lang="en">

<head>
    <title>Unicat</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Unicat project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/bootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    @stack('css')
</head>

<body>

    <div class="super_container">

        <!-- Header -->

        <header class="header">

            <!-- Top Bar -->
            <div class="top_bar">
                <div class="top_bar_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                                    <ul class="top_bar_contact_list">
                                        <li>
                                            <div class="question">Have any questions?</div>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <div>011-5645-55369</div>
                                        </li>
                                        <li>
                                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                            <div>mahmoud_mohammed050684@gmail.com</div>
                                        </li>
                                    </ul>
                                    @if(auth()->user() == null)
                                    <div class="top_bar_login ml-auto">
                                        <div class="login_button">
                                            <a href="{{ route('user.login') }}">Register or Login</a>
                                        </div>
                                        @else
                                        <div class="top_bar_login ml-auto">
                                            <div class="login_button">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <span class="hidden-xs">{{ auth()->user()->name }}</span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    {{--<!-- Logout -->--}}
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('profile', auth()->user()->id) }}" class="btn btn-default btn-flat" style="line-height: 15px;">Profile</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('dashboard.welcome') }}" class="btn btn-default btn-flat" style="line-height: 15px;">Dashboard</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('user.logout') }}" class="btn btn-default btn-flat" style="line-height: 15px;">Logout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Header Content -->
                <div class="header_container">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="header_content d-flex flex-row align-items-center justify-content-start">
                                    <div class="logo_container">
                                        <a href="#">
                                            <div class="logo_text">Del<span>ta</span></div>
                                        </a>
                                    </div>
                                    <nav class="main_nav_contaner ml-auto">
                                        <ul class="main_nav">
                                            <li class="{{ Request::segment(1) == 'home' ? 'active' : '' }}"><a href="/home">Home</a></li>
                                            <li class="{{ Request::segment(1) == 'about' ? 'active' : '' }}"><a href="/about">About</a></li>
                                            <li class="{{ Request::segment(1) == 'courses' ? 'active' : '' }}"><a href="/courses">Courses</a></li>
                                            <li class="{{ Request::segment(1) == 'posts' ? 'active' : '' }}"><a href="/posts">Posts</a></li>
                                            <li class="{{ Request::segment(1) == 'page' ? 'active' : '' }}"><a href="/page">Page</a></li>
                                            <li class="{{ Request::segment(1) == 'contact' ? 'active' : '' }}"><a href="/contact">Contact</a></li>
                                        </ul>

                                        <!-- Hamburger -->
                                        @if(auth()->user() != null)
                                        <div class="shopping_cart">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                    <span><img src="{{ auth()->user()->image_path }}" width="30px"></span>
                                                    <span>{{ auth()->user()->name }}</span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    {{--<!-- Logout -->--}}
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('profile', auth()->user()->id) }}" class="btn btn-default btn-flat" style="line-height: 15px;">Profile</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('dashboard.welcome') }}" class="btn btn-default btn-flat" style="line-height: 15px;">Dashboard</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="{{ route('user.logout') }}" class="btn btn-default btn-flat" style="line-height: 15px;">Logout</a>
                                                    </li>
                                                </ul>
                                        </div>
                                        @endif
                                        <div class="hamburger menu_mm">
                                            <i class="fa fa-bars menu_mm" aria-hidden="true"></i>
                                        </div>
                                    </nav>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </header>

        <!-- Menu -->

        <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
            <div class="menu_close_container">
                <div class="menu_close">
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="search">
                <form action="#" class="header_search_form menu_mm">
                    <input type="search" class="search_input menu_mm" placeholder="Search" required="required">
                    <button class="header_search_button d-flex flex-column align-items-center justify-content-center menu_mm">
                        <i class="fa fa-search menu_mm" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
            <nav class="menu_nav">
                <ul class="menu_mm">
                    <li class="menu_mm"><a href="#">Home</a></li>
                    <li class="menu_mm"><a href="#">About</a></li>
                    <li class="menu_mm"><a href="#">Courses</a></li>
                    <li class="menu_mm"><a href="#">Blog</a></li>
                    <li class="menu_mm"><a href="#">Page</a></li>
                    <li class="menu_mm"><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
