@extends('layouts.admin')

@section('title', 'Course')

@section('content')
    <div class="app-container  container-xxl ">
        <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <div class="app-container container-xxl">

                        <div class="card mb-10">
                            <div
                                class="card-header border-0 pt-6 pb-4 d-flex flex-wrap justify-content-between align-items-center gap-4">
                                <div class="card-title">
                                    <h2 class="fw-bold mb-0">{{ $course->title }} Edit</h2>
                                </div>
                            </div>

                            <form action="{{ route('admin.course.update', $course->slug) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="card-body pt-0">
                                    <div class="row g-10">
                                        <div class="col-md-6">
                                            <div class="mb-10 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Title</label>
                                                <input type="text" name="title"
                                                    value="{{ old('title', $course->title) }}"
                                                    class="form-control form-control-solid" required />
                                            </div>

                                            <div class="mb-10 fv-row">
                                                <label class="fs-5 fw-semibold mb-2">Thumbnail</label>
                                                <input type="file" name="thumbnail"
                                                    class="form-control form-select-solid mb-2" accept="image/*" />
                                                @if ($course->thumbnail)
                                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail"
                                                        class="mt-2 rounded" width="120">
                                                @endif
                                            </div>

                                            <div class="mb-10 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Kategori</label>
                                                <select name="category_id" class="form-select form-select-solid"
                                                    data-control="select2" data-placeholder="Select Category" required>
                                                    <option value="" disabled selected>Select Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $course->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-10 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Video (URL)</label>
                                                <input type="text" name="video"
                                                    value="{{ old('video', $course->video) }}"
                                                    class="form-control form-control-solid" required />
                                            </div>

                                            <div class="mb-10 fv-row">
                                                <label class="required form-label">Level</label>
                                                <select class="form-select" name="level">
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
                                            </div>

                                            <div class="mb-10 fv-row">
                                                <label class="required fs-5 fw-semibold mb-2">Language</label>
                                                <input type="text" name="language"
                                                    value="{{ old('language', $course->language) }}"
                                                    class="form-control form-control-solid" required />
                                            </div>

                                            <div class="mb-10 fv-row">
                                                <label class="required form-label">Status</label>
                                                <select class="form-select" name="status">
                                                    <option value="1" {{ $course->status == '1' ? 'selected' : '' }}>
                                                        Published</option>
                                                    <option value="0" {{ $course->status == '0' ? 'selected' : '' }}>
                                                        Draft</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Deskripsi</label>
                                        <textarea name="description" class="form-control mb-2" rows="4">{{ old('description', $course->description) }}</textarea>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="indicator-label">Save Changes</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card card-flush py-4 mb-10">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title">
                                    <h2>{{ $course->title }} Material</h2>
                                </div>
                                <div class="card-toolbar">
                                    <a href="admin-materi.html" class="btn btn-primary">
                                        <i class="ki-outline ki-plus fs-2"></i> Add Material
                                    </a>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-50px text-center">No</th>
                                                <th class="min-w-150px">Title</th>
                                                <th class="min-w-100px">Video Link</th>
                                                <th class="min-w-100px">Content</th>
                                                <th class="min-w-100px">Status</th>
                                                <th class="min-w-100px">Created At</th>
                                                <th class="min-w-100px">Update At</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @foreach ($materials as $index => $material)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $material->title }}</td>
                                                    <td>
                                                        @if ($material->video)
                                                            <a href="{{ $material->video }}" target="_blank"
                                                                class="btn btn-sm btn-light-primary">
                                                                View Video
                                                            </a>
                                                        @else
                                                            <button class="btn btn-sm btn-light-secondary" disabled>
                                                                No Video</button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ Str::limit(strip_tags($material->content), 50) }}
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $material->status == 1 ? 'badge-light-success' : 'badge-light-danger' }}">
                                                            {{ $material->status == 1 ? 'Published' : 'Draft' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $material->created_at->format('d F Y') }}</td>
                                                    <td>{{ $material->updated_at->format('d F Y') }}</td>
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
                                                                <a href="{{ route('admin.material.edit', $material->id) }}"
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

                        <div class="card card-flush py-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="card-title">
                                    <h2>{{ $course->title }} Quiz</h2>
                                </div>
                                <div class="card-toolbar">
                                    <a href="#" class="btn btn-primary">
                                        <i class="ki-outline ki-plus fs-2"></i> Add Quiz
                                    </a>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-50px text-center">No</th>
                                                <th class="min-w-100px">Title</th>
                                                <th class="min-w-100px">Total Questions</th>
                                                <th class="min-w-100px">Created At</th>
                                                <th class="min-w-100px">Updated At</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @forelse ($quizzes as $quiz)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $quiz->title }}</td>
                                                    <td>{{ $quiz->questions->count() }} Questions</td>
                                                    <td>{{ $quiz->created_at->format('d F Y') }}</td>
                                                    <td>{{ $quiz->updated_at->format('d F Y') }}</td>
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
                                                                <a href="{{ route('admin.quiz.edit', $quiz->id) }}"
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
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">No quizzes found.
                                                    </td>
                                                </tr>
                                            @endforelse
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
@endsection
