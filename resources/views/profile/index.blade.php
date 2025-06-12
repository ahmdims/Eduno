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
                                        <img src="../../assets/media/avatars/300-1.jpg" alt="image" />
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

                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                    <div class="card-header cursor-pointer">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Detail Profile</h3>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary align-self-center">
                            Edit Profile</a>
                    </div>

                    <div class="card-body p-9">
                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Name</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">
                                    {{ Auth::user()->name ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">username</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">
                                    {{ Auth::user()->username ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">NISN</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-semibold text-gray-800 fs-6">
                                    {{ Auth::user()->nisn ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">NIS</label>
                            <div class="col-lg-8 fv-row">
                                <span class="fw-semibold text-gray-800 fs-6">
                                    {{ Auth::user()->nis ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Phone Number</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bold fs-6 text-gray-800 me-2">
                                    {{ Auth::user()->phone_number ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Class</label>
                            <div class="col-lg-8">
                                <span class="fw-semibold fs-6 text-gray-800 text-hover-primary">
                                    {{ Auth::user()->class ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Birth Date</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">
                                    {{ Auth::user()->birth_date ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Religion</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">
                                    {{ Auth::user()->religion ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Address</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">
                                    {{ Auth::user()->address ?: '-' }}
                                </span>
                            </div>
                        </div>

                        <div class="row mb-7">
                            <label class="col-lg-4 fw-semibold text-muted">Gender</label>
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">
                                    {{ Auth::user()->gender ?: '-' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('template.footer')

        </div>
    </div>

@endsection
