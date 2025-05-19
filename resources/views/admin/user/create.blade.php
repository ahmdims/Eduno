<div class="rbt-team-modal modal fade rbt-modal-default" id="createModal" tabindex="-1" aria-labelledby="createModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="username" class="form-label">Username <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" name="username" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" class="form-control" name="birth_date">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="gender" class="form-label">Gender</label>
                            <div class="rbt-modern-select bg-transparent height-45">
                                <select name="gender" class="form-control">
                                    <option value="" selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea id="bio" name="bio" cols="20" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="password" class="form-label">Password <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" class="form-control" name="password" required>
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