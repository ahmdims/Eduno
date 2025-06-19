@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    <div class="d-flex flex-column flex-root" id="kt_app_root">

        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <a href="{{ route('login') }}" class="d-block d-lg-none mx-auto py-20">
                <img alt="Eduno" src="assets/media/logos/default.svg" class="theme-light-show h-25px" />
                <img alt="Eduno" src="assets/media/logos/default-dark.svg" class="theme-dark-show h-25px" />
            </a>

            <div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
                <div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
                    <div class="d-flex flex-stack py-2">
                        <div class="me-2">
                        </div>

                        <div class="m-0">
                            <span class="text-gray-500 fw-bold fs-5 me-2">
                                Not a Member yet?
                            </span>

                            <a href="{{ route('login') }}" class="link-primary fw-bold fs-5">
                                Login
                            </a>
                        </div>
                    </div>

                    <div class="py-20">
                        <form id="kt_sign_up_form" method="POST" action="{{ route('register') }}"
                            data-kt-redirect-url="{{ route('login') }}">
                            @csrf

                            <div class="text-start mb-10">
                                <h1 class="text-gray-900 mb-3 fs-3x">Register</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Welcome, Student! Register your account to start
                                    learning.</div>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                                    placeholder="Full Name" autocomplete="off" />
                            </div>

                            <div class="fv-row mb-7">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg form-control-solid"
                                    placeholder="Email" autocomplete="off" />
                            </div>

                            <div class="fv-row mb-7" data-kt-password-meter="true">
                                <label class="form-label">Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password"
                                        class="form-control form-control-lg form-control-solid pe-12" placeholder="Password"
                                        autocomplete="off" id="password" />
                                    <span class="btn btn-sm btn-icon position-absolute top-50 end-0 translate-middle-y me-3"
                                        data-kt-password-meter-control="visibility">
                                        <i class="ki-outline ki-eye-slash fs-2"></i>
                                        <i class="ki-outline ki-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                                <div class="d-flex align-items-center mt-2" data-kt-password-meter-control="highlight">
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                </div>
                                <div class="text-muted mt-1">Use 8 or more characters with a mix of letters, numbers &
                                    symbols.</div>
                            </div>

                            <div class="fv-row mb-7" data-kt-password-meter="true">
                                <label class="form-label">Confirm Password</label>
                                <div class="position-relative">
                                    <input type="password" name="password_confirmation"
                                        class="form-control form-control-lg form-control-solid pe-12"
                                        placeholder="Confirm Password" autocomplete="off" />
                                    <span class="btn btn-sm btn-icon position-absolute top-50 end-0 translate-middle-y me-3"
                                        data-kt-password-meter-control="visibility">
                                        <i class="ki-outline ki-eye-slash fs-2"></i>
                                        <i class="ki-outline ki-eye fs-2 d-none"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="form-label">Select Registration Type</label>
                                <select name="status" class="form-control form-control-solid" data-control="select2"
                                    data-placeholder="Select registration type" required>
                                    <option value="" disabled selected>Select registration type</option>
                                    <option value="Zoning">Zoning (based on domicile)</option>
                                    <option value="Affirmation">Affirmation</option>
                                    <option value="Achievement">Achievement</option>
                                </select>
                            </div>

                            <div class="fv-row mb-7">
                                <label class="form-label">Why did you choose RPL?</label>
                                <textarea name="reason" class="form-control form-control-solid" rows="3" placeholder="Write your reason here..."></textarea>
                            </div>

                            <div class="fv-row mb-8">
                                <label class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="toc" value="1" />
                                    <span class="form-check-label fw-semibold text-gray-700">
                                        I agree to the terms and conditions
                                    </span>
                                </label>
                            </div>

                            <div class="d-flex flex-stack">
                                <button id="kt_sign_up_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat"
                style="background-image: url(assets/media/auth/auth.png)">
            </div>
        </div>
    </div>

@endsection
