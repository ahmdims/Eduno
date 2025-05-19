<div class="rbt-team-modal modal fade rbt-modal-default" id="materialModal" tabindex="-1"
    aria-labelledby="materialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ isset($course) ? route('material.update', $course->id) : route('material.store') }}"
                action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (isset($course))
                    @method('PUT')
                @endif

                <input type="hidden" name="course_id" value="{{ $course->id }}">

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="title" class="form-label">Title <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="{{ old('title', $course->title ?? '') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="video" class="form-label">Video</label>
                        <input type="text" class="form-control" id="video" name="video"
                            value="{{ old('title', $course->video ?? '') }}">
                    </div>

                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="content" class="form-label">Content <small
                                    class="text-danger">*</small></label>
                            <input type="hidden" class="form-control" id="content" name="content" required>
                            <trix-editor input="content"></trix-editor>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rbt-btn btn-sm btn-border" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="rbt-btn btn-sm">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
