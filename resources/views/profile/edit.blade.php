@extends('layouts.main')

@section('title', $user->name)

@section('content')
<main>
    <div class="rbt-page-banner-wrapper">
        <div class="rbt-banner-image"></div>
    </div>
    <div class="rbt-dashboard-area rbt-section-overlayping-top rbt-section-gapBottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('template.banner')

                    <div class="row g-5">
                        @include('template.sidebar')

                        <div class="col-lg-9">
                            <div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
                                <div class="content">

                                    <div class="section-title">
                                        <h4 class="rbt-title-style-3">Settings</h4>
                                    </div>

                                    <div class="advance-tab-button mb--30">
                                        <ul class="nav nav-tabs tab-button-style-2 justify-content-start" id="settinsTab-4" role="tablist">
                                            <li role="presentation">
                                                <a href="#" class="tab-button active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                                    <span class="title">Profile</span>
                                                </a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#" class="tab-button" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" role="tab" aria-controls="password" aria-selected="false">
                                                    <span class="title">Password</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content">

                                        <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="rbt-profile-row rbt-default-form row row--15">
                                                @csrf
                                                @method('PATCH')

                                                <div class="rbt-dashboard-content-wrapper">
                                                    <div class="tutor-bg-photo bg_image height-350"
                                                        style="background-image: url('{{ $user->banner ? asset('storage/' . $user->banner) : asset('assets/images/about/banner.svg') }}');">
                                                        <img id="bannerImage" src="{{ $user->banner ? asset('storage/' . $user->banner) : asset('assets/images/about/banner.svg') }}" alt="Banner" class="d-none">
                                                    </div>
                                                    <div class="rbt-tutor-information">
                                                        <div class="thumbnail rbt-avatars size-lg position-relative">
                                                            <img style="object-fit: cover; object-position: center; width: 100%; height: 100%;" id="profile" src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('assets/images/about/avatar.svg') }}" alt="{{ $user->name }}">
                                                            <div class="rbt-edit-photo-inner">
                                                                <button class="rbt-edit-photo" id="editProfileBtn" type="button" title="Upload Photo">
                                                                    <i class="feather-camera"></i>
                                                                </button>
                                                                <input type="file" id="profileInput{{ $user->id }}" class="d-none" accept="image/*" name="profile">
                                                                @error('profile')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="tutor-btn">
                                                            <button class="rbt-btn btn-sm btn-border color-white radius-round-10" id="editBannerBtn" type="button">
                                                                Edit Cover Photo
                                                            </button>
                                                            <input type="file" id="bannerInput" class="d-none" accept="image/*" name="banner">
                                                        </div>
                                                    </div>
                                                </div>


                                                <script>
                                                    // Profil
                                                    const originalProfileSrc = document.getElementById('profile').src;
                                                    const profileInput = document.getElementById('profileInput{{ $user->id }}');
                                                    const profileImage = document.getElementById('profile');
                                                    const editProfileBtn = document.getElementById('editProfileBtn');

                                                    editProfileBtn.addEventListener('click', () => profileInput.click());

                                                    profileInput.addEventListener('change', () => {
                                                        const selectedFile = profileInput.files[0];

                                                        if (selectedFile) {
                                                            if (!selectedFile.type.startsWith('image/')) {
                                                                alert('Please upload a valid image file.');
                                                                profileInput.value = '';
                                                                return;
                                                            }

                                                            if (selectedFile.size > 2 * 1024 * 1024) {
                                                                alert('Image size should not exceed 2MB.');
                                                                profileInput.value = '';
                                                                return;
                                                            }

                                                            const reader = new FileReader();
                                                            reader.onload = (event) => {
                                                                profileImage.src = event.target.result;
                                                            };
                                                            reader.readAsDataURL(selectedFile);
                                                        } else {
                                                            profileImage.src = originalProfileSrc;
                                                        }
                                                    });

                                                    // Banner
                                                    const originalBannerSrc = document.getElementById('bannerImage').src;
                                                    const editBannerBtn = document.getElementById('editBannerBtn');
                                                    const bannerInput = document.getElementById('bannerInput');
                                                    const bannerImage = document.getElementById('bannerImage');

                                                    editBannerBtn.addEventListener('click', function() {
                                                        bannerInput.click();
                                                    });

                                                    bannerInput.addEventListener('change', function() {
                                                        const selectedFile = bannerInput.files[0];

                                                        if (selectedFile) {
                                                            const reader = new FileReader();
                                                            reader.onload = function(event) {
                                                                bannerImage.src = event.target.result;
                                                                bannerImage.classList.remove('d-none');
                                                            };
                                                            reader.readAsDataURL(selectedFile);
                                                        } else {
                                                            bannerImage.src = originalBannerSrc;
                                                        }
                                                    });
                                                </script>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="name">Name</label>
                                                        <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="username">User  Name</label>
                                                        <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}" required>
                                                        @error('username')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="email">E-mail</label>
                                                        <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required readonly>
                                                        @error('email')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="phone_number">Phone Number</label>
                                                        <input id="phone_number" name="phone_number" type="tel" value="{{ old('phone_number', $user->phone_number) }}">
                                                        @error('phone_number')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="birth_date">Birth Date</label>
                                                        <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', $user->birth_date ? $user->birth_date : '') }}">
                                                        @error('birth_date')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="gender" class="form-label">Gender</label>
                                                        <div class="rbt-modern-select bg-transparent height-45">
                                                            <select name="gender" class="form-control">
                                                                <option value="" {{ old('gender', $user->gender) == '' ? 'selected' : '' }}>Select Gender</option>
                                                                <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                                                <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                                                <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                                            </select>
                                                        </div>
                                                        @error('gender')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="bio">About Me</label>
                                                        <textarea id="bio" name="bio" cols="20" rows="5">{{ old('bio', $user->bio) }}</textarea>
                                                        @error('bio')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12 mt--20">
                                                    <div class="rbt-form-group">
                                                        <button class="rbt-btn btn-gradient btn-sm">Save</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                            <form method="post" action="{{ route('password.update') }}" class="rbt-profile-row rbt-default-form row row--15">
                                                @csrf
                                                @method('put')

                                                <div class="col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="currentpassword">Current Password</label>
                                                        <input id="currentpassword" name="current_password" type="password" placeholder="Current Password" autocomplete="current-password">
                                                        @if ($errors->updatePassword->get('current_password'))
                                                        <small class="text-danger">{{ $errors->updatePassword->first('current_password') }}</small>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="newpassword">New Password</label>
                                                        <input id="newpassword" name="password" type="password" placeholder="New Password" autocomplete="new-password">
                                                        @if ($errors->updatePassword->get('password'))
                                                            <small class="text-danger">{{ $errors->updatePassword->first('password') }}</small>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="rbt-form-group">
                                                        <label for="password_confirmation">Confirm Password</label>
                                                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" autocomplete="new-password">
                                                        @if ($errors->updatePassword->get('password_confirmation'))
                                                            <small class="text-danger">{{ $errors->updatePassword->first('password_confirmation') }}</small>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12 mt--10">
                                                    <div class="rbt-form-group">
                                                        <button type="submit" class="rbt-btn btn-gradient btn-sm">Save</button>
                                                        @if (session('status') === 'password-updated')
                                                            <p class="text-success mt-2">Saved.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection