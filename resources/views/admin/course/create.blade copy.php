<div class="modal fade" id="modal_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">

            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form class="form" action="{{ route('admin.course.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Add Course</h1>
                    </div>

                    <div class="d-flex flex-column mb-5 fv-row">
                        <label class="required fs-5 fw-semibold mb-2">Title</label>
                        <input class="form-control form-control-solid" name="title" required />
                    </div>

                    <div class="d-flex flex-column mb-5 fv-row">
                        <label for="thumbnail" class="form-label fs-5 fw-semibold">Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control form-control-solid"
                            accept="image/*">
                    </div>

                    <div class="d-flex flex-column mb-5 fv-row">
                        <label for="description" class="required fs-5 fw-semibold mb-2">Description</label>
                        <textarea class="form-control form-control-solid" id="description" name="description" rows="4"
                            placeholder="Enter course description..." required></textarea>
                    </div>

                    <div class="d-flex flex-column mb-5 fv-row">
                        <label class="required fs-5 fw-semibold mb-2">Category</label>
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                            data-placeholder="Select Category" name="category_id" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex flex-column mb-5 fv-row">
                        <label class="required fs-5 fw-semibold mb-2">Video</label>
                        <input class="form-control form-control-solid" name="video" required />
                    </div>

                    <div class="d-flex flex-column mb-5 fv-row">
                        <label class="required fs-5 fw-semibold mb-2">Level</label>
                        <input class="form-control form-control-solid" name="level" required />
                    </div>

                    <div class="d-flex flex-column mb-5 fv-row">
                        <label class="required fs-5 fw-semibold mb-2">Languange</label>
                        <input class="form-control form-control-solid" name="language" required />
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
