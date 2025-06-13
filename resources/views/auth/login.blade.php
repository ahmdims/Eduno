@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="d-flex flex-column flex-root" id="kt_app_root">

        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <a href="index.html" class="d-block d-lg-none mx-auto py-20">
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

                            <a href="{{ route('register') }}" class="link-primary fw-bold fs-5"
                                data-kt-translate="sign-in-head-link">
                                Register
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
                                        Login
                                    </h1>

                                    <div class="text-gray-500 fw-semibold fs-6" data-kt-translate="general-desc">
                                        Get unlimited access & earn money
                                    </div>
                                </div>

                                <div class="fv-row mb-8">
                                    <input type="email" placeholder="Email" name="email" autocomplete="off"
                                        class="form-control form-control-solid" />
                                </div>

                                <div class="fv-row mb-7">
                                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                                        class="form-control form-control-solid" />
                                </div>

                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-10">
                                    <div></div>

                                    <a href="#" class="link-primary" data-kt-translate="sign-in-forgot-password">
                                        Forgot Password ?
                                    </a>
                                </div>

                                <div class="d-flex flex-stack">
                                    <button id="kt_sign_in_submit" class="btn btn-primary me-2 flex-shrink-0">
                                        <span class="indicator-label" data-kt-translate="sign-in-submit">
                                            Login
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
                style="background-image: url(assets/media/auth/bg11.png)">
            </div>
        </div>
    </div>

@endsection
