<div class="rbt-team-modal modal fade rbt-modal-default" id="quizModal" tabindex="-1" aria-labelledby="quizModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('quiz.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="title" class="form-label">Title <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div id="questions-container">
                        <!-- Soal akan ditambahkan di sini secara dinamis -->
                    </div>

                    <div class="mb-4">
                        <label for="answer" class="form-label">Answer <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="answer" name="answer" required>
                    </div>

                    <button type="button" class="btn btn-sm btn-primary" id="add-question-btn">Tambah Soal</button>
                    <button type="button" class="btn btn-sm btn-danger" id="remove-question-btn">Hapus Soal</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rbt-btn btn-sm btn-border" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="rbt-btn btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let questionCount = 0; // Menyimpan jumlah soal
    const maxQuestions = 5; // Batas maksimal soal
    const minOptions = 2;  // Minimal opsi
    const maxOptions = 6;  // Maksimal opsi

    // Menambahkan soal baru
    document.getElementById('add-question-btn').addEventListener('click', function() {
        if (questionCount < maxQuestions) {
            questionCount++;
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('mb-4');
            questionDiv.id = 'question-' + questionCount;
            questionDiv.innerHTML = `
                <label for="question-${questionCount}" class="form-label">Question ${questionCount} <small class="text-danger">*</small></label>
                <input type="hidden" class="form-control" id="question-${questionCount}" name="questions[${questionCount}][question]" required>
                <trix-editor input="question-${questionCount}"></trix-editor>
                <label for="options-${questionCount}" class="form-label">Options <small class="text-danger">*</small></label>
                <div id="options-container-${questionCount}">
                    <input type="text" class="form-control mb-2" name="questions[${questionCount}][options][]" placeholder="Option 1" required>
                    <input type="text" class="form-control mb-2" name="questions[${questionCount}][options][]" placeholder="Option 2" required>
                </div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addOption(${questionCount})">Tambah Opsi</button>
                <button type="button" class="btn btn-sm btn-danger mt-2" onclick="removeOption(${questionCount})">Hapus Opsi</button>
                <div class="mb-4">
                    <label for="answer-${questionCount}" class="form-label">Answer <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="questions[${questionCount}][answer]" id="answer-${questionCount}" required>
                </div>
            `;
            document.getElementById('questions-container').appendChild(questionDiv);
        }
    });

    // Fungsi untuk menambahkan opsi
    function addOption(questionId) {
        const optionsContainer = document.getElementById(`options-container-${questionId}`);
        const optionsCount = optionsContainer.getElementsByTagName('input').length;
        
        if (optionsCount < maxOptions) {
            const newOption = document.createElement('input');
            newOption.type = 'text';
            newOption.classList.add('form-control', 'mb-2');
            newOption.name = `questions[${questionId}][options][]`;
            newOption.placeholder = `Option ${optionsCount + 1}`;
            optionsContainer.appendChild(newOption);
        }
    }

    // Fungsi untuk menghapus opsi
    function removeOption(questionId) {
        const optionsContainer = document.getElementById(`options-container-${questionId}`);
        const optionsCount = optionsContainer.getElementsByTagName('input').length;
        
        if (optionsCount > minOptions) {
            optionsContainer.removeChild(optionsContainer.lastElementChild);
        }
    }
</script>
