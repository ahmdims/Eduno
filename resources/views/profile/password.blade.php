@extends('layouts.main')

@section('title', $user->name)

@section('content')

    <div class="app-container container-xxl">

        <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
            <div class="d-flex flex-column flex-column-fluid">

                <div id="kt_app_content" class="app-content  flex-column-fluid ">

                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pt-9 pb-0">
                            <div class="d-flex flex-wrap flex-sm-nowrap">
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-fixed position-relative">
                                        <img src="{{ Auth::user()->profile ? Storage::url(Auth::user()->profile) : asset('assets/media/avatars/null.png') }}"
                                            alt="image" />
                                    </div>
                                </div>

                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex flex-column align-items-start mb-3">
                                                <div class="text-gray-900 text-hover-primary fs-2 fw-bold">
                                                    {{ Auth::user()->name }}
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row flex-wrap fw-semibold fs-6">
                                                <div
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <i class="ki-outline ki-profile-circle fs-4 me-2"></i>
                                                    {{ Auth::user()->utype ?: '-' }}
                                                </div>
                                                <div
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                                    <i class="ki-outline ki-fingerprint-scanning fs-4 me-2"></i>
                                                    {{ Auth::user()->nis ?: '-' }}
                                                </div>
                                                <div
                                                    class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                                    <i class="ki-outline ki-address-book fs-4 me-2"></i>
                                                    {{ Auth::user()->class ?: '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul
                            class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold justify-content-center">
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->routeIs('profile.index') ? 'active' : '' }}"
                                    href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">
                                    Summary
                                </a>
                            </li>

                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->routeIs('profile.edit') ? 'active' : '' }}"
                                    href="{{ route('profile.edit') }}">
                                    Settings
                                </a>
                            </li>

                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ request()->routeIs('profile.password') ? 'active' : '' }}"
                                    href="{{ route('profile.password') }}">
                                    Password
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="card  mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_signin_method">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Change Password</h3>
                        </div>
                    </div>

                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                            novalidate="novalidate">
                            <div class="card-body border-top p-9">
                                <div class="row mb-6" data-kt-password-meter="true">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Current
                                        Password</label>

                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <div class="position-relative mb-3">
                                            <input type="password" name="current_password"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="Enter current password">

                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="ki-outline ki-eye-slash fs-2"></i>
                                                <i class="ki-outline ki-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-6" data-kt-password-meter="true">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">New Password</label>

                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <div class="position-relative mb-3">
                                            <input class="form-control form-control-lg form-control-solid" type="password"
                                                placeholder="Enter new password" name="password" autocomplete="off" />

                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="ki-outline ki-eye-slash fs-2"></i>
                                                <i class="ki-outline ki-eye fs-2 d-none"></i>
                                            </span>
                                        </div>

                                        <div class="d-flex align-items-center mb-3"
                                            data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>

                                        <div class="text-muted">
                                            Use at least 8 characters with a mix of uppercase letters, numbers, and symbols.
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-6" data-kt-password-meter="true">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Confirm New
                                        Password</label>

                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <div class="position-relative mb-3">
                                            <input type="password" name="password_confirmation"
                                                class="form-control form-control-lg form-control-solid"
                                                placeholder="Repeat new password">

                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="ki-outline ki-eye-slash fs-2"></i>
                                                <i class="ki-outline ki-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset" class="btn btn-light btn-active-light-primary me-2">
                                    Discard
                                </button>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            @include('template.footer')

        </div>
    </div>

@endsection
