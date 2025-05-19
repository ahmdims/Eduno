@extends('layouts.learning')

@section('title', $material->title)

@section('content')

    <div class="rbt-lesson-rightsidebar overflow-hidden">
        <div class="lesson-top-bar">
            <div class="lesson-top-left">
                <div class="rbt-lesson-toggle">
                    <button class="lesson-toggle-active btn-round-white-opacity" title="Toggle Sidebar">
                        <i class="feather-arrow-left"></i>
                    </button>
                </div>
                <h5>{{ $material->course->title }}</h5>
            </div>
            <div class="lesson-top-right">
                <div class="rbt-btn-close">
                    <a href="{{ route('course.show', $material->course->slug) }}"
                        title="Go Back to {{ $material->course->title }}" class="rbt-round-btn">
                        <i class="feather-x"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="inner">
            @if ($material->video)
                <div class="plyr__video-embed rbtplayer">
                    <iframe src="{{ $material->video }}" allowfullscreen allow="autoplay"></iframe>
                </div>
            @endif
            <div class="content">
                <div class="section-title">
                    <h4>{{ $material->title }}</h4>
                    <p>{!! $material->content !!}</p>
                </div>
            </div>
        </div>
        <div class="bg-color-extra2 ptb--15 overflow-hidden">
            <div class="rbt-button-group">
                @php
                    $previous = $material->course->materials
                        ->where('id', '<', $material->id)
                        ->sortByDesc('id')
                        ->first();
                    $next = $material->course->materials
                        ->where('id', '>', $material->id)
                        ->sortBy('id')
                        ->first();
                @endphp

                @if ($previous)
                    <a class="rbt-btn icon-hover icon-hover-left btn-md bg-primary-opacity"
                        href="{{ route('materials.show', ['slug' => $material->course->slug, 'material' => $previous->id]) }}">
                        <span class="btn-icon"><i class="feather-arrow-left"></i></span>
                        <span class="btn-text">Previous</span>
                    </a>
                @endif

                @if ($next)
                    <a class="rbt-btn icon-hover btn-md"
                        href="{{ route('materials.show', ['slug' => $material->course->slug, 'material' => $next->id]) }}">
                        <span class="btn-text">Next</span>
                        <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                    </a>
                @endif
            </div>
        </div>
    </div>

@endsection
