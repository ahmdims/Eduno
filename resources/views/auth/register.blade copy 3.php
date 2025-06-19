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
                            <span class="text-gray-500 fw-bold fs-5 me-2" data-kt-translate="sign-in-head-desc">
                                Not a Member yet?
                            </span>

                            <a href="{{ route('login') }}" class="link-primary fw-bold fs-5"
                                data-kt-translate="sign-in-head-link">
                                Login
                            </a>
                        </div>
                    </div>

                    <div class="py-20">
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST"
                            action="{{ route('login') }}" data-kt-redirect-url="{{ url('/') }}">
                            @csrf

                            <div class="card-body">
                                <div class="text-start mb-10">
                                    <h1 class="text-gray-900 mb-3 fs-3x" data-kt-translate="sign-in-title">
                                        Register
                                    </h1>

                                    <div class="text-gray-500 fw-semibold fs-6" data-kt-translate="general-desc">
                                        Welcome, Student! Register your account to start learning.
                                    </div>
                                </div>

                                <div class="fv-row mb-8">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" placeholder="Email" name="email"
                                        autocomplete="off" data-kt-translate="sign-in-input-email"
                                        class="form-control form-control-solid" />
                                </div>

                                <div class="fv-row mb-8 position-relative" data-kt-password-meter="true">
                                    <label for="password" class="form-label">Password</label>

                                    <div class="position-relative">
                                        <input type="password" name="password" placeholder="Password" autocomplete="off"
                                            class="form-control form-control-solid pr-10" id="password" />
                                        <span
                                            class="btn btn-sm btn-icon position-absolute top-50 end-0 translate-middle-y me-3"
                                            data-kt-password-meter-control="visibility" tabindex="-1">
                                            <i class="ki-outline ki-eye-slash fs-2"></i>
                                            <i class="ki-outline ki-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="fv-row mb-8">
                                    <label for="option-select" class="form-label">Select registration type</label>
                                    <select name="status" class="form-control form-control-solid" data-control="select2"
                                        data-hide-search="true" data-placeholder="Select registration type"
                                        id="kt_course_add_status_select" required>
                                        <option value="" disabled selected>Select registration type</option>
                                        <option value="Zoning">Zoning (based on domicile)</option>
                                        <option value="Affirmation">Affirmation</option>
                                        <option value="Achievement">Achievement</option>
                                    </select>
                                </div>

                                <div class="fv-row mb-8">
                                    <label for="message" class="form-label">Why did you choose RPL?</label>
                                    <textarea id="message" class="form-control form-control-solid" rows="3" placeholder="Write your reason here..."
                                        data-kt-translate="sign-in-textarea"></textarea>
                                </div>

                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                </div>

                                <div class="d-flex flex-stack">
                                    <button id="kt_sign_in_submit" class="btn btn-primary me-2 flex-shrink-0">
                                        <span class="indicator-label" data-kt-translate="sign-in-submit">
                                            Sign In
                                        </span>
                                        <span class="indicator-progress">
                                            <span data-kt-translate="general-progress">Please wait...</span>
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
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
