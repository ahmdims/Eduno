<div class="rbt-team-modal modal fade rbt-modal-default" id="contentModal-{{ $mail_data->id }}" tabindex="-1"
    aria-labelledby="contentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="b3"><strong>From:</strong> {{ $mail_data->name }} <br>
                        <strong>Email:</strong> <a href="mailto:{{ $mail_data->email }}">{{ $mail_data->email }}</a>
                    </p>

                    <p class="b3"><strong>Subject:</strong> {{ $mail_data->subject }}</p>

                    <div class="email-message">
                        <p class="b3">{{ $mail_data->message }}</p>
                    </div>

                    <p class="b3 mb--5">
                        <strong>Sent on:</strong> {{ $mail_data->created_at->format('d F Y') }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="rbt-btn btn-sm btn-border" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
