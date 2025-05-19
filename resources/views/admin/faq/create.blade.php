<div class="rbt-team-modal modal fade rbt-modal-default" id="formModal" tabindex="-1" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('faq.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="question" class="form-label">Question <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" id="question" name="question" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="answer" class="form-label">Answer <small class="text-danger">*</small></label>
                            <input type="hidden" class="form-control" id="answer" name="answer" required>
                            <trix-editor input="answer"></trix-editor>
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