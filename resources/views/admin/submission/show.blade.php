@extends('layouts.main')

@section('title', 'Submission Details')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-start">
        <div class="d-flex flex-column flex-row-fluid">
            <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                <div class="page-title me-5">
                    <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                        Submission Details
                        <span class="page-desc text-gray-600 fw-semibold fs-6 pt-3">
                            Detailed view of quiz submission
                        </span>
                    </h1>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.submission.index') }}" class="btn btn-flex btn-light fw-bold">
                        <i class="ki-duotone ki-arrow-left fs-4 me-2"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Toolbar-->

{{-- Previous head content remains the same --}}

<div class="app-container container-xxl">
    <div class="card">
        <div class="card-header border-0">
            <div class="card-title">
                <h3 class="fw-bold m-0">Submission Information</h3>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="row mb-7">
                <div class="col-md-6">
                    <div class="d-flex flex-column gap-1">
                        <span class="text-gray-600 fw-semibold">User</span>
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-40px symbol-circle me-3">
                                <span class="symbol-label bg-light-primary text-primary fw-bold">
                                    {{ substr($submission->user->name ?? 'U', 0, 1) }}
                                </span>
                            </div>
                            <span class="text-gray-800 fw-bold">{{ $submission->user->name ?? '-' }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-column gap-1">
                        <span class="text-gray-600 fw-semibold">Quiz</span>
                        <span class="text-gray-800 fw-bold">{{ $submission->quiz->title ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <div class="row mb-7">
                <div class="col-md-4">
                    <div class="d-flex flex-column gap-1">
                        <span class="text-gray-600 fw-semibold">Score</span>
                        <span class="badge badge-lg badge-light-{{ $submission->score >= 80 ? 'success' : ($submission->score >= 60 ? 'warning' : 'danger') }} fs-3 fw-bold">
                            {{ $submission->score }}%
                        </span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column gap-1">
                        <span class="text-gray-600 fw-semibold">Submitted At</span>
                        <span class="text-gray-800 fw-bold">{{ $submission->created_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex flex-column gap-1">
                        <span class="text-gray-600 fw-semibold">Time Taken</span>
                        <span class="text-gray-800 fw-bold">{{ $submission->time_taken ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <div class="separator separator-dashed my-7"></div>

            <h4 class="fw-bold mb-5">Question Answers</h4>

            @if(count($answers) > 0)
            <div class="accordion" id="answersAccordion">
                @foreach($answers as $index => $answer)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                            Question #{{ $index + 1 }}: {{ $answer['question_text'] }}
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#answersAccordion">
                        <div class="accordion-body">
                            <div class="d-flex flex-column gap-4">
                                <div>
                                    <span class="text-gray-600 fw-semibold">User's Answer:</span>
                                    <p class="text-gray-800 mt-1">{{ $answer['user_answer'] ?? 'No answer provided' }}</p>
                                </div>
                                <div>
                                    <span class="text-gray-600 fw-semibold">Correct Answer:</span>
                                    <p class="text-gray-800 mt-1">{{ $answer['correct_answer'] }}</p>
                                </div>
                                <div>
                                    <span class="badge badge-light-{{ $answer['is_correct'] ? 'success' : 'danger' }} fs-7 fw-bold">
                                        {{ $answer['is_correct'] ? 'Correct' : 'Incorrect' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-info">
                No answers found for this submission.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
