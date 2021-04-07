@extends('layouts.app')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/course.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ui/styles/course_responsive.css') }}">
@endpush

@section('content')
@include('ui.layouts.menu')
    <div class="courses" style="padding-top: 57px; padding-bottom: 50px">
		<div class="container">
			<div class="row">

				<!-- Course Informations -->
				<div class="col-lg-8">

					<div class="course_container">
                        <div class="course_title">{{ $course->title }}</div>
                        <a href="/courses/videos?course={{ $course->id }}&name={{ str_replace(' ', '-', $course->title) }}" class="btn btn-sm btn-outline-info pull-right" >Start To Watch</a>
						<div class="course_info d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">

							<!-- Course Info Item -->
							<div class="course_info_item">
								<div class="course_info_title">Teacher:</div>
								<div class="course_info_text"><a href="#">{{ $course->user->name }}</a></div>
							</div>

							<!-- Course Info Item -->
							<div class="course_info_item">
								<div class="course_info_title">Reviews:</div>
								<div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div>
							</div>

							<!-- Course Info Item -->
							<div class="course_info_item">
								<div class="course_info_title">Categories:</div>
								<div class="course_info_text"><a href="/courses?name={{ str_replace(' ', '-', $course->category->name) }}&id={{ $course->category_id }}">{{ $course->category->name }}</a></div>
							</div>

						</div>

						<!-- Course Image -->
						<div class="course_image"><img src="{{ $course->image_path }}" width=100% alt=""></div>

						<!-- Course Tabs -->
						<div class="course_tabs_container">
							<div class="tabs d-flex flex-row align-items-center justify-content-start">
								<div class="tab active">description</div>
								<div class="tab">reviews</div>
							</div>
							<div class="tab_panels">

								<!-- Description -->
								<div class="tab_panel active">
									<div class="tab_panel_title">{{ $course->title }}</div>
									<div class="tab_panel_content">
										<div class="tab_panel_text">
											{{ $course->description }}
										</div>
									</div>
								</div>

								<!-- Reviews -->
								<div class="tab_panel tab_panel_3">
									<div class="tab_panel_title">Course Review</div>

									<!-- Rating -->
									<div class="review_rating_container">
										<div class="review_rating">
											<div class="review_rating_num">4.5</div>
											<div class="review_rating_stars">
												<div class="rating_r rating_r_4"><i></i><i></i><i></i><i></i><i></i></div>
											</div>
											<div class="review_rating_text">(28 Ratings)</div>
										</div>
										<div class="review_rating_bars">
											<ul>
												<li><span>5 Star</span><div class="review_rating_bar"><div style="width:90%;"></div></div></li>
												<li><span>4 Star</span><div class="review_rating_bar"><div style="width:75%;"></div></div></li>
												<li><span>3 Star</span><div class="review_rating_bar"><div style="width:32%;"></div></div></li>
												<li><span>2 Star</span><div class="review_rating_bar"><div style="width:10%;"></div></div></li>
												<li><span>1 Star</span><div class="review_rating_bar"><div style="width:3%;"></div></div></li>
											</ul>
										</div>
									</div>

									<!-- Comments -->
									@include('ui.single_course_page.comments')
								</div>

							</div>
						</div>
					</div>
				</div>

				<!-- Feature Sidebar -->
				<div class="col-lg-4">
					<div class="sidebar">

						<!-- Feature -->
						@include('ui.single_course_page.feature')

						<!-- Teacher -->
						@include('ui.single_course_page.teacher')

						<!-- Latest Course -->
						@include('ui.layouts.latest')

					</div>
                </div>

			</div>
		</div>
	</div>


@endsection

@push('js')
    <script src="{{ asset('ui/js/course.js') }}"></script>
    <script>
        $(document).ready(function() {
                $('form#post_comment').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "/courses/createComment",
                        type: "post",
                        data: $(this).serialize(),
                        success: function(data, textStatus, jqXHR) {
                            $('.comments_list').append(data);
                            $('form#post_comment').find('textarea').val('');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {

                        }
                    });
                });
            });
    </script>
@endpush
