@extends('layouts.admin')

@section('title', 'Create Course')

@section('content')
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                <div id="kt_app_content" class="app-content flex-column-fluid">

                    <form action="{{ route('admin.course.store') }}" class="form d-flex flex-column flex-lg-row" method="POST"
                        enctype="multipart/form-data" data-kt-redirect="{{ route('admin.course.index') }}">
                        @csrf

                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                            <!-- Thumbnail -->
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Thumbnail</h2>
                                    </div>
                                </div>
                                <div class="card-body text-center pt-0">
                                    <style>
                                        .image-input-placeholder {
                                            background-image: url('../../../admin/media/svg/files/blank-image.svg');
                                        }

                                        [data-bs-theme="dark"] .image-input-placeholder {
                                            background-image: url('../../../admin/media/svg/files/blank-image-dark.svg');
                                        }
                                    </style>

                                    <div class="image-input image-input-outline image-input-placeholder mb-3"
                                        data-kt-image-input="true">
                                        <div class="image-input-wrapper w-150px h-150px image-input-placeholder">
                                        </div>

                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Change thumbnail">
                                            <i class="ki-outline ki-pencil fs-7"></i>
                                            <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="thumbnail_remove" />
                                        </label>

                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancel thumbnail">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>

                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            title="Remove thumbnail">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>
                                    </div>

                                    <div class="text-muted fs-7">
                                        Set a thumbnail image for the course. Only *.png, *.jpg, and *.jpeg files are
                                        accepted.
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Status</h2>
                                    </div>

                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-success w-15px h-15px"
                                            id="kt_course_add_status_indicator"></div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <label class="required form-label">Status</label>

                                    <select name="status" class="form-select mb-2" data-control="select2"
                                        data-hide-search="true" data-placeholder="Select a status"
                                        id="kt_course_add_status_select" required>
                                        <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>
                                            Select Status</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Draft</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Published
                                        </option>
                                    </select>

                                    <div class="text-muted fs-7">Set the publication status of the course.</div>
                                </div>
                            </div>

                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Course Details</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <label class="required form-label">Category</label>

                                    <select name="category_id" class="form-select mb-2" data-control="select2"
                                        data-placeholder="Select Category" required>
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <div class="text-muted fs-7 mb-7">Assign the course to one or more relevant categories.
                                    </div>

                                    <a href="add-category.html" class="btn btn-light-primary btn-sm">
                                        <i class="ki-outline ki-plus fs-2"></i> Create new category
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Right side form -->
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                                    role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">

                                        <!-- General -->
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>General</h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">

                                                <!-- Title -->
                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Course Title</label>
                                                    <input type="text" name="title" class="form-control mb-2"
                                                        placeholder="Enter course title" value="{{ old('title') }}" />
                                                    <div class="text-muted fs-7">
                                                        The course title is required and should be unique for easy
                                                        identification.
                                                    </div>
                                                </div>

                                                <!-- Description -->
                                                <div class="mb-10 fv-row">
                                                    <label class="form-label">Course Description</label>
                                                    <div id="kt_course_add_description" class="min-h-200px mb-2"></div>
                                                    <textarea name="description" id="description_hidden" class="d-none" placeholder="Enter course description">{{ old('description') }}</textarea>
                                                    <div class="text-muted fs-7">
                                                        Write a detailed description of the course to help learners
                                                        understand what they will gain.
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Form Buttons -->
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.course.index') }}" class="btn btn-light me-5">
                                    Cancel
                                </a>

                                <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                    <span class="indicator-label">Save Course</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
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
@endsection
