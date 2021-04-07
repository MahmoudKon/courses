<!-- Teacher -->
<div class="sidebar_section">
    <div class="sidebar_section_title">Teacher</div>
    <div class="sidebar_teacher">
        <div class="teacher_title_container d-flex flex-row align-items-center justify-content-start">
            <div class="teacher_image"><img src="{{ $course->user->image_path }}" alt=""></div>
            <div class="teacher_title">
                <div class="teacher_name"><a href="#">{{ $course->user->name }}</a></div>
                <div class="teacher_position">{{ $course->user->email }}</div>
            </div>
        </div>
        <div class="teacher_meta_container">
            <!-- Teacher Rating -->
            <div class="teacher_meta d-flex flex-row align-items-center justify-content-start">
                <div class="teacher_meta_title">Average Rating:</div>
                <div class="teacher_meta_text ml-auto"><span>4.7</span><i class="fa fa-star" aria-hidden="true"></i></div>
            </div>
            <!-- Teacher Review -->
            <div class="teacher_meta d-flex flex-row align-items-center justify-content-start">
                <div class="teacher_meta_title">Review:</div>
                <div class="teacher_meta_text ml-auto"><span>12k</span><i class="fa fa-comment" aria-hidden="true"></i></div>
            </div>
            <!-- Teacher Quizzes -->
            <div class="teacher_meta d-flex flex-row align-items-center justify-content-start">
                <div class="teacher_meta_title">Quizzes:</div>
                <div class="teacher_meta_text ml-auto"><span>600</span><i class="fa fa-user" aria-hidden="true"></i></div>
            </div>
        </div>
        <div class="teacher_info">
            <p>Hi! I am Masion, I’m a marketing & management eros pulvinar velit laoreet, sit amet egestas erat dignissim. Sed quis rutrum tellus, sit amet viverra felis. Cras sagittis sem sit amet urna feugiat rutrum nam nulla ipsum.</p>
        </div>
    </div>
</div>
