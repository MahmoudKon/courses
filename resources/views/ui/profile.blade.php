@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/responsive.css') }}">
    <!-- css files -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('ui/profile/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('ui/profile/css/cobox.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('ui/profile/css/portfolio.css') }}">
    <link rel="stylesheet" type="text/css" media="all" href="{{ asset('ui/profile/css/style.css') }}">
    <!-- /css files -->
@endpush

@section('content')


    <!-- Banner -->
    <div class="banner">
        <ul class="rslides" id="slider">
            <li>
                <div class="banner-info">
                    <h3>Its My Life</h3>
                    <span class="line1"></span>
                    <p>Lorem Ipsum is dummy text.</p>
                    <span class="line2"></span>
                    <div class="social-icons">
                        <a href="#"><span class="facebook"></span></a>
                        <a href="#"><span class="twitter"></span></a>
                        <a href="#"><span class="linkedin"></span></a>
                        <a href="#"><span class="googleplus"></span></a>
                    </div>
                </div>
            </li>
            <li>
                <div class="banner-info">
                    <h3>My Passion</h3>
                    <span class="line1"></span>
                    <p>Lorem Ipsum is dummy text.</p>
                    <span class="line2"></span>
                    <div class="social-icons">
                        <a href="#"><span class="facebook"></span></a>
                        <a href="#"><span class="twitter"></span></a>
                        <a href="#"><span class="linkedin"></span></a>
                        <a href="#"><span class="googleplus"></span></a>
                    </div>
                </div>
            </li>
            <li>
                <div class="banner-info">
                    <h3>My Life Style</h3>
                    <span class="line1"></span>
                    <p>Lorem Ipsum is dummy text.</p>
                    <span class="line2"></span>
                    <div class="social-icons">
                        <a href="#"><span class="facebook"></span></a>
                        <a href="#"><span class="twitter"></span></a>
                        <a href="#"><span class="linkedin"></span></a>
                        <a href="#"><span class="googleplus"></span></a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- /Banner -->

    <!-- About -->
    <div class="about-me" id="about">
        <h3 class="text-center slideanim">About My Skills</h3>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="mydetails slideanim text-center">
                        <img class="img-circle img-responsive" src="{{ $user->image_path }}" alt="Generic placeholder image" width="200" height="200">
                        <h3>{{ $user->name }}</h3>
                        <p>Web Designer</p>
                        <div class="social-icons">
                            <a href="#"><span class="facebook"></span></a>
                            <a href="#"><span class="twitter"></span></a>
                            <a href="#"><span class="linkedin"></span></a>
                            <a href="#"><span class="googleplus"></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="myskills slideanim">
                        <h3 class="text-center">My Skill Info</h3>
                        <p class="skill-text">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <div class="skill-info">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h4>Photoshop</h4>
                                            </td>
                                            <td><span class="longline1"></span><span class="shortline1"></span></td>
                                            <td>
                                                <p>89%</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>Multimedia</h4>
                                            </td>
                                            <td><span class="longline2"></span><span class="shortline2"></span></td>
                                            <td>
                                                <p>90%</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>After-Effects</h4>
                                            </td>
                                            <td><span class="longline3"></span><span class="shortline3"></span></td>
                                            <td>
                                                <p>95%</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>Wordpress</h4>
                                            </td>
                                            <td><span class="longline4"></span><span class="shortline4"></span></td>
                                            <td>
                                                <p>92%</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h4>HTML5</h4>
                                            </td>
                                            <td><span class="longline5"></span><span class="shortline5"></span></td>
                                            <td>
                                                <p>96%</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /About -->

    <!-- Portfolio -->
    <div class="myportfolio" id="portfolio">
        <h3 class="text-center slideanim">My Courses</h3>
        <p class="text-center slideanim">My Recent Projects , Just "Click" on them to know More.</p>
        <section class="vertical" id="grid3d">
            <div class="grid-wrap">
                <div class="grid">
                @foreach($user->courses as $course)
                <figure style="height: 196px !important">
                    <img class="slideanim" src="{{ $course->image_path }}" alt="{{ $course->title }}"/>
                </figure>
                @endforeach
                </div>
            </div><!-- /grid-wrap -->
            <div class="content">
            @foreach($user->courses as $course)
                <div>
                    <div class="content-img" style="height: auto !important">
                        <img src="{{ $course->image_path }}" width="100%" class="img-responsive" alt="my projects">
                    </div>
                    <h3 class="content-text">{{ $course->title }}</h3>
                    <p class="content-text">{!! $course->description !!}</p>
                    <h3 class="text-center slideanim">Videos</h3>
                    <div class="row">
                        @foreach($course->videos as $video)
                        <div class="col-md-6">
                            <video style="width: 100%" controls>
                                <source src="{{ $video->video_path }}" type="">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
                <span class="loading"></span>
                <span class="icon close-content"></span>
            </div>
        </section>
    </div>
    <!-- /Portfolio -->

    <!-- Gallery -->
    <div class="mygallery" id="gallery">
        <h3 class="text-center slideanim">My Gallery</h3>
        <div class="text-center">
            @for($i = 1; $i < 13; $i++)
            <a href="{{ asset('ui/profile/images/me'.$i.'-'.$i.'.jpg') }}" title="My Image Gallery">
                <img src="{{ asset('ui/profile/images/me'.$i.'.jpg') }}" alt="example-1" class="img-responsive slideanim">
            </a>
            @endfor
        </div>

    </div>
    <!-- Gallery -->

@endsection

@push('js')
    <script src="{{ asset('ui/js/custom.js') }}"></script>
    <!-- js files -->
    <script src="{{ asset('ui/profile/js/modernizr.custom.js') }}"></script>
    <!-- /js files -->
    <!-- js files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('ui/profile/js/bootstrap.min.js') }}"></script>
    <!-- js files for banner slider -->
    <script src="{{ asset('ui/profile/js/responsiveslides.min.js') }}"></script>
    <script>
        $(window).load(function() {

            // Slideshow for banner
            $("#slider").responsiveSlides({
                maxwidth: 1920,
                speed: 1000
            });


        });
    </script>
    <!-- /js files for banner slider -->
    <!-- js files for portfolio -->
    <script src="{{ asset('ui/profile/js/classie.js') }}"></script>
    <script src="{{ asset('ui/profile/js/helper.js') }}"></script>
    <script src="{{ asset('ui/profile/js/grid3d.js') }}"></script>
    <script>
        new grid3D(document.getElementById('grid3d'));
    </script>
    <!-- /js files for portfolio -->

    <!-- js files for gallery -->
    <script type="text/javascript" src="{{ asset('ui/profile/js/cobox.js') }}"></script>
    <!-- /js files for gallery -->

    <!-- js for smooth scrolling -->
    <script>
        $(document).ready(function() {
            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function() {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            });
        })
    </script>
    <!-- /js for smooth scrolling -->

    <!-- js for sliding -->
    <script>
        $(window).scroll(function() {
            $(".slideanim").each(function() {
                var pos = $(this).offset().top;

                var winTop = $(window).scrollTop();
                if (pos < winTop + 600) {
                    $(this).addClass("slide");
                }
            });
        });
    </script>
    <!-- /js for sliding -->
    <!-- /js files -->
@endpush

