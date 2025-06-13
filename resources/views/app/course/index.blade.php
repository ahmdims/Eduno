@extends('layouts.main')

@section('title', 'Course')

@section('content')
    <div class="app-container  container-xxl ">

        <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content  flex-column-fluid ">
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-12">
                            <div class="row g-5 g-xl-8">

                                @foreach ($courses as $course_data)
                                    <div class="col-12 col-md-6 col-xl-4">
                                        <div class="card h-xl-100 mb-xl-8">
                                            <div class=" card-body text-center">
                                                <div class="card overlay overflow-hidden">
                                                    <div class="overlay-wrapper">
                                                        <img src="../assets/media/thumbnail/Cover 1.jpg"
                                                            class="w-100 mx-auto d-block rounded"
                                                            style="max-height: 200px; object-fit: cover;"
                                                            alt="Plurk Logo" />
                                                    </div>
                                                    <div class="overlay-layer bg-dark bg-opacity-25">
                                                        <a href="{{ route('course.show', $course_data->slug) }}"
                                                            class="btn btn-light-primary btn-shadow ms-2">
                                                            Course Detail
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-start mt-5">
                                                    <h2 class=" me-2 fw-bold">
                                                        {{ $course_data->title }}
                                                    </h2>
                                                </div>

                                                <div class="d-flex align-items-center justify-content-start mt-2">
                                                    <div class="symbol symbol-circle symbol-25px me-2"
                                                        data-bs-toggle="tooltip" data-bs-boundary="window"
                                                        data-bs-placement="top" title="{{ $course_data->user->name }}">
                                                        <img src="{{ $course_data->user->profile ? Storage::url($course_data->user->profile) : asset('assets/media/avatars/null.png') }}" />
                                                    </div>
                                                    <span class="text-gray-700 fw-bold me-1">
                                                        {{ $course_data->user->name }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('template.footer')

        </div>

    </div>
@endsection
