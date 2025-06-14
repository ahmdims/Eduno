"use strict";

var KTAdminEditQuestions = function () {
    return {
        init: function () {
            let questionCounter = 1;
            const quillEditors = {};

            // Initialize Quill editor for the first question
            initializeQuillEditor(1);

            document.getElementById('add-question').addEventListener('click', function() {
                questionCounter++;
                const questionTemplate = document.querySelector('.question-card').cloneNode(true);
                questionTemplate.dataset.questionId = questionCounter;

                // Update question number
                questionTemplate.querySelector('h3').textContent = `Soal ${questionCounter}`;

                // Update all question-related fields
                const questionId = questionCounter;
                const questionInputs = questionTemplate.querySelectorAll('[name^="questions[1"]');

                questionInputs.forEach(input => {
                    const name = input.name.replace('questions[1]', `questions[${questionId}]`);
                    input.name = name;

                    if (input.type === 'radio') {
                        input.checked = false;
                    } else if (input.type === 'text') {
                        input.value = '';
                    }
                });

                // Update Quill editor
                const editorContainer = questionTemplate.querySelector('#editor-1');
                if (editorContainer) {
                    editorContainer.id = `editor-${questionId}`;
                    const hiddenInput = questionTemplate.querySelector('#quill-input-1');
                    hiddenInput.id = `quill-input-${questionId}`;
                    hiddenInput.name = `questions[${questionId}][question]`;
                    hiddenInput.value = '';

                    // Remove existing Quill instance if any
                    const existingEditor = quillEditors[`editor-${questionId}`];
                    if (existingEditor) {
                        existingEditor.destroy();
                    }
                }

                // Reset correct answer badge
                const badges = questionTemplate.querySelectorAll('.correct-answer-badge');
                badges.forEach(badge => {
                    badge.style.display = 'none';
                });
                // Show badge for first option
                badges[0].style.display = 'inline-block';

                // Add to DOM
                document.getElementById('questions-container').appendChild(questionTemplate);

                // Initialize Quill for the new question
                initializeQuillEditor(questionId);

                // Initialize tooltips
                const tooltipTriggerList = [].slice.call(questionTemplate.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });

            document.addEventListener('click', function(e) {
                // Remove question
                if (e.target.classList.contains('remove-question')) {
                    const questionCard = e.target.closest('.question-card');
                    if (document.querySelectorAll('.question-card').length > 1) {
                        questionCard.remove();
                        renumberQuestions();
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

                // Add option
                if (e.target.classList.contains('add-option')) {
                    const optionsContainer = e.target.closest('.card-body').querySelector('.options-container');
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

                    const optionNumber = optionCount + 1;
                    const optionLetter = String.fromCharCode(65 + optionCount);

                    const optionHtml = `
                        <div class="option-item mb-3">
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-custom form-check-solid me-5">
                                    <input class="form-check-input correct-answer-radio" type="radio"
                                        name="questions[${questionId}][answer]" value="${optionNumber}" />
                                </div>
                                <input type="text" class="form-control"
                                    name="questions[${questionId}][options][${optionNumber}]"
                                    placeholder="Pilihan ${optionLetter}" required />
                                <span class="badge badge-success ms-2 correct-answer-badge" style="display: none;">Jawaban Benar</span>
                            </div>
                        </div>
                    `;

                    optionsContainer.insertAdjacentHTML('beforeend', optionHtml);
                }

                // Update correct answer badge when radio button changes
                if (e.target.classList.contains('correct-answer-radio')) {
                    const questionId = e.target.closest('.question-card').dataset.questionId;
                    updateCorrectAnswerBadges(questionId);
                }
            });

            // Form submission handler
            document.getElementById('kt_ecommerce_add_question_form').addEventListener('submit', function(e) {
                // Update all Quill hidden inputs before form submission
                document.querySelectorAll('[id^="editor-"]').forEach(editorEl => {
                    const questionId = editorEl.id.split('-')[1];
                    const quillEditor = quillEditors[`editor-${questionId}`];
                    if (quillEditor) {
                        document.getElementById(`quill-input-${questionId}`).value = quillEditor.root.innerHTML;
                    }
                });
            });

            function initializeQuillEditor(questionId) {
                const editorId = `editor-${questionId}`;
                const quill = new Quill(`#${editorId}`, {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'header': 1 }, { 'header': 2 }],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'script': 'sub'}, { 'script': 'super' }],
                            [{ 'indent': '-1'}, { 'indent': '+1' }],
                            [{ 'direction': 'rtl' }],
                            [{ 'size': ['small', false, 'large', 'huge'] }],
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                            [{ 'color': [] }, { 'background': [] }],
                            [{ 'font': [] }],
                            [{ 'align': [] }],
                            ['clean'],
                            ['link', 'image', 'video']
                        ]
                    },
                    placeholder: 'Tulis pertanyaan di sini...'
                });

                // Store the editor instance
                quillEditors[editorId] = quill;

                // Update hidden input when editor content changes
                quill.on('text-change', function() {
                    document.getElementById(`quill-input-${questionId}`).value = quill.root.innerHTML;
                });
            }

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

            function renumberQuestions() {
                const allQuestions = document.querySelectorAll('.question-card');
                questionCounter = allQuestions.length;

                allQuestions.forEach((card, index) => {
                    const questionId = index + 1;
                    card.dataset.questionId = questionId;
                    card.querySelector('h3').textContent = `Soal ${questionId}`;

                    // Update all question-related fields
                    const questionInputs = card.querySelectorAll('[name^="questions["]');

                    questionInputs.forEach(input => {
                        const matches = input.name.match(/questions\[(\d+)\]/);
                        if (matches && matches[1]) {
                            const oldId = matches[1];
                            input.name = input.name.replace(`questions[${oldId}]`, `questions[${questionId}]`);
                        }
                    });

                    // Update Quill editor ID and hidden input
                    const editorContainer = card.querySelector('[id^="editor-"]');
                    const hiddenInput = card.querySelector('[id^="quill-input-"]');
                    if (editorContainer && hiddenInput) {
                        editorContainer.id = `editor-${questionId}`;
                        hiddenInput.id = `quill-input-${questionId}`;
                    }
                });
            }
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTAdminEditQuestions.init();
});
