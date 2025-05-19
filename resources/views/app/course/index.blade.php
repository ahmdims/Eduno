@extends('layouts.main')

@section('title', 'Course')

@section('content')
    <main>
        <div class="rbt-page-banner-wrapper">
            <div class="rbt-banner-image"></div>
            <div class="rbt-banner-content">

                <div class="rbt-banner-content-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="page-list">
                                    <li class="rbt-breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li>
                                        <div class="icon-right"><i class="feather-chevron-right"></i></div>
                                    </li>
                                    <li class="rbt-breadcrumb-item active">@yield('title')</li>
                                </ul>

                                <div class="title-wrapper">
                                    <h1 class="title mb--0">@yield('title')</h1>
                                </div>

                                <p class="description">Various courses according to the topic you need.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rbt-course-top-wrapper mt--40">
                    <div class="container">
                        <div class="row g-5 align-items-center">

                            <div class="col-lg-5 col-md-12">
                                <div class="rbt-sorting-list d-flex flex-wrap align-items-center">
                                    <div class="rbt-short-item">
                                        <span id="course-index" class="course-index">Showing {{ $courses->count() }}
                                            results</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-12">
                                <div
                                    class="rbt-sorting-list d-flex flex-wrap align-items-end justify-content-start justify-content-lg-end">
                                    <div class="rbt-short-item">
                                        <form id="search-form" action="#" class="rbt-search-style me-0"
                                            onsubmit="return false;">
                                            <input id="searchInput" type="text" placeholder="Search.." />
                                            <button class="rbt-search-btn rbt-round-btn">
                                                <i class="feather-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mt--60">
                                <ul class="rbt-portfolio-filter filter-tab-button justify-content-start nav nav-tabs"
                                    id="category-filters">
                                    <li class="nav-item active" data-category-id="">
                                        <button class="active" id="all-tab" type="button" role="tab"
                                            aria-controls="all" aria-selected="true">
                                            <span class="filter-text">All Course</span>
                                        </button>
                                    </li>
                                    @foreach ($categories as $category_data)
                                        <li class="nav-item" data-category-id="{{ $category_data->id }}">
                                            <button id="category-tab-{{ $category_data->id }}" type="button" role="tab"
                                                aria-controls="category-{{ $category_data->id }}" aria-selected="false">
                                                <span class="filter-text">{{ $category_data->name }}</span>
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rbt-section-overlayping-top rbt-section-gapBottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="rbt-course-grid-column mt--20" id="course-list">
                            @foreach ($courses as $course_data)
                                <div class="course-grid-3 course-item" data-title="{{ strtolower($course_data->title) }}"
                                    data-category-id="{{ $course_data->category_id }}">
                                    <div class="rbt-card variation-01 rbt-hover">
                                        <div class="rbt-card-img">
                                            <a href="{{ route('course.show', $course_data->slug) }}">
                                                <img src="{{ $course_data->thumbnail ? asset('storage/' . $course_data->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                                    alt="{{ $course_data->title }}">
                                            </a>
                                        </div>
                                        <div class="rbt-card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="rbt-card-title">
                                                    <a href="{{ route('course.show', $course_data->slug) }}">
                                                        {{ $course_data->title }}
                                                    </a>
                                                </h4>
                                            </div>

                                            <ul class="rbt-meta">
                                                <li><i class="feather-book"></i>{{ $course_data->materials->count() }} Lessons</li>
                                                <li><span class="rbt-badge-5">{{ $course_data->category->name }}</span></li>
                                            </ul>
                                            <div class="rbt-card-bottom">
                                                <a class="rbt-btn-link" href="{{ route('course.show', $course_data->slug) }}">Learn More
                                                    <i class="feather-arrow-right"></i>
                                                </a>
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
    </main>
@endsection
