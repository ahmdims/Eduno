@extends('layouts.admin')

@section('title', 'Course')

@section('content')
    <div class="app-container  container-xxl ">
        <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div class="app-container container-xxl">
                        <div class="card">
                            <div
                                class="card-header border-0 pt-6 pb-4 d-flex flex-wrap justify-content-between align-items-center gap-4">
                                <div class="card-title">
                                    <h2 class="fw-bold mb-0">Course Management</h2>
                                </div>

                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="position-relative">
                                        <i
                                            class="ki-outline ki-magnifier fs-2 position-absolute top-50 start-0 translate-middle-y ms-4 text-gray-500"></i>
                                        <input type="text" data-filter="search"
                                            class="form-control form-control-solid ps-12 w-250px" placeholder="Search..." />
                                    </div>

                                    <a data-bs-toggle="modal" data-bs-target="#modal_create" class="btn btn-primary">
                                        <i class="ki-outline ki-plus fs-2"></i> Add Course
                                    </a>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="course_table">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-50px text-center">No</th>
                                                <th class="min-w-150px">Title</th>
                                                <th class="min-w-100px">Status</th>
                                                <th class="min-w-150px">Category</th>
                                                <th class="min-w-100px">Level</th>
                                                <th class="min-w-100px">Administrator</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($courses as $course_data)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $course_data->title ?? '-' }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $course_data->status == 1 ? 'badge-light-success' : 'badge-light-danger' }}">
                                                            {{ $course_data->status == 1 ? 'Published' : 'Draft' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $course_data->category->name ?? '-' }}</td>
                                                    <td>{{ $course_data->level ?? '-' }}</td>
                                                    <td>{{ $course_data->user->email ?? '-' }}</td>
                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-light btn-active-light-primary btn-sm"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">
                                                            Actions
                                                            <i class="ki-outline ki-down fs-5 ms-1"></i>
                                                        </a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                            data-kt-menu="true">
                                                            <div class="menu-item px-3">
                                                                <a href="{{ route('admin.course.edit', $course_data->slug) }}"
                                                                    class="menu-link px-3">
                                                                    Edit
                                                                </a>
                                                            </div>

                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3"
                                                                    data-laporgraf-filter="delete_row">
                                                                    Delete
                                                                </a>
                                                            </div>
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

                @include('template.admin-footer')

            </div>
        </div>
    </div>

    @include('admin.course.create')

@endsection
