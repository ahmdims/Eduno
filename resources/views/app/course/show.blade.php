@extends('layouts.main')

@section('title', $course->title)

@section('content')
    <main>
        <div class="rbt-page-banner-wrapper">
            <div class="rbt-banner-image"></div>
            <div class="rbt-banner-content">
                <div class="rbt-banner-content-top rbt-breadcrumb-style-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="content text-center">

                                    <div
                                        class="d-flex align-items-center flex-wrap justify-content-center mb--15 rbt-course-details-feature">
                                        <div class="feature-sin total-review">
                                            <span class="rbt-badge-4">{{ $totalReviews }}
                                                review{{ $totalReviews > 1 ? 's' : '' }}</span>
                                        </div>
                                        <div class="feature-sin total-student">
                                            <span>{{ $studentCountText }}</span>
                                        </div>
                                    </div>
                                    <h2 class="title theme-gradient">{{ $course->title }}</h2>

                                    <ul class="rbt-meta">
                                        <li><i class="feather-tag"></i>{{ $course->category->name }}</li>
                                        <li><i class="feather-globe"></i>{{ $course->language }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rbt-section-overlayping-top rbt-section-gapBottom">
            <div class="inner">
                <div class="container">
                    <div class="col-lg-12">
                        <a class="video-popup-with-text video-popup-wrapper text-center popup-video mb--15"
                            href="{{ $course->video }}">
                            <div class="video-content">
                                <img class="w-100 rbt-radius"
                                    src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                    alt="{{ $course->title }}">
                                <div class="position-to-top">
                                    <span class="rbt-btn rounded-player-2 with-animation">
                                        <span class="play-icon"></span>
                                    </span>
                                </div>
                                <span class="play-view-text d-block color-white"><i class="feather-eye"></i> Preview this
                                    course</span>
                            </div>
                        </a>

                        <div class="row row--30 gy-5 pt--60">

                            <div class="col-lg-4">
                                <div class="course-sidebar sticky-top rbt-shadow-box rbt-gradient-border">
                                    <div class="inner">
                                        <div class="content-item-content">

                                            @if ($course->materials->isNotEmpty())
                                                <div class="add-to-card-button mt--15">
                                                    <a class="rbt-btn btn-gradient icon-hover w-100 d-block text-center"
                                                        href="{{ route('materials.show', ['slug' => $course->slug, 'material' => $course->materials->first()->id]) }}">
                                                        <span class="btn-text">Course</span>
                                                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="rbt-widget-details">
                                                <ul class="rbt-course-details-list-wrapper">
                                                    <li><span>Skill Level</span><span
                                                            class="rbt-feature-value rbt-badge-5">{{ $course->level }}</span>
                                                    </li>
                                                    <li><span>Language</span><span
                                                            class="rbt-feature-value rbt-badge-5">{{ $course->language }}</span>
                                                    </li>
                                                    <li><span>Lessons</span><span
                                                            class="rbt-feature-value rbt-badge-5">{{ $course->materials->count() }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">
                                <div class="course-details-content">
                                    <div class="rbt-inner-onepage-navigation sticky-top">
                                        <nav class="mainmenu-nav onepagenav">
                                            <ul class="mainmenu">
                                                <li class="current">
                                                    <a href="#overview">Overview</a>
                                                </li>
                                                <li>
                                                    <a href="#course">Course</a>
                                                </li>
                                                <li>
                                                    <a href="#review">Review</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>

                                    <div class="rbt-course-feature-box overview-wrapper rbt-shadow-box mt--30 has-show-more"
                                        id="overview">
                                        <div class="rbt-course-feature-inner has-show-more-inner-content">
                                            <div class="section-title">
                                                <h4 class="rbt-title-style-3">About Course</h4>
                                            </div>
                                            <p>{!! $course->description !!}</p>
                                        </div>
                                        <div class="rbt-show-more-btn">Show More</div>
                                    </div>

                                    <div class="course-content rbt-shadow-box coursecontent-wrapper mt--30" id="course">
                                        <div class="rbt-course-feature-inner">
                                            <div class="section-title">
                                                <h4 class="rbt-title-style-3">Course Content</h4>
                                            </div>
                                            <div class="rbt-accordion-style rbt-accordion-02 accordion">
                                                <div class="accordion" id="accordionExampleb2">

                                                    <div class="accordion-item card">
                                                        <h2 class="accordion-header card-header" id="headingTwo1">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo1"
                                                                aria-expanded="false" aria-controls="collapseTwo1">
                                                                Material
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo1" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo1">
                                                            <div class="accordion-body card-body pr--0">
                                                                <ul class="rbt-course-main-content liststyle">

                                                                    @foreach ($course->materials as $material)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('materials.show', ['slug' => $course->slug, 'material' => $material->id]) }}">
                                                                                <div class="course-content-left">
                                                                                    <i class="feather-file-text"></i> <span
                                                                                        class="text">{{ $material->title }}</span>
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
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo2"
                                                                aria-expanded="false" aria-controls="collapseTwo2">
                                                                Quiz
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo2" class="accordion-collapse collapse"
                                                            aria-labelledby="headingTwo2">
                                                            <div class="accordion-body card-body pr--0">
                                                                <ul class="rbt-course-main-content liststyle">

                                                                    @foreach ($course->quizzes as $quiz)
                                                                        <li>
                                                                            <a
                                                                                href="{{ route('quiz.show', ['slug' => $course->slug, 'quiz' => $quiz->id]) }}">
                                                                                <div class="course-content-left">
                                                                                    <i class="feather-help-circle"></i>
                                                                                    <span
                                                                                        class="text">{{ $quiz->title }}</span>
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

                                    @if (!$userReview)
                                        <div class="about-author-list rbt-shadow-box featured-wrapper mt--30 has-show-more"
                                            id="review">
                                            <div class="section-title">
                                                <h4 class="rbt-title-style-3">Post a Review</h4>
                                            </div>
                                            <form action="{{ route('course.storeReview', $course->slug) }}"
                                                method="POST">
                                                @csrf
                                                <div class="row row--10">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="review">Review</label>
                                                            <textarea id="review" name="review" required></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <button type="submit"
                                                            class="rbt-btn btn-gradient icon-hover radius-round btn-md">
                                                            <span class="btn-text">Post Review</span>
                                                            <span class="btn-icon"><i
                                                                    class="feather-arrow-right"></i></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @endif

                                    @if ($course->reviews->isNotEmpty())
                                        <div class="about-author-list rbt-shadow-box featured-wrapper mt--30 has-show-more"
                                            id="review">
                                            <div class="section-title">
                                                <h4 class="rbt-title-style-3">Review</h4>
                                            </div>
                                            <div class="has-show-more-inner-content rbt-featured-review-list-wrapper">
                                                @foreach ($course->reviews as $review)
                                                    <div class="rbt-course-review about-author">
                                                        <div class="media">
                                                            <div class="thumbnail">
                                                                <a
                                                                    href="{{ route('profile.index', $review->user->username) }}">
                                                                    <img src="{{ asset('assets/images/about/avatar.svg') }}"
                                                                        alt="{{ $review->user->name }}">
                                                                </a>
                                                            </div>
                                                            <div class="media-body">
                                                                <div class="author-info">
                                                                    <h5 class="title">
                                                                        <a
                                                                            href="{{ route('profile.index', $review->user->username) }}">
                                                                            {{ $review->user->name }}
                                                                        </a>
                                                                    </h5>
                                                                </div>
                                                                <div class="content">
                                                                    <p class="description">{{ $review->review }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="rbt-show-more-btn">Show More</div>
                                        </div>
                                    @endif

                                </div>

                                <div class="related-course mt--60">
                                    <div class="row g-5 align-items-end mb--40">
                                        <div class="col-lg-8 col-md-8 col-12">
                                            <div class="section-title">
                                                <h4 class="title">More <strong class="theme-gradient">Course</strong>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="read-more-btn text-start text-md-end">
                                                <a class="rbt-btn rbt-switch-btn btn-border btn-sm"
                                                    href="{{ route('courses.index') }}">
                                                    <span data-text="View All Course">View All Course</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-5">
                                        @foreach ($relatedCourses as $relatedCourse)
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-12" data-sal-delay="150"
                                                data-sal="slide-up" data-sal-duration="800">
                                                <div class="rbt-card variation-01 rbt-hover">
                                                    <div class="rbt-card-img">
                                                        <a href="{{ route('course.show', $relatedCourse->slug) }}">
                                                            <img src="{{ $relatedCourse->thumbnail ? asset('storage/' . $relatedCourse->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                                                alt="{{ $relatedCourse->title }}">
                                                        </a>
                                                    </div>
                                                    <div class="rbt-card-body">
                                                        <h4 class="rbt-card-title">
                                                            <a
                                                                href="{{ route('course.show', $relatedCourse->slug) }}">{{ $relatedCourse->title }}</a>
                                                        </h4>

                                                        <ul class="rbt-meta">
                                                            <li><i
                                                                    class="feather-book"></i>{{ count($relatedCourse->materials) }}
                                                                Lessons</li>
                                                            <li><span
                                                                    class="rbt-badge-5">{{ $relatedCourse->category->name }}</span>
                                                            </li>
                                                        </ul>
                                                        <div class="rbt-card-bottom">
                                                            <a class="rbt-btn-link"
                                                                href="{{ route('course.show', $relatedCourse->slug) }}">Learn
                                                                More<i class="feather-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
