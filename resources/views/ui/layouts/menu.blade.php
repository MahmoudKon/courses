<div class="home">
    <div class="breadcrumbs_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="/home">Home</a></li>
                            @if(Request::segment(2) != '')
                            <li><a href="/{{ Request::segment(1) }}">{{ Request::segment(1) }}</a></li>
                            <li>{{ Request::segment(2) }}</li>
                            @else
                            <li>{{ Request::segment(1) }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
