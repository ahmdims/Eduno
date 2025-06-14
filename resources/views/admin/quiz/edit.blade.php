@extends('layouts.admin')

@section('title', 'Edit Quiz')

@section('content')
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <form id="kt_ecommerce_add_question_form" class="form"
                        action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Edit Quiz</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Quiz Title</label>
                                        <input type="text" name="title" class="form-control mb-2"
                                            placeholder="Quiz title" value="{{ old('title', $quiz->title) }}" />
                                        <div class="text-muted fs-7">Give a title for this quiz</div>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Course</label>
                                        <select name="course_id" class="form-select" required>
                                            <option value="">Select Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    {{ $quiz->course_id == $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="questions-container">
                                        @foreach ($quiz->questions as $index => $question)
                                            <div class="question-card card mb-7" data-question-id="{{ $index + 1 }}">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h3>Question {{ $index + 1 }}</h3>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-danger remove-question"
                                                            data-bs-toggle="tooltip" title="Delete Question">
                                                            <i class="ki-outline ki-trash fs-2"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="mb-5 fv-row">
                                                        <label class="required form-label">Question</label>
                                                        <textarea class="form-control" name="questions[{{ $index + 1 }}][question]" rows="3"
                                                            placeholder="Write your question here">{{ $question->question }}</textarea>
                                                    </div>

                                                    <label class="form-label mb-4">Answer Options</label>

                                                    <div class="options-container">
                                                        @foreach ($question->options as $optionIndex => $option)
                                                            <div class="option-item mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div
                                                                        class="form-check form-check-custom form-check-solid me-5">
                                                                        <input class="form-check-input correct-answer-radio"
                                                                            type="radio"
                                                                            name="questions[{{ $index + 1 }}][answer]"
                                                                            value="{{ $optionIndex + 1 }}"
                                                                            {{ $question->answer == $optionIndex + 1 ? 'checked' : '' }} />
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        name="questions[{{ $index + 1 }}][options][{{ $optionIndex + 1 }}]"
                                                                        placeholder="Option {{ chr(65 + $optionIndex) }}"
                                                                        value="{{ $option->option_text }}" />
                                                                    <span
                                                                        class="badge badge-success ms-2 correct-answer-badge"
                                                                        style="{{ $question->answer == $optionIndex + 1 ? 'display: inline-block;' : 'display: none;' }}">
                                                                        Correct Answer
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <button type="button"
                                                        class="btn btn-sm btn-light-primary add-option mt-2">
                                                        <i class="ki-outline ki-plus fs-3"></i> Add Option
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="button" id="add-question" class="btn btn-primary">
                                        <i class="ki-outline ki-plus fs-2"></i> Add Question
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.quiz.index') }}" class="btn btn-light me-5">
                                    Cancel
                                </a>

                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Save Quiz
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include('template.footer')
        </div>
    </div>
@endsection
