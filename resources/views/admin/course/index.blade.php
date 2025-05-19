@extends('layouts.main')

@section('title', 'Course')

@section('content')
    <link href="{{ asset('assets/css/vendor/trix.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/vendor/trix.min.js') }}" defer></script>

    <main>
        <div class="rbt-page-banner-wrapper">
            <div class="rbt-banner-image"></div>
        </div>

        <div class="rbt-dashboard-area rbt-section-overlayping-top rbt-section-gapBottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div>
                            <div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
                                <div class="content">

                                    <div class="rbt-callto-action rbt-cta-default style-2">
                                        <div class="content">

                                            <div class="section-title">
                                                <div class="row gy-5 align-items-center">
                                                    <div class="col-lg-8 d-flex align-items-center">
                                                        <div class="section-title">
                                                            <div class="call-to-btn text-start position-relative">
                                                                <a class="rbt-btn btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#formModal">
                                                                    <span>Create @yield('title')</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="rbt-dashboard-table table-responsive mobile-table-750 mt--30">
                                        <table class="rbt-table table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Status</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Level</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($courses as $course_data)
                                                    <tr>
                                                        <th>
                                                            <span class="h6 mb--5">{{ $course_data->title }}</span>
                                                        </th>
                                                        <td>
                                                            <span class="h6 mb--5">
                                                                <span
                                                                    class="badge {{ $course_data->status === 'draft' ? 'bg-danger' : 'bg-success' }}">
                                                                    {{ ucfirst($course_data->status) }}
                                                                </span>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="h6 mb--5">{{ $course_data->category->name }}</span>
                                                        </td>
                                                        <td>
                                                            <a data-bs-toggle="modal"
                                                                data-bs-target="#contentModal-{{ $course_data->id }}"
                                                                type="button"
                                                                class="badge bg-primary text-white content-btn"
                                                                data-id="{{ $course_data->id }}">View
                                                                Description
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <span class="h6 mb--5">{{ $course_data->level }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="rbt-button-group justify-content-end">
                                                                <a href="{{ route('admin.course.edit', $course_data->slug) }}"
                                                                    class="rbt-btn-link left-icon text-primary">
                                                                    <i class="feather-edit"></i> Edit
                                                                </a>

                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal-{{ $course_data->id }}"
                                                                    type="button"
                                                                    class="rbt-btn-link left-icon text-danger">
                                                                    <i class="feather-trash-2"></i> Delete
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('admin.course.create')

        @foreach ($courses as $course_data)
            @include('admin.course.content', ['course_data' => $course_data])
            @include('admin.course.delete', ['course_data' => $course_data])
        @endforeach

    </main>

    <script src="{{ asset('assets/js/admin/course.js') }}"></script>

@endsection
