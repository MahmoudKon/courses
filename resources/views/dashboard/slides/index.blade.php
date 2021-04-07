@extends('layouts.dashboard.app')

@push('css')
<style>
    #showImage {
        position: absolute;
        background: rgba(0, 0, 0, .5);
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        z-index: 2;
    }

    #showImage div {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@endpush

@section('content')

<div class="content-wrapper">

    @include('dashboard.layouts.content-header')
    <!-- end of Content header -->

    <section class="content">
        <div id="showImage">
            <div>
                <img src="" width="100%">
            </div>
        </div>

        <div class="box box-primary">

            @php $columns = ['name'] @endphp
            @include('dashboard.layouts.box-header', ['columns' => $columns])
            <!-- end of box header -->

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.image_count')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                        </thead>

                        <!-- Loading Icon -->
                        <tr>
                            <td class="loading"> <i class="fa fa-cog fa-spin"></i> </td>
                        </tr>

                        <tbody id="dataRows">
                        </tbody>

                    </table><!-- end of table -->
                </div>
            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div><!-- end of content wrapper -->

@endsection

@push('js')
<script>
    $(function() {
        $('body').on('click', 'img', function() {
            var src = $(this).attr('src');
            $('#showImage').css('display', 'block').find('img').attr('src', src);
        });

        $('body').on('click', '#showImage', function(e) {
            $(this).css('display', 'none');
        });

        $('body').on('click', '#showImage img', function(e) {
            e.stopPropagation();
        });
    });
</script>
@endpush