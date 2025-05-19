@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <main>
        <div class="rbt-slider-main-wrapper position-relative">
            <div class="swiper rbt-banner-activation rbt-slider-animation rbt-arrow-between">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="rbt-banner-area rbt-banner-6 variation-03"
                            style="background-image: url('{{ asset('assets/images/bg/bg-hero-1.png') }}'); background-position: center;"
                            data-gradient-overlay="5">
                            <div class="wrapper w-100">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12">
                                            <div class="inner text-center">
                                                <h1 class="title w-700">ClassXpert</h1>
                                                <h4 class="ft-title w-700 color-white">Unleash your full potential with
                                                    quality
                                                    materials with us!</h4>
                                                @guest
                                                    <div class="button-group mt--30">
                                                        <a class="rbt-btn" href="{{ route('register') }}">
                                                            <span>Start your journey</span>
                                                        </a>
                                                    </div>
                                                @endguest
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="rbt-banner-area rbt-banner-6 variation-03"
                            style="background-image: url('{{ asset('assets/images/bg/bg-hero-2.png') }}'); background-position: center;"
                            data-black-overlay="5">
                            <div class="wrapper w-100">
                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12">
                                            <div class="inner text-center">
                                                <h4 class="ft-title w-700 color-white">Learn Smarter with</h4>
                                                <h1 class="title w-700">ClassXpert</h1>
                                                <h4 class="ft-title w-700 color-white">Access quality resources and become
                                                    <br>
                                                    the best version of yourself!
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rbt-swiper-arrow rbt-arrow-left">
                    <div class="custom-overfolow">
                        <i class="rbt-icon feather-arrow-left"></i>
                        <i class="rbt-icon-top feather-arrow-left"></i>
                    </div>
                </div>

                <div class="rbt-swiper-arrow rbt-arrow-right">
                    <div class="custom-overfolow">
                        <i class="rbt-icon feather-arrow-right"></i>
                        <i class="rbt-icon-top feather-arrow-right"></i>
                    </div>
                </div>

            </div>

            <div class="swiper rbt-swiper-thumb rbtmySwiperThumb">
                <div class="swiper-wrapper">
                </div>
            </div>
        </div>

        <div class="rbt-course-area bg-color-extra2 rbt-section-gapTop">
            <div class="container">
                <div class="row pb--60">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title">Unlock Your Potential <br /> with <strong
                                    class="theme-gradient">ClassXpert</strong></h2>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    @foreach ($courses as $course)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="rbt-card variation-01 rbt-hover">
                                <div class="rbt-card-img">
                                    <a href="{{ route('course.show', $course->slug) }}">
                                        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                            alt="{{ $course->title }}">
                                    </a>
                                </div>
                                <div class="rbt-card-body mt--20">
                                    <h4 class="rbt-card-title"><a href="{{ route('course.show', $course->slug) }}">
                                            {{ $course->title }}</a></h4>
                                    <ul class="rbt-meta">
                                        <li><i class="feather-book"></i>{{ $course->lessons_count }} Lessons</li>
                                        <li><span class="rbt-badge-5">{{ $course->category->name }}</span></li>
                                    </ul>

                                    <div class="rbt-card-bottom">
                                        <a class="rbt-btn-link" href="{{ route('course.show', $course->slug) }}">Learn
                                            More<i class="feather-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row pb--60 pt--40">
                    <div class="col-lg-12">
                        <div class="load-more-btn btn-sm text-center">
                            <a class="rbt-btn btn-gradient btn-lg btn-sm hover-icon-reverse"
                                href="{{ route('courses.index') }}">
                                <span class="icon-reverse-wrapper">
                                    <span class="text-center">View All Course</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @guest
            <div class="rbt-call-to-action-area rbt-section-gap bg-gradient-6 rbt-call-to-action-5">
                <div class="wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="rbt-cta-5">
                                    <div class="content">
                                        <h4 class="title">
                                            Your Journey Begins Here.
                                            <br>Start
                                            <span class="header-caption">
                                                <span class="cd-headline clip is-full-width">
                                                    <span class="cd-words-wrapper">
                                                        <b class="theme-gradient is-hidden">Learning!</b>
                                                        <b class="theme-gradient is-visible">Study!</b>
                                                        <b class="theme-gradient is-hidden">Growth!</b>
                                                    </span>
                                                </span>
                                            </span>
                                        </h4>

                                        <div class="rbt-button-group justify-content-start">
                                            <a class="rbt-btn btn-gradient" href="{{ route('register') }}">Sign Up</a>
                                            <a class="rbt-btn btn-border" href="{{ route('login') }}">Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shape-images">
                    <img src="{{ asset('assets/images/bg/bg-cta.png') }}" alt="Call to Action">
                </div>
            </div>
        @endguest

        <div class="rbt-categories-area bg-color-white rbt-section-gapTop">
            <div class="container mb--60">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title"><strong class="theme-gradient">Discover Articles</strong> That <br />
                                Inspire
                                Growth and Learning</h2>
                        </div>
                    </div>
                </div>

                <div class="pt--60 row g-5">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="rbt-card variation-02 height-330 rbt-hover">
                            <div class="rbt-card-img">
                                <a href="{{ route('article.show', $articles[0]->slug) }}">
                                    <img src="{{ $articles[0]->thumbnail ? asset('storage/' . $articles[0]->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                        alt="{{ $articles[0]->title }}"> </a>
                            </div>
                            <div class="rbt-card-body">
                                <h3 class="rbt-card-title"><a
                                        href="{{ route('article.show', $articles[0]->slug) }}">{{ $articles[0]->title }}</a>
                                </h3>
                                <div class="rbt-card-bottom">
                                    <a class="transparent-button"
                                        href="{{ route('article.show', $articles[0]->slug) }}">Learn More<i
                                            class="feather-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        @foreach ($articles->skip(1) as $index => $article)
                            <div class="rbt-card card-list variation-02 rbt-hover {{ $index > 1 ? 'mt--30' : '' }}">
                                <div class="rbt-card-img">
                                    <a href="{{ route('article.show', $article->slug) }}">
                                        <img src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                            alt="{{ $article->title }}">
                                    </a>
                                </div>
                                <div class="rbt-card-body">
                                    <h5 class="rbt-card-title">
                                        <a href="{{ route('article.show', $article->slug) }}">
                                            {{ \Illuminate\Support\Str::words($article->title, 3) }}
                                        </a>
                                    </h5>
                                    <div class="rbt-card-bottom">
                                        <a class="transparent-button"
                                            href="{{ route('article.show', $article->slug) }}">Read
                                            Article<i class="feather-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row mt--50">
                    <div class="col-lg-12">
                        <div class="load-more-btn btn-sm text-center">
                            <a class="rbt-btn btn-gradient btn-lg btn-sm hover-icon-reverse"
                                href="{{ route('article.index') }}">
                                <span class="icon-reverse-wrapper">
                                    <span class=" text-center">Discover More Article</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="rbt-video-area bg-color-white rbt-section-gap" id="about">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="video-popup-wrapper">
                            <img class="w-100 rbt-radius" src="{{ asset('assets/images/bg/cover.png') }}"
                                alt="Video Images">
                            <a class="rbt-btn rounded-player popup-video position-to-top rbtplayer"
                                href="{{ $website->video }}">
                                <span><i class="feather-play"></i></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="inner pl--50 pl_lg--0 pl_md--0 pl_sm--0">
                            <div class="section-title text-start">
                                <h4 class="title">Why Choose <strong class="theme-gradient">ClassXpert</strong></h4>
                                <p class="description mt--30">ClassXpert offers engaging and practical learning methods to
                                    ensure you understand and apply new skills effectively.</p>
                                <div class="rbt-feature-wrapper mt--40">
                                    <div class="rbt-feature feature-style-1 align-items-center">
                                        <div class="icon bg-pink-opacity">
                                            <i class="feather-heart"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h6 class="feature-title">Flexible Classes</h6>
                                        </div>
                                    </div>

                                    <div class="rbt-feature feature-style-1 align-items-center">
                                        <div class="icon bg-pink-opacity">
                                            <i class="feather-book"></i>
                                        </div>
                                        <div class="feature-content">
                                            <h6 class="feature-title">Learn From Anywhere</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rbt-testimonial-area bg-color-white rbt-section-gapTop">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb--60">
                        <div class="section-title text-center">
                            <h2 class="title">Student's Feedback</h2>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    @foreach ($reviews as $review)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="rbt-testimonial-box">
                                <div class="inner">
                                    <div class="clint-info-wrapper">
                                        <div class="thumb">
                                            <img style="object-fit: cover; object-position: center; width: 100%; height: 100%;"
                                                src="{{ $review->user->profile ? asset('storage/' . $review->user->profile) : asset('assets/images/about/avatar.svg') }}"
                                                alt="{{ $review->user->name }}">
                                        </div>
                                        <div class="client-info">
                                            <h5 class="title">{{ $review->user->name }}</h5>
                                        </div>
                                    </div>
                                    <div class="description">
                                        <p class="subtitle-3">{{ $review->review }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="rbt-accordion-area accordion-style-1 bg-color-white rbt-section-gap">
            <div class="container">
                <div class="row mb--60">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title">Have a Question <br /> about
                                <strong class="theme-gradient">ClassXpert</strong>?
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row g-5 align-items-start">
                    <div class="rbt-accordion-style rbt-accordion-04 accordion">
                        <div class="accordion" id="faq">
                            @foreach ($faqs as $faq)
                                <div class="accordion-item card">
                                    <h2 class="accordion-header card-header" id="heading{{ $loop->iteration }}">
                                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->iteration }}"
                                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $loop->iteration }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->iteration }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#faq">
                                        <div class="accordion-body card-body">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
