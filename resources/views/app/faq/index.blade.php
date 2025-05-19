@extends('layouts.main')

@section('title', 'Faq')

@section('content')

    <main>
        <div class="rbt-breadcrumb-default ptb--100 ptb_md--50 ptb_sm--30 bg-gradient-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-inner text-center">
                            <h2 class="title">@yield('title')</h2>
                            <ul class="page-list">
                                <li class="rbt-breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li>
                                    <div class="icon-right"><i class="feather-chevron-right"></i></div>
                                </li>
                                <li class="rbt-breadcrumb-item active">@yield('title')</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rbt-accordion-area accordion-style-1 bg-color-white rbt-section-gap">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="rbt-accordion-style accordion">
                            <div class="section-title text-center mb--60">
                                <h2 class="title">Have a Question about <br> ClasXpert?</h2>
                                <p class="description has-medium-font-size mt--20">E-learning lets you access education
                                    online, anytime and anywhere, at your own pace.</p>
                            </div>
                            <div class="rbt-accordion-style rbt-accordion-04 accordion" id="accordionExample">
                                @foreach ($faqs as $index => $faq_data)
                                    <div class="accordion-item card">
                                        <h2 class="accordion-header card-header" id="heading{{ $index }}">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $index }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="collapse{{ $index }}">
                                                {{ $faq_data->question }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}"
                                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                            aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body card-body">
                                                {!! $faq_data->answer !!}
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

        <div class="rbt-callto-action rbt-cta-default style-3 mb--60">
            <div class="container content-wrapper">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-8">
                        <div class="inner">
                            <div class="content text-left">
                                <h2 class="title">Need more information?</h2>
                                <p class="title">Let us know what you need</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="call-to-btn text-start text-lg-end">
                            <a class="rbt-btn bg-white-opacity icon-hover" href="{{ route('app.contact.index') }}">
                                <span class="btn-text">Contact Us</span>
                                <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
