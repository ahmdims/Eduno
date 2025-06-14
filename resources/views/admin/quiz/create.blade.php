@extends('layouts.admin')

@section('title', 'Create Quiz')

@section('content')
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <form id="kt_ecommerce_add_question_form" class="form" action="{{ route('admin.quiz.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $courses->first()->id }}">
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
                                        <input type="text" name="title" class="form-control mb-2"
                                            placeholder="Judul soal" value="{{ old('title') }}" required />
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
                                                    <div id="editor-1" class="form-control" style="height: 150px;"></div>
                                                    <input type="hidden" name="questions[1][question]" id="quill-input-1" required>
                                                </div>

                                                <label class="form-label mb-4">Answer Option</label>

                                                <div class="options-container">
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio" name="questions[1][answer]" value="1" checked required />
                                                            </div>
                                                            <input type="text" class="form-control" name="questions[1][options][1]"
                                                                placeholder="Option A" required />
                                                            <span class="badge badge-success ms-2 correct-answer-badge">Jawaban Benar</span>
                                                        </div>
                                                    </div>
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio" name="questions[1][answer]" value="2" />
                                                            </div>
                                                            <input type="text" class="form-control" name="questions[1][options][2]"
                                                                placeholder="Option B" required />
                                                            <span class="badge badge-success ms-2 correct-answer-badge" style="display: none;">Jawaban Benar</span>
                                                        </div>
                                                    </div>
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio" name="questions[1][answer]" value="3" />
                                                            </div>
                                                            <input type="text" class="form-control" name="questions[1][options][3]"
                                                                placeholder="Option C" required />
                                                            <span class="badge badge-success ms-2 correct-answer-badge" style="display: none;">Jawaban Benar</span>
                                                        </div>
                                                    </div>
                                                    <div class="option-item mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="form-check form-check-custom form-check-solid me-5">
                                                                <input class="form-check-input correct-answer-radio"
                                                                    type="radio" name="questions[1][answer]" value="4" />
                                                            </div>
                                                            <input type="text" class="form-control" name="questions[1][options][4]"
                                                                placeholder="Option D" required />
                                                            <span class="badge badge-success ms-2 correct-answer-badge" style="display: none;">Jawaban Benar</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-sm btn-light-primary add-option mt-2">
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
                                <a href="{{ route('admin.quiz.index') }}" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">
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

            @include('template.footer')
        </div>
    </div>

    <!-- Include Quill stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Include Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endsection
