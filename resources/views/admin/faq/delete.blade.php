<div class="rbt-team-modal modal fade rbt-modal-default" tabindex="-1" id="deleteModal-{{ $faq_data->id }}"
    aria-labelledby="deleteModal-{{ $faq_data->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('faq.destroy', $faq_data->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="bi bi-trash"></i> Delete @yield('title')
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning!</strong> This action is irreversible. Once deleted, the @yield('title')
                        cannot be
                        recovered. Are you sure you want to delete this @yield('title')?
                    </div>
                    <p class="text-muted">
                        Deleting this @yield('title') will remove all associated content permanently. Please ensure
                        this is what
                        you want before proceeding.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="rbt-btn btn-sm btn-border" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="rbt-btn btn-sm bg-color-danger">Delete</button>
                </div>

            </form>
        </div>
    </div>
</div>
