@extends('layouts.admin')

@section('title', 'Edit Quiz')

@section('content')
<div class="app-container container-xxl">
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div class="app-container container-xxl">

                    <div class="card mb-10">
                        <div
                            class="card-header border-0 pt-6 pb-4 d-flex flex-wrap justify-content-between align-items-center gap-4">
                            <div class="card-title">
                                <h2 class="fw-bold mb-0">Edit Quiz - {{ $quiz->title }}</h2>
                            </div>
                        </div>

                        <form action="{{ route('admin.quiz.update', $quiz->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body pt-0">
                                <div class="row g-10">
                                    <div class="col-md-6">
                                        <div class="mb-10 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Title</label>
                                            <input type="text" name="title" value="{{ old('title', $quiz->title) }}"
                                                class="form-control form-control-solid" required />
                                        </div>

                                        <div class="mb-10 fv-row">
                                            <label class="required fs-5 fw-semibold mb-2">Course</label>
                                            <select name="course_id" class="form-select form-select-solid"
                                                data-control="select2" data-placeholder="Select Course" required>
                                                <option value="" disabled>Select Course</option>
                                                @foreach ($courses as $course)
                                                <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ?
                                                    'selected' : '' }}>
                                                    {{ $course->title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-10 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Created At</label>
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ $quiz->created_at->format('d F Y H:i') }}" disabled />
                                        </div>

                                        <div class="mb-10 fv-row">
                                            <label class="fs-5 fw-semibold mb-2">Updated At</label>
                                            <input type="text" class="form-control form-control-solid"
                                                value="{{ $quiz->updated_at->format('d F Y H:i') }}" disabled />
                                        </div>
                                    </div>
                                </div>

                                @php
                                $questions = json_decode(old('questions', $quiz->question), true) ?? [];
                                @endphp

                                <h3 class="mt-8 mb-4">Questions</h3>

                                <div id="questions-container">
                                    @foreach ($questions as $index => $question)
                                    <div class="card mb-5 p-4 question-item" data-index="{{ $index }}">
                                        <div class="mb-3">
                                            <label class="required fs-6 fw-semibold mb-1">Question {{ $index + 1
                                                }}</label>
                                            <input type="text" name="questions[{{ $index }}][question]"
                                                class="form-control form-control-solid"
                                                value="{{ $question['question'] ?? '' }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required fs-6 fw-semibold mb-1">Options</label>
                                            <div class="options-container">
                                                @foreach ($question['options'] as $optIndex => $option)
                                                <div class="input-group mb-2 option-item">
                                                    <input type="text"
                                                        name="questions[{{ $index }}][options][{{ $optIndex }}]"
                                                        class="form-control form-control-solid" value="{{ $option }}"
                                                        required>
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm btn-remove-option"
                                                        title="Remove option">&times;</button>
                                                </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-secondary btn-sm btn-add-option">Add
                                                Option</button>
                                        </div>

                                        <div class="mb-3">
                                            <label class="required fs-6 fw-semibold mb-1">Answer</label>
                                            <input type="text" name="questions[{{ $index }}][answer]"
                                                class="form-control form-control-solid"
                                                value="{{ $question['answer'] ?? '' }}" required>
                                        </div>

                                        <button type="button" class="btn btn-danger btn-sm btn-remove-question">Remove
                                            Question</button>
                                    </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-primary mb-5" id="btn-add-question">Add New
                                    Question</button>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">Save Changes</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            @include('template.footer')
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let questionsContainer = document.getElementById('questions-container');
        let addQuestionBtn = document.getElementById('btn-add-question');

        function createOptionInput(questionIndex, optionIndex, value = '') {
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2', 'option-item');

            const input = document.createElement('input');
            input.type = 'text';
            input.name = `questions[${questionIndex}][options][${optionIndex}]`;
            input.className = 'form-control form-control-solid';
            input.value = value;
            input.required = true;

            const btnRemove = document.createElement('button');
            btnRemove.type = 'button';
            btnRemove.className = 'btn btn-danger btn-sm btn-remove-option';
            btnRemove.title = 'Remove option';
            btnRemove.innerHTML = '&times;';
            btnRemove.addEventListener('click', () => div.remove());

            div.appendChild(input);
            div.appendChild(btnRemove);

            return div;
        }

        function createQuestionItem(index) {
            const card = document.createElement('div');
            card.className = 'card mb-5 p-4 question-item';
            card.dataset.index = index;

            card.innerHTML = `
                <div class="mb-3">
                    <label class="required fs-6 fw-semibold mb-1">Question ${index + 1}</label>
                    <input type="text" name="questions[${index}][question]" class="form-control form-control-solid" required>
                </div>
                <div class="mb-3">
                    <label class="required fs-6 fw-semibold mb-1">Options</label>
                    <div class="options-container"></div>
                    <button type="button" class="btn btn-secondary btn-sm btn-add-option">Add Option</button>
                </div>
                <div class="mb-3">
                    <label class="required fs-6 fw-semibold mb-1">Answer</label>
                    <input type="text" name="questions[${index}][answer]" class="form-control form-control-solid" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm btn-remove-question">Remove Question</button>
            `;

            // Add initial 2 option inputs
            const optionsContainer = card.querySelector('.options-container');
            optionsContainer.appendChild(createOptionInput(index, 0));
            optionsContainer.appendChild(createOptionInput(index, 1));

            // Event add option
            card.querySelector('.btn-add-option').addEventListener('click', () => {
                const currentOptions = optionsContainer.querySelectorAll('input').length;
                if (currentOptions < 6) {
                    optionsContainer.appendChild(createOptionInput(index, currentOptions));
                } else {
                    alert('Maximum 6 options allowed');
                }
            });

            // Remove question
            card.querySelector('.btn-remove-question').addEventListener('click', () => {
                card.remove();
                updateQuestionLabels();
            });

            // Remove option buttons
            optionsContainer.addEventListener('click', e => {
                if (e.target.classList.contains('btn-remove-option')) {
                    e.target.closest('.option-item').remove();
                }
            });

            return card;
        }

        function updateQuestionLabels() {
            const questionItems = questionsContainer.querySelectorAll('.question-item');
            questionItems.forEach((item, i) => {
                item.dataset.index = i;
                item.querySelector('label').textContent = `Question ${i + 1}`;
                item.querySelector('input[name^="questions"][name$="[question]"]').name = `questions[${i}][question]`;
                item.querySelector('input[name^="questions"][name$="[answer]"]').name = `questions[${i}][answer]`;

                // Update options names
                const options = item.querySelectorAll('.options-container input');
                options.forEach((opt, j) => {
                    opt.name = `questions[${i}][options][${j}]`;
                });
            });
        }

        addQuestionBtn.addEventListener('click', () => {
            const newIndex = questionsContainer.querySelectorAll('.question-item').length;
            if (newIndex < 5) {
                const newQuestion = createQuestionItem(newIndex);
                questionsContainer.appendChild(newQuestion);
            } else {
                alert('Maximum 5 questions allowed');
            }
        });

        // Attach event listeners to existing option remove buttons
        questionsContainer.querySelectorAll('.btn-remove-option').forEach(btn => {
            btn.addEventListener('click', e => {
                e.target.closest('.option-item').remove();
            });
        });

        // Attach event listeners to add option buttons and remove question buttons on existing questions
        questionsContainer.querySelectorAll('.question-item').forEach(card => {
            const optionsContainer = card.querySelector('.options-container');

            card.querySelector('.btn-add-option').addEventListener('click', () => {
                const currentOptions = optionsContainer.querySelectorAll('input').length;
                if (currentOptions < 6) {
                    const questionIndex = parseInt(card.dataset.index);
                    optionsContainer.appendChild(createOptionInput(questionIndex, currentOptions));
                } else {
                    alert('Maximum 6 options allowed');
                }
            });

            card.querySelector('.btn-remove-question').addEventListener('click', () => {
                card.remove();
                updateQuestionLabels();
            });
        });
    });
</script>
@endsection
