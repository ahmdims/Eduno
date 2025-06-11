@extends('layouts.admin')

@section('title', 'Create Quiz')

@section('content')
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <form id="kt_ecommerce_add_question_form" class="form" data-kt-redirect="categories.html">
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Upload Soal</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Quiz Title</label>

                                        <input type="text" name="question_set_title" class="form-control mb-2"
                                            placeholder="Judul soal" value="{{ old('title') }}" />
                                        <div class="text-muted fs-7">Berikan judul untuk kumpulan soal ini
                                            (contoh: "Ulangan Harian Matematika Kelas 10")</div>
                                    </div>

                                    <div id="questions-container">
                                        <div class="question-card card mb-7" data-question-id="1">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3>Soal 1</h3>
                                                </div>
                                                <div class="card-toolbar">
                                                    <button type="button"
                                                        class="btn btn-sm btn-icon btn-danger remove-question"
                                                        data-bs-toggle="tooltip" title="Hapus Soal">
                                                        <i class="ki-outline ki-trash fs-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <div class="mb-5 fv-row">
                                                    <label class="required form-label">Question</label>

                                                    <textarea class="form-control" name="question" rows="3" placeholder="Tulis pertanyaan di sini"></textarea>
                                                </div>

                                                <div class="mb-5 fv-row">
                                                    <label class="form-label">Image</label>

                                                    <input type="file" class="form-control" name="image"
                                                        accept="image/*" />
                                                </div>

                                                <label class="form-label mb-4">Answer Option</label>

                                                <div class="options-container">
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio" name="option" value="1" checked />
                                                            </div>
                                                            <input type="text" class="form-control" name="option"
                                                                placeholder="Option A" />
                                                            <span class="badge badge-success ms-2 correct-answer-badge"
                                                                style="display: none;">Jawaban Benar</span>
                                                        </div>
                                                    </div>
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio" name="option" value="2" />
                                                            </div>
                                                            <input type="text" class="form-control" name="option"
                                                                placeholder="Option B" />
                                                            <span class="badge badge-success ms-2 correct-answer-badge"
                                                                style="display: none;">Jawaban Benar</span>
                                                        </div>
                                                    </div>
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio" name="option" value="3" />
                                                            </div>
                                                            <input type="text" class="form-control" name="option"
                                                                placeholder="Option C" />
                                                            <span class="badge badge-success ms-2 correct-answer-badge"
                                                                style="display: none;">Jawaban Benar</span>
                                                        </div>
                                                    </div>
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio" name="option" value="4" />
                                                            </div>
                                                            <input type="text" class="form-control" name="option"
                                                                placeholder="Option D" />
                                                            <span class="badge badge-success ms-2 correct-answer-badge"
                                                                style="display: none;">Jawaban Benar</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button"
                                                    class="btn btn-sm btn-light-primary add-option mt-2">
                                                    <i class="ki-outline ki-plus fs-3"></i> Tambah Pilihan
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" id="add-question" class="btn btn-primary">
                                        <i class="ki-outline ki-plus fs-2"></i> Tambah Soal
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="products.html" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
                                    Batal
                                </a>

                                <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Simpan Soal
                                    </span>
                                    <span class="indicator-progress">
                                        Harap tunggu... <span
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
            let questionCounter = 1;

            document.getElementById('add-question').addEventListener('click', function() {
                questionCounter++;
                const questionTemplate = document.querySelector('.question-card').cloneNode(true);
                questionTemplate.dataset.questionId = questionCounter;

                const questionTitle = questionTemplate.querySelector('h3');
                questionTitle.textContent = `Soal #${questionCounter}`;

                const textarea = questionTemplate.querySelector('textarea');
                textarea.name = `questions[${questionCounter}][text]`;
                textarea.value = '';

                const fileInput = questionTemplate.querySelector('input[type="file"]');
                fileInput.name = `questions[${questionCounter}][image]`;
                fileInput.value = '';

                const radioButtons = questionTemplate.querySelectorAll('input[type="radio"]');
                const optionInputs = questionTemplate.querySelectorAll(
                    '.option-item input[type="text"]');

                radioButtons.forEach((radio, index) => {
                    radio.name = `questions[${questionCounter}][correct_answer]`;
                    radio.checked = index === 0;
                });

                optionInputs.forEach((input, index) => {
                    input.name = `questions[${questionCounter}][options][${index + 1}]`;
                    input.value = '';
                    input.placeholder = `Pilihan ${String.fromCharCode(65 + index)}`;
                });

                document.getElementById('questions-container').appendChild(questionTemplate);

                const tooltipTriggerList = [].slice.call(questionTemplate.querySelectorAll(
                    '[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-question')) {
                    const questionCard = e.target.closest('.question-card');
                    if (document.querySelectorAll('.question-card').length > 1) {
                        questionCard.remove();

                        const allQuestions = document.querySelectorAll('.question-card');
                        allQuestions.forEach((card, index) => {
                            const questionId = index + 1;
                            card.dataset.questionId = questionId;
                            card.querySelector('h3').textContent = `Soal #${questionId}`;

                            card.querySelector('textarea').name =
                                `questions[${questionId}][text]`;
                            card.querySelector('input[type="file"]').name =
                                `questions[${questionId}][image]`;

                            const radioButtons = card.querySelectorAll(
                                'input[type="radio"]');
                            radioButtons.forEach(radio => {
                                radio.name =
                                    `questions[${questionId}][correct_answer]`;
                            });

                            const optionInputs = card.querySelectorAll(
                                '.option-item input[type="text"]');
                            optionInputs.forEach((input, optIndex) => {
                                input.name =
                                    `questions[${questionId}][options][${optIndex + 1}]`;
                                input.placeholder =
                                    `Pilihan ${String.fromCharCode(65 + optIndex)}`;
                            });
                        });

                        questionCounter = allQuestions.length;
                    } else {
                        Swal.fire({
                            text: "Setidaknya harus ada satu soal",
                            icon: "warning",
                            buttonsStyling: false,
                            confirmButtonText: "Mengerti",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                }

                if (e.target.classList.contains('add-option')) {
                    const optionsContainer = e.target.closest('.card-body').querySelector(
                        '.options-container');
                    const questionId = e.target.closest('.question-card').dataset.questionId;
                    const optionCount = optionsContainer.querySelectorAll('.option-item').length;

                    if (optionCount >= 10) {
                        Swal.fire({
                            text: "Maksimal 10 pilihan untuk setiap soal",
                            icon: "warning",
                            buttonsStyling: false,
                            confirmButtonText: "Mengerti",
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
                                    <input class="form-check-input correct-answer-radio" type="radio" name="questions[${questionId}][correct_answer]" value="${optionNumber}" />
                                </div>
                                <input type="text" class="form-control" name="questions[${questionId}][options][${optionNumber}]" placeholder="Pilihan ${optionLetter}" />
                                <span class="badge badge-success ms-2 correct-answer-badge" style="display: none;">Jawaban Benar</span>
                            </div>
                        </div>
                    `;

                    optionsContainer.insertAdjacentHTML('beforeend', optionHtml);
                }
            });
        });
    </script>

    <script>
        function updateCorrectAnswerBadges(questionId) {
            const questionContainer = document.querySelector(`.question-card[data-question-id="${questionId}"]`);
            const correctAnswerRadio = questionContainer.querySelector('input[type="radio"]:checked');

            questionContainer.querySelectorAll('.correct-answer-badge').forEach(badge => {
                badge.style.display = 'none';
            });

            if (correctAnswerRadio) {
                const selectedBadge = correctAnswerRadio.closest('.option-item').querySelector('.correct-answer-badge');
                if (selectedBadge) {
                    selectedBadge.style.display = 'inline-block';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCorrectAnswerBadges(1);

            document.addEventListener('change', function(e) {
                if (e.target && e.target.classList.contains('correct-answer-radio')) {
                    const questionId = e.target.closest('.question-card').dataset.questionId;
                    updateCorrectAnswerBadges(questionId);
                }
            });
        });
    </script>
@endsection
