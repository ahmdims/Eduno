<div class="rbt-team-modal modal fade rbt-modal-default" id="updateModal-{{ $user_data->id }}" tabindex="-1"
    aria-labelledby="updateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.update', $user_data->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                            <input type="email" class="form-control" name="email" value="{{ $user_data->email }}"
                                required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="name" class="form-label">Name <small class="text-danger">*</small></label>
                            <input type="text" class="form-control" name="name" value="{{ $user_data->name }}" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="username" class="form-label">Username <small
                                    class="text-danger">*</small></label>
                            <input type="text" class="form-control" name="username" value="{{ $user_data->username }}"
                                required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number"
                                value="{{ $user_data->phone_number }}">
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" class="form-control" name="birth_date"
                                value="{{ old('birth_date', $user_data->birth_date ? $user_data->birth_date : '') }}">
                        </div>
                    </div>
                    <div class="mb-4 row">
                        <div class="col-md-6">
                            <div class="rbt-form-group">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="rbt-modern-select bg-transparent height-45">
                                    <select name="gender" class="form-control">
                                        <option value="" {{ $user_data->gender == '' ? 'selected' : '' }}>Select Gender
                                        </option>
                                        <option value="Male" {{ $user_data->gender == 'Male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="Female" {{ $user_data->gender == 'Female' ? 'selected' : '' }}>
                                            Female</option>
                                        <option value="Other" {{ $user_data->gender == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="rbt-form-group">
                                <label for="utype" class="form-label">User Type</label>
                                <div class="rbt-modern-select bg-transparent height-45">
                                    <select name="utype" class="form-control">
                                        <option value="student" {{ $user_data->utype == 'student' ? 'selected' : '' }}>
                                            Student</option>
                                        <option value="admin" {{ $user_data->utype == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="rbt-form-group">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea id="bio" name="bio" cols="20" rows="3">{{ $user_data->bio }}</textarea>
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