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
                            {{ $quiz->title }} - Result
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
                            <div class="card-body pt-0">
                                <div class="d-flex flex-column align-items-center py-10">
                                    <!--begin::Icon-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <div class="symbol-label bg-light-{{ $score >= $quiz->passing_score ? 'success' : 'danger' }}">
                                            <i class="ki-duotone ki-{{ $score >= $quiz->passing_score ? 'check' : 'close' }}-circle fs-2x text-{{ $score >= $quiz->passing_score ? 'success' : 'danger' }}">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    <h2 class="fw-bold mb-4">
                                        {{ $score >= $quiz->passing_score ? 'Congratulations!' : 'Try Again!' }}
                                    </h2>
                                    <!--end::Title-->

                                    <!--begin::Text-->
                                    <div class="text-center mb-7">
                                        <div class="text-gray-600 fw-semibold fs-5">
                                            You scored <span class="fw-bold text-primary">{{ $score }}</span> out of <span class="fw-bold">{{ $quiz->questions->count() }}</span>
                                        </div>
                                        @if($quiz->passing_score)
                                            <div class="text-gray-600 fw-semibold fs-5 mt-2">
                                                Passing score: <span class="fw-bold">{{ $quiz->passing_score }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <!--end::Text-->

                                    <!--begin::Buttons-->
                                    <div class="d-flex flex-center">
                                        <a href="{{ route('course.show', $quiz->course->slug) }}" class="btn btn-light">
                                            <i class="ki-duotone ki-home-3 fs-2 me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            Back to Course
                                        </a>
                                    </div>
                                    <!--end::Buttons-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .symbol.symbol-100px.symbol-circle .symbol-label {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ki-duotone {
        display: inline-block;
        line-height: 1;
    }
</style>
@endsection
