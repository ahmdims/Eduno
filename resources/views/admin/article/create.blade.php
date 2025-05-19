<div class="rbt-team-modal modal fade rbt-modal-default" id="formModal" tabindex="-1" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ isset($article) ? route('article.update', $article->id) : route('article.store') }}"
                method="POST" id="articleForm" enctype="multipart/form-data">
                @csrf

                @if (isset($article))
                    @method('PUT')
                @endif

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="title" class="form-label">Title <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $article->title ?? '') }}" required>
                        </div>
                    </div>

                    <div class="course-field mb--20">
                        <label for="thumbnail" class="form-label">Thumbnail</label>
                        <div class="rbt-create-course-thumbnail upload-area">
                            <div class="upload-area">
                                <div class="brows-file-wrapper" data-black-overlay="9">
                                    <input name="thumbnail" id="createinputfile" type="file" class="inputfile"
                                        accept="image/*">
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

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="rbt-form-group">
                                <label for="category_id" class="form-label">Category <small
                                        class="text-danger">*</small></label>
                                <div class="rbt-modern-select bg-transparent height-45">
                                    <select name="category_id" class="form-control" id="category_id" required>
                                        <option value="" disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $article->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rbt-form-group">
                                <label for="status" class="form-label">Status <small
                                        class="text-danger">*</small></label>
                                <div class="rbt-modern-select bg-transparent height-45">
                                    <select name="status" class="form-control" id="status" required>
                                        <option value="" disabled>Select Status</option>
                                        <option value="draft"
                                            {{ old('status', $article->status ?? '') == 'draft' ? 'selected' : '' }}>
                                            Draft</option>
                                        <option value="published"
                                            {{ old('status', $article->status ?? '') == 'published' ? 'selected' : '' }}>
                                            Published</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="content" class="form-label">Content <small
                                    class="text-danger">*</small></label>
                            <input type="hidden" class="form-control" id="content" name="content"
                                value="{{ old('content', $article->content ?? '') }}" required>
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
