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

                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Profile Details</h3>
                        </div>
                    </div>

                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <form method="POST" action="{{ route('profile.update') }}" id="kt_account_profile_details_form"
                            class="form" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="card-body border-top p-9">

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url('../assets/media/svg/avatars/blank.svg')">
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url({{ $user->avatar_url ?? '../assets/media/avatars/300-1.jpg' }})">
                                            </div>
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="ki-outline ki-pencil fs-7"></i>
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel avatar">
                                                <i class="ki-outline ki-cross fs-2"></i>
                                            </span>
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Remove avatar">
                                                <i class="ki-outline ki-cross fs-2"></i>
                                            </span>
                                        </div>
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Name</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name"
                                            class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                            value="{{ old('name', $user->name) }}" placeholder="Enter your name" />
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">NISN</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nisn"
                                            class="form-control form-control-lg form-control-solid"
                                            value="{{ old('nisn', $user->nisn) }}" placeholder="Enter your NISN" />
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">NIS</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nis"
                                            class="form-control form-control-lg form-control-solid"
                                            value="{{ old('nis', $user->nis) }}" placeholder="Enter your NIS" />
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Phone Number
                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            title="Enter an active phone number">
                                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                        </span>
                                    </label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="tel" name="phone_number"
                                            class="form-control form-control-lg form-control-solid"
                                            value="{{ old('phone_number', $user->phone_number) }}"
                                            placeholder="Enter phone number" />
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Class</label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="class" class="form-select form-select-solid"
                                            data-control="select2" data-placeholder="Select class">
                                            <option></option>
                                            <optgroup label="Animation">
                                                <option value="XI ANI A"
                                                    {{ $user->class == 'XI ANI A' ? 'selected' : '' }}>XI ANI A</option>
                                                <option value="XI ANI B"
                                                    {{ $user->class == 'XI ANI B' ? 'selected' : '' }}>XI ANI B</option>
                                                <option value="XI ANI C"
                                                    {{ $user->class == 'XI ANI C' ? 'selected' : '' }}>XI ANI C</option>
                                            </optgroup>
                                            <optgroup label="Visual Communication Design">
                                                <option value="XI DKV A"
                                                    {{ $user->class == 'XI DKV A' ? 'selected' : '' }}>XI DKV A</option>
                                                <option value="XI DKV B"
                                                    {{ $user->class == 'XI DKV B' ? 'selected' : '' }}>XI DKV B</option>
                                                <option value="XI DKV C"
                                                    {{ $user->class == 'XI DKV C' ? 'selected' : '' }}>XI DKV C</option>
                                            </optgroup>
                                            <!-- Add other optgroups with selection logic -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Birth Date</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-8 fv-row">
                                                <input type="date" name="birth_date"
                                                    class="form-control form-control-lg form-control-solid"
                                                    value="{{ old('birth_date', $user->birth_date) }}"
                                                    placeholder="Enter birth date" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Religion</label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="religion" class="form-select form-select-solid"
                                            data-control="select2" data-placeholder="Select religion">
                                            <option></option>
                                            <option value="Islam" {{ $user->religion == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Christian"
                                                {{ $user->religion == 'Christian' ? 'selected' : '' }}>Christian</option>
                                            <option value="Catholic"
                                                {{ $user->religion == 'Catholic' ? 'selected' : '' }}>Catholic</option>
                                            <option value="Hindu" {{ $user->religion == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Buddhist"
                                                {{ $user->religion == 'Buddhist' ? 'selected' : '' }}>Buddhist</option>
                                            <option value="Confucianism"
                                                {{ $user->religion == 'Confucianism' ? 'selected' : '' }}>Confucianism
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Address</label>
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" name="address"
                                                    class="form-control form-control-lg form-control-solid"
                                                    value="{{ old('address', $user->address) }}"
                                                    placeholder="Enter address" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Gender</label>
                                    <div class="col-lg-8 fv-row">
                                        <select name="gender" class="form-select form-select-solid"
                                            data-control="select2" data-placeholder="Select gender">
                                            <option></option>
                                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" class="btn btn-primary"
                                    id="kt_account_profile_details_submit">Save Changes</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

            @include('template.footer')

        </div>
    </div>

@endsection
