@extends('layouts.learning')

@section('title', $quiz->title)

@section('content')

    <div class="rbt-lesson-rightsidebar overflow-hidden">
        <div class="lesson-top-bar">
            <div class="lesson-top-left">
                <div class="rbt-lesson-toggle">
                    <button class="lesson-toggle-active btn-round-white-opacity" title="Toggle Sidebar">
                        <i class="feather-arrow-left"></i>
                    </button>
                </div>
                <h5>{{ $quiz->course->title }}</h5>
            </div>
            <div class="lesson-top-right">
                <div class="rbt-btn-close">
                    <a href="{{ route('course.show', $quiz->course->slug) }}" title="Go Back to {{ $quiz->course->title }}"
                        class="rbt-round-btn">
                        <i class="feather-x"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="inner">
            <div class="content">
                <h4>{{ $quiz->title }} - Result</h4>
                <hr>

                <div class="rbt-dashboard-table table-responsive mobile-table-750 mt--30 overflow-hidden">
                    <div>
                        <h5>Your Score: {{ $score }}</h5>
                    </div>
                </div>
            </div>

            <div class="bg-color-extra2 ptb--15 overflow-hidden">
                <div class="rbt-button-group">
                    @php
                        $previous = $quiz->course->quizzes
                            ->where('id', '<', $quiz->id)
                            ->sortByDesc('id')
                            ->first();
                        $next = $quiz->course->quizzes
                            ->where('id', '>', $quiz->id)
                            ->sortBy('id')
                            ->first();
                    @endphp

                    @if ($previous)
                        <a class="rbt-btn icon-hover icon-hover-left btn-md bg-primary-opacity"
                            href="{{ route('quiz.show', ['slug' => $quiz->course->slug, 'quiz' => $previous->id]) }}">
                            <span class="btn-icon"><i class="feather-arrow-left"></i></span>
                            <span class="btn-text">Previous</span>
                        </a>
                    @endif

                    @if ($next)
                        <a class="rbt-btn icon-hover btn-md"
                            href="{{ route('quiz.show', ['slug' => $quiz->course->slug, 'quiz' => $next->id]) }}">
                            <span class="btn-text">Next</span>
                            <span class="btn-icon"><i class="feather-arrow-right"></i></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
