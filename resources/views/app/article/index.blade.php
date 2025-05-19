@extends('layouts.main')

@section('title', 'Article')

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

                                <div class=" title-wrapper">
                                    <h1 class="title mb--0">@yield('title')</h1>
                                </div>

                                <p class="description">Helpful blogs to guide you through whatever you’re
                                    learning right now.</p>
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
                                        <span class="course-index">Showing {{ $articles->count() }}
                                            results</span>
                                    </div>
                                </div>
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
                            @foreach ($articles as $article_data)
                                <div class="course-grid-3" data-title="{{ strtolower($article_data->title) }}"
                                    data-category-id="{{ $article_data->category_id }}">
                                    <div class="rbt-card variation-03 rbt-hover">
                                        <div class="rbt-card-img">
                                            <a class="thumbnail-link"
                                                href="{{ route('article.show', $article_data->slug) }}">
                                                <img src="{{ $article_data->thumbnail ? asset('storage/' . $article_data->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                                    alt="{{ $article_data->title }}">
                                                <span class="rbt-btn btn-white icon-hover">
                                                    <span class="btn-text">Read More</span>
                                                    <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="rbt-card-body">
                                            <h5 class="rbt-card-title"><a
                                                    href="{{ route('article.show', $article_data->slug) }}">{{ $article_data->title }}</a>
                                            </h5>
                                            <div class="rbt-card-bottom">
                                                <a class="transparent-button"
                                                    href="{{ route('article.show', $article_data->slug) }}">
                                                    <i><svg width="17" height="12"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <g stroke="#27374D" fill="none" fill-rule="evenodd">
                                                                <path d="M10.614 0l5.629 5.629-5.63 5.629" />
                                                                <path stroke-linecap="square" d="M.663 5.572h14.594" />
                                                            </g>
                                                        </svg></i>
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
