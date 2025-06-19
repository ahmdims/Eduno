@extends('layouts.main')

@section('title', $quiz->title)

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-start">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-column flex-row-fluid">
                <!--begin::Toolbar wrapper--->
                <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                    <!--begin::Page title-->
                    <div class="page-title me-5">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                            {{ $quiz->title }}
                            <!--begin::Description-->
                            <span class="page-desc text-gray-600 fw-semibold fs-6 pt-3">
                                {{ $quiz->course->title ?? '' }}
                            </span>
                            <!--end::Description-->
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper--->
            </div>
            <!--end::Toolbar container--->
        </div>
    </div>
    <!--end::Toolbar-->

    <!--begin::Wrapper container-->
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div class="app-container container-xxl">
                        <div class="card">
                            <form id="quiz-form" action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
                                @csrf
                                <div class="card-body pt-0">
                                    @if($quiz->questions->count() > 0)
                                        @foreach ($quiz->questions as $index => $question)
                                            <div class="mb-10 question-container">
                                                <div class="mb-10">
                                                    <h3 class="fw-bold mb-10">{{ $index + 1 }}. {{ $question->question }}</h3>

                                                    <div class="mb-10">
                                                        @foreach ($question->options as $optionIndex => $option)
                                                            @php
                                                                $isChecked = session("quiz_{$quiz->id}_question_{$question->id}") == $option->id;
                                                            @endphp
                                                            <label class="d-flex align-items-center justify-content-between mb-6 cursor-pointer option-label"
                                                                   data-question-id="{{ $question->id }}"
                                                                   data-option-id="{{ $option->id }}">
                                                                <span class="d-flex align-items-center me-2">
                                                                    <span class="symbol symbol-50px me-6">
                                                                        <span class="symbol-label bg-light-primary">
                                                                            <span class="fs-4 text-primary">{{ chr(65 + $optionIndex) }}</span>
                                                                        </span>
                                                                    </span>
                                                                    <span class="d-flex flex-column">
                                                                        <span class="fw-bold fs-5">{{ $option->option_text }}</span>
                                                                    </span>
                                                                </span>
                                                                <span class="form-check form-check-custom form-check-solid">
                                                                    <input class="form-check-input option-radio"
                                                                           type="radio"
                                                                           name="question_{{ $question->id }}"
                                                                           value="{{ $option->id }}"
                                                                           {{ $isChecked ? 'checked' : '' }} />
                                                                </span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-danger">No questions available for this quiz.</p>
                                    @endif
                                </div>

                                <div class="card-footer py-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <button type="button" class="btn btn-light-primary me-3" id="save-draft">
                                                <i class="ki-duotone ki-check-circle fs-2 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                Selesai (Simpan Draft)
                                            </button>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-danger" id="submit-quiz">
                                                Submit (Final)
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quizForm = document.getElementById('quiz-form');
        const optionRadios = document.querySelectorAll('.option-radio');
        const saveDraftBtn = document.getElementById('save-draft');

        // Save draft answer to session
        function saveDraftAnswer(questionId, optionId) {
            return fetch("{{ route('quiz.save-draft', $quiz->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    question_id: questionId,
                    option_id: optionId
                })
            });
        }

        // Save all selected answers as draft
        async function saveAllDrafts() {
            const selectedOptions = document.querySelectorAll('.option-radio:checked');
            const savePromises = [];

            selectedOptions.forEach(radio => {
                const questionId = radio.name.replace('question_', '');
                const optionId = radio.value;
                savePromises.push(saveDraftAnswer(questionId, optionId));
            });

            await Promise.all(savePromises);
            return true;
        }

        // Event listeners for option selection
        optionRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                const questionId = this.name.replace('question_', '');
                const optionId = this.value;

                // Highlight selected option
                document.querySelectorAll(`.option-label[data-question-id="${questionId}"]`).forEach(opt => {
                    opt.classList.remove('bg-light-success');
                });
                this.closest('.option-label').classList.add('bg-light-success');

                // Save draft answer
                saveDraftAnswer(questionId, optionId);
            });
        });

        // Save draft button
        saveDraftBtn.addEventListener('click', async function(e) {
            e.preventDefault();

            const result = await saveAllDrafts();

            if (result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Draft Disimpan',
                    text: 'Jawaban Anda telah disimpan sebagai draft. Anda dapat kembali lagi nanti untuk menyelesaikan quiz.',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Highlight already selected answers from session
        document.querySelectorAll('.option-radio:checked').forEach(radio => {
            radio.closest('.option-label').classList.add('bg-light-success');
        });
    });
</script>

<style>
    .option-label {
        transition: all 0.3s ease;
        border-radius: 6px;
        padding: 8px;
        cursor: pointer;
    }
    .option-label:hover {
        background-color: #f8f9fa;
    }
    .option-label.bg-light-success {
        background-color: #e8fff3;
        border-left: 3px solid #50cd89;
    }
</style>
@endsection
