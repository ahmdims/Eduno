@extends('layouts.main')

@section('title', 'Edit ' . $course->title)

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

                                    <form action="{{ route('course.update', $course->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="course-field mb--20">
                                            <label for="thumbnail" class="form-label">Thumbnail</label>
                                            <div class="rbt-create-course-thumbnail upload-area">
                                                <div class="upload-area">
                                                    <div class="brows-file-wrapper" data-black-overlay="9">
                                                        <input name="thumbnail" id="createinputfile" type="file"
                                                            class="inputfile" accept="image/*" />
                                                        <img id="createfileImage"
                                                            src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/images/thumbnail/thumbnail.svg') }}"
                                                            alt="Current Thumbnail" />
                                                        <label class="d-flex" for="createinputfile" title="No File Chosen">
                                                            <i class="feather-upload"></i>
                                                            <span class="text-center">Choose a File</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <small><i class="feather-info"></i> <b>File Support:</b> JPG, JPEG, PNG,
                                                WEBP</small>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label for="title" class="form-label">Title <small
                                                        class="text-danger">*</small></label>
                                                <input type="text" name="title" id="title" class="form-control"
                                                    value="{{ $course->title }}" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="slug" class="form-label">Slug <small
                                                        class="text-danger">*</small></label>
                                                <input type="text" name="slug" id="slug" class="form-control"
                                                    value="{{ $course->slug }}" readonly required>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="rbt-form-group">
                                                    <label for="category_id" class="form-label">Category <small
                                                            class="text-danger">*</small></label>
                                                    <div class="rbt-modern-select bg-transparent height-45">
                                                        <select name="category_id" id="category_id" class="form-control"
                                                            required>
                                                            <option value="" selected disabled>Select Category
                                                            </option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}"
                                                                    {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="level" class="form-label">Level <small
                                                        class="text-danger">*</small></label>
                                                <div class="rbt-modern-select bg-transparent height-45">
                                                    <select name="level" id="level" class="form-control" required>
                                                        <option value="" disabled>Select Level</option>
                                                        <option value="Beginner"
                                                            {{ $course->level == 'Beginner' ? 'selected' : '' }}>Beginner
                                                        </option>
                                                        <option value="Intermediate"
                                                            {{ $course->level == 'Intermediate' ? 'selected' : '' }}>
                                                            Intermediate</option>
                                                        <option value="Advanced"
                                                            {{ $course->level == 'Advanced' ? 'selected' : '' }}>Advanced
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label for="language" class="form-label">Language <small
                                                        class="text-danger">*</small></label>
                                                <input type="text" name="language" id="language" class="form-control"
                                                    value="{{ $course->language }}" required>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="rbt-form-group">
                                                    <label for="status" class="form-label">Status <small
                                                            class="text-danger">*</small></label>
                                                    <div class="rbt-modern-select bg-transparent height-45">
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="draft"
                                                                {{ $course->status == 'draft' ? 'selected' : '' }}>Draft
                                                            </option>
                                                            <option value="published"
                                                                {{ $course->status == 'published' ? 'selected' : '' }}>
                                                                Published</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="video" class="form-label">Video <small
                                                    class="text-danger">*</small></label>
                                            <input type="text" class="form-control" id="video" name="video"
                                                value="{{ $course->video }}" required>
                                        </div>

                                        <div class="mb-4">
                                            <div class="rbt-form-group">
                                                <label for="description" class="form-label">Description <small
                                                        class="text-danger">*</small></label>
                                                <input type="hidden" class="form-control" id="description"
                                                    name="description"
                                                    value="{{ old('description', $course->description) }}" required>
                                                <trix-editor input="description">{{ $course->description }}</trix-editor>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button class="rbt-btn btn-gradient btn-gradient-3 btn-sm w-100"
                                                type="submit">Update {{ $course->title }}</button>
                                        </div>
                                    </form>

                                    <hr class="mt--30">

                                    <div class="container-fluid mt-2">
                                        <div class="row">
                                            <div class="col-md-12 mt-4 mb-4">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="text-primary mb-0">Material</h4>
                                                    <a class="rbt-btn btn-sm ms-auto" data-bs-toggle="modal"
                                                        data-bs-target="#materialModal">
                                                        <span>Create Material</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <div class="rbt-dashboard-table table-responsive mobile-table-750 mt--30">
                                                    <table class="rbt-table table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Material Title</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($materials as $material)
                                                                <tr>
                                                                    <th>
                                                                        <span
                                                                            class="h6 mb--5">{{ $material->title }}</span>
                                                                    </th>
                                                                    <td>
                                                                        <div class="rbt-button-group justify-content-end">
                                                                            <a data-bs-toggle="modal"
                                                                                data-bs-target="#materialModal"
                                                                                type="button"
                                                                                data-id="{{ $material->id }}"
                                                                                class="btn-edit rbt-btn-link left-icon text-primary">
                                                                                <i class="feather-edit"></i> Edit
                                                                            </a>

                                                                            <a data-bs-toggle="modal"
                                                                                data-bs-target="#deleteMaterial-{{ $material->id }}"
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

                </div>
            </div>
        </div>

        @foreach ($materials as $material)
            @include('admin.course.material', ['material' => $material])
            @include('admin.course.deleteMaterial', ['material' => $material])
        @endforeach

    </main>

    <script src="{{ asset('assets/js/admin/material.js') }}"></script>

@endsection
