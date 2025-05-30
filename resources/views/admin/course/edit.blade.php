@extends('layouts.admin')

@section('title', 'Course')

@section('content')
    <div class="app-container  container-xxl ">
        <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                <div id="kt_app_content" class="app-content  flex-column-fluid ">

                    <form action="{{ route('admin.course.update', $course->slug) }}"
                        class="form d-flex flex-column flex-lg-row" method="POST" enctype="multipart/form-data"
                        data-kt-redirect="{{ route('admin.course.index') }}">
                        @csrf @method('PUT')
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

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
                                        <div class="image-input-wrapper w-150px h-150px @if (!$course->thumbnail) image-input-placeholder @endif"
                                            @if ($course->thumbnail) style="background-image: url('{{ Storage::url($course->thumbnail) }}');" @endif>
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
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="0" {{ $course->status == 0 ? 'selected' : '' }}>Draft
                                        </option>
                                        <option value="1" {{ $course->status == 1 ? 'selected' : '' }}>Published
                                        </option>
                                        <option value="2" {{ $course->status == 2 ? 'selected' : '' }}>Inactive
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
                                                {{ $course->category_id == $category->id ? 'selected' : '' }}>
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

                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                                    role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">

                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>General</h2>
                                                </div>
                                            </div>

                                            <div class="card-body pt-0">

                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Course Title</label>
                                                    <input type="text" name="title" class="form-control mb-2"
                                                        placeholder="Enter course title"
                                                        value="{{ old('title', $course->title) }}" />
                                                    <div class="text-muted fs-7">
                                                        The course title is required and should be unique for easy
                                                        identification.
                                                    </div>
                                                </div>

                                                <div class="mb-10 fv-row">
                                                    <label class="form-label">Course Description</label>
                                                    <div id="kt_course_add_description" class="min-h-200px mb-2"></div>
                                                    <textarea name="description" id="description_hidden" class="d-none" placeholder="Enter course description">{{ old('description', $course->description) }}</textarea>
                                                    <div class="text-muted fs-7">
                                                        Write a detailed description of the course to help learners
                                                        understand what they will gain.
                                                    </div>
                                                </div>

                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Intro Video (URL)</label>
                                                    <input type="text" name="video" class="form-control mb-2"
                                                        placeholder="https://example.com/intro-video"
                                                        value="{{ old('video', $course->video) }}" />
                                                    <div class="text-muted fs-7">
                                                        Add a link to an introduction or preview video for the course.
                                                    </div>
                                                </div>

                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Course Level</label>
                                                    <select name="level" class="form-select" data-control="select2"
                                                        data-hide-search="true">
                                                        <option value="" disabled selected>Select Level</option>
                                                        <option value="beginner"
                                                            {{ $course->level == 'beginner' ? 'selected' : '' }}>Beginner
                                                        </option>
                                                        <option value="intermediate"
                                                            {{ $course->level == 'intermediate' ? 'selected' : '' }}>
                                                            Intermediate</option>
                                                        <option value="advanced"
                                                            {{ $course->level == 'advanced' ? 'selected' : '' }}>Advanced
                                                        </option>
                                                    </select>
                                                    <div class="text-muted fs-7">
                                                        Choose the difficulty level of the course to guide learners
                                                        appropriately.
                                                    </div>
                                                </div>

                                                <div class="mb-10 fv-row">
                                                    <label class="required form-label">Language</label>
                                                    <input type="text" name="language" class="form-control mb-2"
                                                        placeholder="e.g. English, Indonesian, PHP"
                                                        value="<?= htmlspecialchars(old('language') ?? ($course->language ?? '')) ?>" />
                                                    <div class="text-muted fs-7">
                                                        Specify the language used in the course, either spoken or
                                                        programming language.
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.course.index') }}" class="btn btn-light me-5">
                                    Cancel
                                </a>

                                <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                    <span class="indicator-label">
                                        Save Changes
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @include('template.admin-footer')

        </div>
    </div>
@endsection
