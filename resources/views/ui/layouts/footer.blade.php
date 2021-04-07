	<!-- Footer -->
	<footer class="footer">
	    <div class="footer_background" style="background-image:url('{{ asset('ui/images/footer_background.png') }}')"></div>
	    <div class="container">
	        <div class="row footer_row">
	            <div class="col">
	                <div class="footer_content">
	                    <div class="row">

	                        <div class="col-lg-3 footer_col">

	                            <!-- Footer About -->
	                            <div class="footer_section footer_about">
	                                <div class="footer_logo_container">
	                                    <a href="#">
	                                        <div class="footer_logo_text">Del<span>ta</span></div>
	                                    </a>
	                                </div>
	                                <div class="footer_about_text">
	                                    <p>Lorem ipsum dolor sit ametium, consectetur adipiscing elit.</p>
	                                </div>
	                                <div class="footer_social">
	                                    <ul>
	                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
	                                        <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
	                                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
	                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
	                                    </ul>
	                                </div>
	                            </div>

	                        </div>

	                        <div class="col-lg-3 footer_col">

	                            <!-- Footer Contact -->
	                            <div class="footer_section footer_contact">
	                                <div class="footer_title">Contact Us</div>
	                                <div class="footer_contact_info">
	                                    <ul>
	                                        <li>Email: Info.deercreative@gmail.com</li>
	                                        <li>Phone: +(88) 111 555 666</li>
	                                        <li>40 Baria Sreet 133/2 New York City, United States</li>
	                                    </ul>
	                                </div>
	                            </div>

	                        </div>

	                        <div class="col-lg-3 footer_col">

	                            <!-- Footer links -->
	                            <div class="footer_section footer_links">
	                                <div class="footer_title">Contact Us</div>
	                                <div class="footer_links_container">
	                                    <ul>
	                                        <li><a href="index.html">Home</a></li>
	                                        <li><a href="about.html">About</a></li>
	                                        <li><a href="contact.html">Contact</a></li>
	                                        <li><a href="#">Features</a></li>
	                                        <li><a href="courses.html">Courses</a></li>
	                                        <li><a href="#">Events</a></li>
	                                        <li><a href="#">Gallery</a></li>
	                                        <li><a href="#">FAQs</a></li>
	                                    </ul>
	                                </div>
	                            </div>

	                        </div>

	                        <div class="col-lg-3 footer_col clearfix">

	                            <!-- Footer links -->
	                            <div class="footer_section footer_mobile">
	                                <div class="footer_title">Mobile</div>
	                                <div class="footer_mobile_content">
	                                    <div class="footer_image"><a href="#"><img src="{{ asset('ui/images/mobile_1.png') }}" alt=""></a></div>
	                                    <div class="footer_image"><a href="#"><img src="{{ asset('ui/images/mobile_2.png') }}" alt=""></a></div>
	                                </div>
	                            </div>

	                        </div>

	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="row copyright_row">
	            <div class="col">
	                <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
	                    <div class="cr_text">
	                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
	                        Copyright &copy;<script>
	                            document.write(new Date().getFullYear());
	                        </script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
	                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
	                    </div>
	                    <div class="ml-lg-auto cr_links">
	                        <ul class="cr_list">
	                            <li><a href="#">Copyright notification</a></li>
	                            <li><a href="#">Terms of Use</a></li>
	                            <li><a href="#">Privacy Policy</a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</footer>
</div>

<!-- Modal -->
<div class="modal fade" id="sign" tabindex="-1" role="dialog" aria-labelledby="signModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 650px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('register.course') }}" method="get" id="form_sign">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            @csrf
                            <input type="hidden" name="course_id" id=course_id>
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" placeholder="@lang('site.email')" value="" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" name="phone" class="form-control" placeholder="@lang('site.phone')" value="" required>
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div>

                            <div id="errors"></div>
                        </div>
                        <div class="col-md-5">
                            <img class="coures-image img-bordered img-thumbnail" width="100%">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script src="{{ asset('ui/js/jquery-3.2.1.min.js') }}"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="{{ asset('ui/styles/bootstrap4/popper.js') }}"></script>
	<script src="{{ asset('ui/styles/bootstrap4/bootstrap.min.js') }}"></script>
	<script src="{{ asset('ui/plugins/greensock/TweenMax.min.js') }}"></script>
	<script src="{{ asset('ui/plugins/greensock/TimelineMax.min.js') }}"></script>
	<script src="{{ asset('ui/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
	<script src="{{ asset('ui/plugins/greensock/animation.gsap.min.js') }}"></script>
	<script src="{{ asset('ui/plugins/greensock/ScrollToPlugin.min.js') }}"></script>
	<script src="{{ asset('ui/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('ui/plugins/easing/easing.js') }}"></script>

    @stack('js')

    <script>
        $(function() {
            $('body').on('click', '.sign', function(e) {
                e.preventDefault();
                $('input[type=email], input[type=text], input[type=hidden]').val('');
                $('#form_sign .modal-title').text('');
                $('#form_sign .coures-image').attr('src', '');
                $('#errors').text('');

                var btn = $(this);
                var title = btn.closest('.course').find('.course_title').text();
                var image = btn.closest('.course').find('.course_image img').attr('src');

                $('input[name=course_id]').val(btn.data('id'));
                $('.modal-title').text(title);
                $('.coures-image').attr('src', image);
            });

            $('body').on('submit', '#form_sign', function(e) {
                e.preventDefault();
                $('#errors').text('');
                var url = $(this).attr('action'),
                    data = $(this).serialize();

                $.ajax({
                    url: url,
                    type: "get",
                    data: data,
                    success: function(data, textStatus, jqXHR) {
                        if(data.code){
                            alert(data.message);
                            $("#sign").modal('hide');
                        } else if(!data.code){
                            $('#errors').append('<p class="alert alert-danger" style="padding: 5px 10px;margin: 5px;">' + data.message + '</p>');
                        }
                    },
                    error: function (xhr) {
                        $.each(xhr.responseJSON.errors, function (key, val) {
                            $('#errors').append('<p class="alert alert-danger" style="padding: 5px 10px;margin: 5px;">' + val[0] + '</p>');
                        });
                    }
                });
            });
        });
    </script>

	</body>

	</html>
