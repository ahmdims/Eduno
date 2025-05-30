@extends('layouts.admin')

@section('title', 'Edit Material')

@section('content')
    <div class="app-container container-xxl">
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div class="app-container container-xxl">

                        <div class="card mb-10">
                            <div
                                class="card-header border-0 pt-6 pb-4 d-flex flex-wrap justify-content-between align-items-center gap-4">
                                <div class="card-title">
                                    <h2 class="fw-bold mb-0">Edit Material - {{ $material->title }}</h2>
                                </div>
                            </div>

                            <form action="{{ route('admin.material.update', $material->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="card-body pt-0">
                                    <div class="row g-10">
                                        <div class="col-md-6">
                                            <div class="mb-10 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Title</label>
                                                <input type="text" name="title"
                                                    value="{{ old('title', $material->title) }}"
                                                    class="form-control form-control-solid" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-10 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">Video (URL)</label>
                                                <input type="text" name="video"
                                                    value="{{ old('video', $material->video) }}"
                                                    class="form-control form-control-solid" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-10 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Course</label>
                                                <select name="course_id" class="form-select form-select-solid"
                                                    data-control="select2" data-placeholder="Select Course" required>
                                                    <option value="" disabled>Select Course</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}"
                                                            {{ $material->course_id == $course->id ? 'selected' : '' }}>
                                                            {{ $course->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-10 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Status</label>
                                                <select name="status" class="form-select form-select-solid"
                                                    data-control="select2" data-hide-search="true" required>
                                                    <option value="0" {{ $material->status == 0 ? 'selected' : '' }}>
                                                        Draft</option>
                                                    <option value="1" {{ $material->status == 1 ? 'selected' : '' }}>
                                                        Published</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-10 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Content</label>
                                                <textarea name="content" rows="5" class="form-control form-control-solid" required>{{ old('content', $material->content) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end mt-6">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Changes</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                @include('template.admin-footer')
            </div>
        </div>
    </div>
@endsection
