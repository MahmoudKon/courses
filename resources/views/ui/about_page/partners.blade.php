<div class="partners">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="partners_slider_container">
                    <div class="owl-carousel owl-theme partners_slider">
                    @for($i = 1; $i < 7; $i++)
                        <!-- Partner Item -->
                        <div class="owl-item partner_item"><img src="{{ asset('ui/images/partner_' . $i . '.png') }}" alt=""></div>
                    @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
