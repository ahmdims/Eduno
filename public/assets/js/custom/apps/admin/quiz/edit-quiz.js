"use strict";

var KTAdminEditQuiz = function () {
    return {
        init: function () {
            // Inisialisasi counter dengan nilai default 1 atau ambil dari data attribute
            let questionCounter = parseInt(document.getElementById('questions-container').getAttribute('data-question-count')) || 1;

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
                if (radioButtons[0] && radioButtons[0].checked) {
                    const firstBadge = radioButtons[0].closest('.option-item').querySelector(
                        '.correct-answer-badge');
                    if (firstBadge) {
                        firstBadge.style.display = 'inline-block';
                    }
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
                            card.querySelector('textarea').name =
                                `questions[${questionId}][question]`;

                            // Update radio buttons
                            const radioButtons = card.querySelectorAll('input[type="radio"]');
                            radioButtons.forEach(radio => {
                                radio.name = `questions[${questionId}][answer]`;
                            });

                            // Update option inputs
                            const optionInputs = card.querySelectorAll(
                                '.option-item input[type="text"]');
                            optionInputs.forEach((input, optIndex) => {
                                input.name =
                                    `questions[${questionId}][options][${optIndex + 1}]`;
                                input.placeholder =
                                    `Option ${String.fromCharCode(65 + optIndex)}`;
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
                    const optionsContainer = e.target.closest('.card-body').querySelector(
                        '.options-container');
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

            // Initialize correct answer badges
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
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTAdminEditQuiz.init();
});
