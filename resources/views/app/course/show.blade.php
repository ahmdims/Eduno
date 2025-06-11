@extends('layouts.main')

@section('title', $course->title)

@section('content')
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content  flex-column-fluid ">
                    <div class="card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px bg-body mb-5 mb-xl-8"
                        style="background-image: url('../assets/media/thumbnail/Materi\ 1.jpg');">
                        <div class="card-body d-flex flex-column justify-content-center ps-lg-12">
                            <h3 class="text-gray-900 fs-2qx fw-bold mb-7">
                                {{ $course->title }}
                            </h3>
                        </div>
                    </div>

                    @foreach ($timeline as $item)
                        <div class="col-xl-12">
                            <div class="card mb-5 mb-xxl-8">
                                <div class="card-body ">
                                    <div class="d-flex align-items-center text-hover-primary">
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <div class="symbol symbol-45px me-5">
                                                @if ($item['type'] === 'material')
                                                    <i class="ki-duotone ki-book fs-4x">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>
                                                @else
                                                    <i class="ki-duotone ki-book-open fs-4x">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>
                                                @endif
                                            </div>

                                            <div class="d-flex flex-column">
                                                <a href="{{ $item['type'] === 'material'
                                                    ? route('materials.show', ['slug' => $item['slug'], 'material' => $item['id']])
                                                    : route('quiz.show', ['slug' => $item['slug'], 'quiz' => $item['id']]) }}"
                                                    class="text-gray-900 text-hover-primary fs-6 fw-bold">
                                                    {{ $item['title'] }}
                                                </a>
                                                <span
                                                    class="text-gray-500 fw-bold">{{ $item['created_at']->format('d F Y') }}</span>
                                            </div>
                                        </div>

                                        <div class="my-0">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <i class="ki-outline ki-fasten fs-6"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            @include('template.footer')

        </div>

    </div>
@endsection
