@extends('layouts.main')

@section('title', 'Submission List')

@section('content')
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-start">
        <div class="d-flex flex-column flex-row-fluid">
            <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                <div class="page-title me-5">
                    <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                        Submission List
                        <span class="page-desc text-gray-600 fw-semibold fs-6 pt-3">
                            All user quiz submissions
                        </span>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Toolbar-->

<div class="app-container container-xxl">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold m-0">Submission Records</h3>
            </div>
        </div>
        <div class="card-body pt-5 pb-0">
            <div class="table-responsive">
                <table class="table table-row-bordered table-row-dashed gy-5 align-middle fs-6">
                    <thead>
                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-50px ps-6">#</th>
                            <th class="min-w-150px">User</th>
                            <th class="min-w-100px">Status</th> <!-- Kolom baru -->
                            <th class="min-w-150px">Reason</th> <!-- Kolom baru -->
                            <th class="min-w-200px">Quiz</th>
                            <th class="min-w-100px">Score</th>
                            <th class="min-w-150px">Submitted At</th>
                            <th class="min-w-100px pe-6 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                        @forelse ($submissions as $index => $submission)
                            <tr>
                                <td class="ps-6">{{ $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center py-3">
                                        <div class="symbol symbol-40px symbol-circle me-4">
                                            <span class="symbol-label bg-light-primary text-primary fw-bold">
                                                {{ substr($submission->user->name ?? 'U', 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-gray-800">{{ $submission->user->name ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge badge-light-{{ $submission->user->status === 'active' ? 'success' : 'danger' }} fs-7 fw-bold px-3 py-2">
                                        {{ $submission->user->status ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="py-3 text-gray-800">
                                    {{ $submission->user->reason ?? '-' }}
                                </td>
                                <td class="text-gray-800 py-3">{{ $submission->quiz->title ?? '-' }}</td>
                                <td class="py-3">
                                    <span class="badge badge-light-{{ $submission->score >= 80 ? 'success' : ($submission->score >= 60 ? 'warning' : 'danger') }} fs-7 fw-bold px-3 py-2">
                                        {{ $submission->score }}%
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="text-gray-800 d-block">{{ $submission->created_at->format('d M Y') }}</span>
                                    <span class="text-muted fs-7">{{ $submission->created_at->format('H:i') }}</span>
                                </td>
                                <td class="pe-6 text-end py-3">
                                    <a href="{{ route('admin.submission.show', $submission->id) }}" class="btn btn-sm btn-light btn-active-light-primary px-4">
                                        <i class="ki-duotone ki-eye fs-5 me-2"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-12">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="ki-duotone ki-file-search fs-2qx text-gray-500 mb-5">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <span class="text-gray-600 fw-semibold fs-5 mb-2">No submissions found</span>
                                        <span class="text-gray-500 fs-7">Try adjusting your search or filter</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($submissions instanceof \Illuminate\Pagination\AbstractPaginator && $submissions->hasPages())
            <div class="card-footer d-flex justify-content-end pt-8 pb-6">
                {{ $submissions->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
