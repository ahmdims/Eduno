<div class="rbt-lesson-area bg-color-white">
    <div class="rbt-lesson-content-wrapper">
        <div class="rbt-lesson-leftsidebar">
            <div class="rbt-course-feature-inner rbt-search-activation">
                <div class="section-title">
                    <h4 class="rbt-title-style-3">Course</h4>
                </div>

                <div class="rbt-accordion-style rbt-accordion-02 for-right-content accordion">
                    <div class="accordion" id="accordionExampleb2">

                        <div class="accordion-item card">
                            <h2 class="accordion-header card-header" id="headingTwo1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">
                                    Material
                                </button>
                            </h2>
                            <div id="collapseTwo1" class="accordion-collapse collapse" aria-labelledby="headingTwo1">
                                <div class="accordion-body card-body pr--0">
                                    <ul class="rbt-course-main-content liststyle">

                                        @foreach ($course->materials as $material)
                                            <li>
                                                <a
                                                    href="{{ route('materials.show', ['slug' => $course->slug, 'material' => $material->id]) }}">
                                                    <div class="course-content-left">
                                                        <i class="feather-file-text"></i>
                                                        <span class="text">{{ $material->title }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item card">
                            <h2 class="accordion-header card-header" id="headingTwo2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">
                                    Quiz
                                </button>
                            </h2>
                            <div id="collapseTwo2" class="accordion-collapse collapse" aria-labelledby="headingTwo2">
                                <div class="accordion-body card-body pr--0">
                                    <ul class="rbt-course-main-content liststyle">

                                        @foreach ($course->quizzes as $quiz)
                                            <li>
                                                <a
                                                    href="{{ route('quiz.show', ['slug' => $course->slug, 'quiz' => $quiz->id]) }}">
                                                    <div class="course-content-left">
                                                        <i class="feather-help-circle"></i>
                                                        <span class="text">{{ $quiz->title }}</span>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</div>
