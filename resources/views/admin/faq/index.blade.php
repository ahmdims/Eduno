@extends('layouts.admin')

@section('title', 'Faq')

@section('content')

    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="card-title">
                                    <h2 class="fw-bold mb-0">FAQ Management</h2>
                                </div>
                            </div>

                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <div class="w-100 mw-150px">
                                    <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true" data-placeholder="Status"
                                        data-kt-admin-course-filter="status">
                                        <option></option>
                                        <option value="all">All</option>
                                        <option value="Publish">Publish</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>

                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                    <input type="text" data-kt-admin-course-filter="search"
                                        class="form-control form-control-solid w-250px ps-12" placeholder="Search..." />
                                </div>

                                <a href="{{ route('admin.course.create') }}" class="btn btn-primary">
                                    <i class="ki-outline ki-plus fs-2"></i> Add Article
                                </a>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_admin_faq_table">
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-50px text-center">No</th>
                                        <th class="min-w-200px">Question</th>
                                        <th class="min-w-200px">Answer Preview</th>
                                        <th class="min-w-100px">Status</th>
                                        <th class="min-w-150px">Last Updated</th>
                                        <th class="text-end min-w-100px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach ($faqs as $faq)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ Str::limit(strip_tags($faq->question), 50) }}</td>
                                            <td>{{ Str::limit(strip_tags($faq->answer), 50) }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $faq->status == 1 ? 'badge-light-success' : ($faq->status == 0 ? 'badge-light-primary' : 'badge-light-danger') }}">
                                                    {{ $faq->status == 1 ? 'Publish' : ($faq->status == 0 ? 'Draft' : 'Inactive') }}
                                                </span>
                                            </td>
                                            <td>{{ $faq->updated_at ? $faq->updated_at->format('d M Y') : '-' }}</td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <i class="ki-outline ki-down fs-5 ms-1"></i>
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.course.edit', $faq->id) }}"
                                                            class="menu-link px-3">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3"
                                                            data-kt-admin-faq-filter="delete_row"
                                                            data-id="{{ $faq->id }}"
                                                            data-url="{{ route('admin.course.destroy', $faq->id) }}">
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

            @include('template.footer')

        </div>
    </div>

@endsection
