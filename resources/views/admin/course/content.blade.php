<div class="rbt-team-modal modal fade rbt-modal-default" id="contentModal-{{ $course_data->id }}" tabindex="-1" aria-labelledby="contentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">{!! $course_data->description !!}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rbt-btn btn-sm btn-border" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
