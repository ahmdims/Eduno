<div class="rbt-team-modal modal fade rbt-modal-default" id="formModal" tabindex="-1" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-4">
                        <label for="title" class="form-label">Title <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="course-field mb--20">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <div class="rbt-create-course-thumbnail upload-area">
                            <div class="upload-area">
                                <div class="brows-file-wrapper" data-black-overlay="9">
                                    <input name="thumbnail" id="createinputfile" type="file" class="inputfile"
                                        accept="image/*" />
                                    <img id="createfileImage" src="{{ asset('assets/images/thumbnail/thumbnail.svg') }}"
                                        alt="File Image">
                                    <label class="d-flex" for="createinputfile" title="No File Chosen">
                                        <i class="feather-upload"></i>
                                        <span class="text-center">Choose a File</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <small><i class="feather-info"></i> <b>File Support:</b> JPG, JPEG, PNG, WEBP</small>
                    </div>

                    <div class="mb-4">
                        <label for="video" class="form-label">Video <small class="text-danger">*</small></label>
                        <input type="text" class="form-control" id="video" name="video" required>
                    </div>

                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="description" class="form-label">Description <small
                                    class="text-danger">*</small></label>
                            <input type="hidden" class="form-control" id="description" name="description" required>
                            <trix-editor input="description"></trix-editor>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="category_id" class="form-label">
                                Category <small class="text-danger">*</small>
                            </label>
                            <div class="rbt-modern-select bg-transparent height-45">
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="level" class="form-label">Level <small class="text-danger">*</small></label>
                            <div class="rbt-modern-select bg-transparent height-45">
                                <select name="level" id="level" class="form-control" required>
                                    <option value="" selected disabled>Select Level</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="language" class="form-label">Language <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="language" name="language" required>
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
