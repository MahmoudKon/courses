@if(isset($slider))
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/plugins/simpleslider/css/jquery.animateSlider.css') }}">
    <style>
        .carousel-item::after{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background: rgba(0,0,0,.3);
            z-index: 4;
        }
        .carousel-item .carousel-caption{
            background: rgba(0,0,0,.6);
            z-index: 5;
        }
        .carousel-item .carousel-caption h5{
            font-size: 30px;
            color: #EEE;
        }
        .carousel-item .carousel-caption p{
            font-size: 19px;
            color: #AAA;
        }
    </style>
@endpush
<div class="home">
    <!-- Home Slider -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 100%">
        <ol class="carousel-indicators">
            @foreach($slider->images as $index=>$image)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" style="height: 100%">
            @foreach($slider->images as $index=>$image)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="height: 100%">
                <img class="d-block w-100" src="{{ $image->image_path }}" alt="First slide">
                <div class="carousel-caption d-none d-md-block mb-5">
                    <h5>{!! $image->title !!}</h5>
                    <p>{!! $image->description !!}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Home Slider Nav -->
</div>

@push('js')
    <script>$(document).ready(function(){$('.carousel').carousel();});</script>
@endpush
@else{
    <style>
        body{
            padding-top: 100px;
        }
    </style>
}
@endif
