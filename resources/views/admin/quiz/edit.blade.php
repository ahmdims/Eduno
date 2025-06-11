@extends('layouts.admin')

@section('title', 'Edit Quiz')

@section('content')
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <form id="kt_ecommerce_add_question_form" class="form" action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
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
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="questions-container">
                                        @foreach($quiz->questions as $index => $question)
                                        <div class="question-card card mb-7" data-question-id="{{ $index+1 }}">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3>Question {{ $index+1 }}</h3>
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
                                                    <textarea class="form-control" name="questions[{{ $index+1 }}][question]" rows="3"
                                                        placeholder="Write your question here">{{ $question->question }}</textarea>
                                                </div>

                                                <label class="form-label mb-4">Answer Options</label>

                                                <div class="options-container">
                                                    @foreach($question->options as $optionIndex => $option)
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio"
                                                                    name="questions[{{ $index+1 }}][answer]"
                                                                    value="{{ $optionIndex+1 }}"
                                                                    {{ $question->answer == ($optionIndex+1) ? 'checked' : '' }} />
                                                            </div>
                                                            <input type="text" class="form-control"
                                                                name="questions[{{ $index+1 }}][options][{{ $optionIndex+1 }}]"
                                                                placeholder="Option {{ chr(65 + $optionIndex) }}"
                                                                value="{{ $option->option_text }}"/>
                                                            <span class="badge badge-success ms-2 correct-answer-badge"
                                                                style="{{ $question->answer == ($optionIndex+1) ? 'display: inline-block;' : 'display: none;' }}">
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

            @include('template.admin-footer')
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let questionCounter = {{ count($quiz->questions) }};

            document.getElementById('add-question').addEventListener('click', function() {
                questionCounter++;
                const questionTemplate = document.querySelector('.question-card').cloneNode(true);
                questionTemplate.dataset.questionId = questionCounter;

                // Update question number
                const questionTitle = questionTemplate.querySelector('h3');
                questionTitle.textContent = `Question ${questionCounter}`;

                // Clear and update question textarea
                const textarea = questionTemplate.querySelector('textarea');
                textarea.name = `questions[${questionCounter}][question]`;
                textarea.value = '';

                // Update radio buttons
                const radioButtons = questionTemplate.querySelectorAll('input[type="radio"]');
                radioButtons.forEach((radio, index) => {
                    radio.name = `questions[${questionCounter}][answer]`;
                    radio.checked = index === 0;
                });

                // Update option inputs
                const optionInputs = questionTemplate.querySelectorAll('.option-item input[type="text"]');
                optionInputs.forEach((input, index) => {
                    input.name = `questions[${questionCounter}][options][${index + 1}]`;
                    input.value = '';
                    input.placeholder = `Option ${String.fromCharCode(65 + index)}`;
                });

                // Reset correct answer badges
                questionTemplate.querySelectorAll('.correct-answer-badge').forEach(badge => {
                    badge.style.display = 'none';
                });

                // Show badge for first option if it's checked
                if (radioButtons[0].checked) {
                    const firstBadge = radioButtons[0].closest('.option-item').querySelector('.correct-answer-badge');
                    firstBadge.style.display = 'inline-block';
                }

                document.getElementById('questions-container').appendChild(questionTemplate);
            });

            document.addEventListener('click', function(e) {
                // Remove question
                if (e.target.classList.contains('remove-question')) {
                    const questionCard = e.target.closest('.question-card');
                    if (document.querySelectorAll('.question-card').length > 1) {
                        questionCard.remove();

                        // Renumber remaining questions
                        const allQuestions = document.querySelectorAll('.question-card');
                        allQuestions.forEach((card, index) => {
                            const questionId = index + 1;
                            card.dataset.questionId = questionId;
                            card.querySelector('h3').textContent = `Question ${questionId}`;

                            // Update question textarea name
                            card.querySelector('textarea').name = `questions[${questionId}][question]`;

                            // Update radio buttons
                            const radioButtons = card.querySelectorAll('input[type="radio"]');
                            radioButtons.forEach(radio => {
                                radio.name = `questions[${questionId}][answer]`;
                            });

                            // Update option inputs
                            const optionInputs = card.querySelectorAll('.option-item input[type="text"]');
                            optionInputs.forEach((input, optIndex) => {
                                input.name = `questions[${questionId}][options][${optIndex + 1}]`;
                                input.placeholder = `Option ${String.fromCharCode(65 + optIndex)}`;
                            });
                        });

                        questionCounter = allQuestions.length;
                    } else {
                        Swal.fire({
                            text: "There must be at least one question",
                            icon: "warning",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                }

                // Add option
                if (e.target.classList.contains('add-option')) {
                    const optionsContainer = e.target.closest('.card-body').querySelector('.options-container');
                    const questionId = e.target.closest('.question-card').dataset.questionId;
                    const optionCount = optionsContainer.querySelectorAll('.option-item').length;

                    if (optionCount >= 6) {
                        Swal.fire({
                            text: "Maximum 6 options per question",
                            icon: "warning",
                            buttonsStyling: false,
                            confirmButtonText: "OK",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        return;
                    }

                    const optionLetter = String.fromCharCode(65 + optionCount);
                    const optionNumber = optionCount + 1;

                    const optionHtml = `
                        <div class="option-item mb-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <input class="form-check-input correct-answer-radio"
                                        type="radio"
                                        name="questions[${questionId}][answer]"
                                        value="${optionNumber}" />
                                </div>
                                <input type="text" class="form-control"
                                    name="questions[${questionId}][options][${optionNumber}]"
                                    placeholder="Option ${optionLetter}" />
                                <span class="badge badge-success ms-2 correct-answer-badge" style="display: none;">
                                    Correct Answer
                                </span>
                            </div>
                        </div>
                    `;

                    optionsContainer.insertAdjacentHTML('beforeend', optionHtml);
                }
            });
        });

        function updateCorrectAnswerBadges(questionId) {
            const questionContainer = document.querySelector(`.question-card[data-question-id="${questionId}"]`);
            const correctAnswerRadio = questionContainer.querySelector('input[type="radio"]:checked');

            questionContainer.querySelectorAll('.correct-answer-badge').forEach(badge => {
                badge.style.display = 'none';
            });

            if (correctAnswerRadio) {
                const selectedBadge = correctAnswerRadio.closest('.option-item').querySelector('.correct-answer-badge');
                selectedBadge.style.display = 'inline-block';
            }
        }

        // Initialize correct answer badges
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.question-card').forEach(card => {
                updateCorrectAnswerBadges(card.dataset.questionId);
            });

            // Add event listeners for radio buttons
            document.addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('correct-answer-radio')) {
                    const questionId = e.target.closest('.question-card').dataset.questionId;
                    updateCorrectAnswerBadges(questionId);
                }
            });
        });
    </script>
@endsection
