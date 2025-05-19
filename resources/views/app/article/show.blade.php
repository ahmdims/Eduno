@extends('layouts.main')

@section('title', $article->title)

@section('content')
    <main>
        <div class="rbt-course-details-area pb--30">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-12">
                        <div class="course-details-content">
                            <div class="section-title text-center pt--50">
                                <h1 class="rbt-card-title">{{ $article->title }}</h1>
                            </div>
                            <div class=" rbt-card-img ptb--20">
                                <img class=" w-100 custom-rounded"
                                    src="{{ $article->thumbnail ? asset('storage/' . $article->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                    alt="{{ $article->title }}">
                            </div>

                            <div class="pt--30">
                                {!! $article->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rbt-separator-mid">
            <div class="container">
                <hr class="rbt-separator m-0">
            </div>
        </div>

        <div class="rbt-related-course-area bg-color-white rbt-section-gapBottom mt--60">
            <div class="container">
                <div class="section-title pb--30">
                    <h4 class="title title-wrapper">More Article</h4>
                </div>
                <div class="rbt-course-grid-column">
                    @foreach ($relatedArticles as $relatedArticle)
                        <div class="course-grid-3">
                            <div class="rbt-card variation-03 rbt-hover">
                                <div class="rbt-card-img">
                                    <a class="thumbnail-link" href="{{ route('article.show', $relatedArticle->slug) }}">
                                        <img src="{{ $relatedArticle->thumbnail ? asset('storage/' . $relatedArticle->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                            alt="{{ $relatedArticle->title }}">
                                        <span class="rbt-btn btn-white icon-hover">
                                            <span class="btn-text">Read More</span>
                                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                                        </span>
                                    </a>
                                </div>
                                <div class="rbt-card-body">
                                    <h5 class="rbt-card-title"><a
                                            href="{{ route('article.show', $relatedArticle->slug) }}">{{ $relatedArticle->title }}</a>
                                    </h5>
                                    <div class="rbt-card-bottom">
                                        <a class="transparent-button"
                                            href="{{ route('article.show', $relatedArticle->slug) }}">
                                            <i>
                                                <svg width="17" height="12" xmlns="http://www.w3.org/2000/svg">
                                                    <g stroke="#27374D" fill="none" fill-rule="evenodd">
                                                        <path d="M10.614 0l5.629 5.629-5.63 5.629" />
                                                        <path stroke-linecap="square" d="M.663 5.572h14.594" />
                                                    </g>
                                                </svg>
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </main>
@endsection
