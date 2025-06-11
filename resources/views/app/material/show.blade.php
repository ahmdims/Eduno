@extends('layouts.main')

@section('title', $material->title)

@section('content')

    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content  flex-column-fluid ">
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-12">
                            <div class="row g-5 g-xl-8">
                                <div class="col-9">
                                    <div class="card h-xl-100 mb-xl-8">
                                        <div class="card-footer border-transparent">
                                            <div class="d-flex flex-stack">
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-70px symbol-circle me-5">
                                                        <span class="symbol-label bg-light-primary">
                                                            <i class="ki-outline ki-book-open fs-3x text-primary"></i>
                                                        </span>
                                                    </div>
                                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                                        <span class="text-gray-900 fw-bold text-hover-primary fs-5">
                                                            {{ $material->course->title }}
                                                        </span>
                                                        <div class="d-flex align-items-center">
                                                            <span class="text-muted fw-bold">
                                                                {{ $material->course->user->name }} •
                                                                {{ $material->created_at->format('d M Y') }}
                                                            </span>

                                                            @if ($material->updated_at != $material->created_at)
                                                                <span class="text-muted fw-bold ms-2">
                                                                    (Diedit {{ $material->updated_at->format('d M Y') }})
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator border-2 mt-5"></div>

                                            <div class="mt-5">
                                                <span class="text-gray-900 fw-bold h3">
                                                    {{ $material->title }}
                                                </span>
                                            </div>
                                            <div class="mt-3">
                                                {!! $material->content !!}
                                            </div>

                                            <div class="d-flex justify-content-start align-items-center p-8">
                                                <div class="symbol symbol-60px me-4">
                                                    <img src="../../assets/media/svg/files/pdf.svg" class="theme-light-show"
                                                        alt="" />
                                                    <img src="../../assets/media/svg/files/pdf-dark.svg"
                                                        class="theme-dark-show" alt="" />
                                                </div>

                                                <div class="d-flex flex-column">
                                                    <div class="fs-5 fw-bold mb-2">
                                                        Mengenal Huruf Hijaiyah
                                                    </div>

                                                    <div class="fs-7 fw-semibold text-gray-500">
                                                        3 days ago
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="card mb-xl-8">
                                        <div class="card-body">
                                            <div class="d-flex flex-stack">
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pr-3">
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary fs-5">Upload
                                                            File</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column w-100 mt-12">
                                                <span class="text-gray-900 me-2 fw-bold pb-3">Progress</span>
                                                <div class="progress h-5px w-100">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column mt-10">
                                                <div class="text-gray-900 me-2 fw-bold pb-4">Team</div>
                                                <div class="d-flex">
                                                    <a href="#" class="symbol symbol-35px me-2"
                                                        data-bs-toggle="tooltip" title="John Doe">
                                                        <img src="../assets/media/avatars/300-4.jpg" alt="" />
                                                    </a>
                                                    <a href="#" class="symbol symbol-35px me-2"
                                                        data-bs-toggle="tooltip" title="Emily Clark">
                                                        <img src="../assets/media/avatars/300-7.jpg" alt="" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

            @include('template.footer')

        </div>

    </div>

@endsection
