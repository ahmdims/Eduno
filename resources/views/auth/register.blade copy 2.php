@extends('layouts.auth')

@section('title', 'Register')

@section('content')

    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column stepper-multistep"
            id="kt_create_account_stepper">
            <div class="d-flex flex-column flex-lg-row-auto w-lg-350px w-xl-500px">
                <div class="d-flex flex-column position-lg-fixed top-0 bottom-0 w-lg-350px w-xl-500px scroll-y bgi-size-cover bgi-position-center"
                    style="background-image: url(assets/media/misc/auth-bg.png)">
                    <div class="d-flex flex-center py-10 py-lg-20 mt-lg-20">
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('assets/media/logos/default.svg') }}" class="h-50px" />
                        </a>
                    </div>

                    <div class="d-flex flex-row-fluid justify-content-center p-10">
                        <div class="stepper-nav">
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon rounded-3">
                                        <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">1</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title fs-2">
                                            Account Type
                                        </h3>

                                        <div class="stepper-desc fw-normal">
                                            Select your account type
                                        </div>
                                    </div>
                                </div>

                                <div class="stepper-line h-40px">
                                </div>
                            </div>

                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon rounded-3">
                                        <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">2</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title fs-2">
                                            Account Info
                                        </h3>
                                        <div class="stepper-desc fw-normal">
                                            Setup your account settings
                                        </div>
                                    </div>
                                </div>

                                <div class="stepper-line h-40px">
                                </div>
                            </div>

                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon">
                                        <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">3</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title fs-2">
                                            Business Details
                                        </h3>
                                        <div class="stepper-desc fw-normal">
                                            Setup your business details
                                        </div>
                                    </div>
                                </div>

                                <div class="stepper-line h-40px">
                                </div>
                            </div>

                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon">
                                        <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">4</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title ">
                                            Billing Details
                                        </h3>
                                        <div class="stepper-desc fw-normal">
                                            Provide your payment info
                                        </div>
                                    </div>
                                </div>

                                <div class="stepper-line h-40px">
                                </div>
                            </div>

                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon">
                                        <i class="ki-outline ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">5</span>
                                    </div>

                                    <div class="stepper-label">
                                        <h3 class="stepper-title ">
                                            Completed
                                        </h3>
                                        <div class="stepper-desc fw-normal">
                                            Your account is created
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-center flex-wrap px-5 py-10">
                        <div class="d-flex fw-normal">
                            <a href="https://keenthemes.com/" class="text-success px-5" target="_blank">Terms</a>

                            <a href="https://devs.keenthemes.com/" class="text-success px-5" target="_blank">Plans</a>

                            <a href="https://1.envato.market/Vm7VRE" class="text-success px-5" target="_blank">Contact
                                Us</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-650px w-xl-700px p-10 p-lg-15 mx-auto">
                        <form class="my-auto pb-5" novalidate="novalidate" id="kt_create_account_form">
                            <div class="current" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-15">
                                        <!--begin::Title-->
                                        <h2 class="fw-bold d-flex align-items-center text-gray-900">
                                            Choose Account Type
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Billing is issued based on your selected account typ">
                                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>
                                        </h2>

                                        <div class="text-muted fw-semibold fs-6">
                                            If you need more info, please check out
                                            <a href="#" class="link-primary fw-bold">Help Page</a>.
                                        </div>
                                    </div>

                                    <div class="fv-row">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="radio" class="btn-check" name="account_type" value="personal"
                                                    checked="checked" id="kt_create_account_form_account_type_personal" />
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10"
                                                    for="kt_create_account_form_account_type_personal">
                                                    <i class="ki-outline ki-badge fs-3x me-5"></i>

                                                    <span class="d-block fw-semibold text-start">
                                                        <span class="text-gray-900 fw-bold d-block fs-4 mb-2">
                                                            Personal Account
                                                        </span>
                                                        <span class="text-muted fw-semibold fs-6">If you need more info,
                                                            please check it out</span>
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="col-lg-6">
                                                <input type="radio" class="btn-check" name="account_type"
                                                    value="corporate"
                                                    id="kt_create_account_form_account_type_corporate" />
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
                                                    for="kt_create_account_form_account_type_corporate">
                                                    <i class="ki-outline ki-briefcase fs-3x me-5"></i>
                                                    <span class="d-block fw-semibold text-start">
                                                        <span class="text-gray-900 fw-bold d-block fs-4 mb-2">Corporate
                                                            Account</span>
                                                        <span class="text-muted fw-semibold fs-6">Create corporate
                                                            account to mane users</span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-15">
                                        <h2 class="fw-bold text-gray-900">Account Info</h2>

                                        <div class="text-muted fw-semibold fs-6">
                                            If you need more info, please check out
                                            <a href="#" class="link-primary fw-bold">Help Page</a>.
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="d-flex align-items-center form-label mb-3">
                                            Specify Team Size
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Provide your team size to help us setup your billing">
                                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>
                                        </label>

                                        <div class="row mb-2" data-kt-buttons="true">
                                            <div class="col">
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                                    <input type="radio" class="btn-check" name="account_team_size"
                                                        value="1-1" />
                                                    <span class="fw-bold fs-3">1-1</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
                                                    <input type="radio" class="btn-check" name="account_team_size"
                                                        checked value="2-10" />
                                                    <span class="fw-bold fs-3">2-10</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                                    <input type="radio" class="btn-check" name="account_team_size"
                                                        value="10-50" />
                                                    <span class="fw-bold fs-3">10-50</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label
                                                    class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                                                    <input type="radio" class="btn-check" name="account_team_size"
                                                        value="50+" />
                                                    <span class="fw-bold fs-3">50+</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-text">
                                            Customers will see this shortened version of your statement descriptor
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="form-label mb-3">Team Account Name</label>

                                        <input type="text" class="form-control form-control-lg form-control-solid"
                                            name="account_name" placeholder="" value="" />
                                    </div>

                                    <div class="mb-0 fv-row">
                                        <label class="d-flex align-items-center form-label mb-5">
                                            Select Account Plan
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Monthly billing will be based on your account plan">
                                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>
                                        </label>

                                        <div class="mb-0">
                                            <label class="d-flex flex-stack mb-5 cursor-pointer">
                                                <span class="d-flex align-items-center me-2">
                                                    <span class="symbol symbol-50px me-6">
                                                        <span class="symbol-label">
                                                            <i class="ki-outline ki-bank fs-1 text-gray-600"></i>
                                                        </span>
                                                    </span>

                                                    <span class="d-flex flex-column">
                                                        <span class="fw-bold text-gray-800 text-hover-primary fs-5">Company
                                                            Account</span>
                                                        <span class="fs-6 fw-semibold text-muted">Use images to enhance
                                                            your post flow</span>
                                                    </span>
                                                </span>

                                                <span class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" name="account_plan"
                                                        value="1" />
                                                </span>
                                            </label>

                                            <label class="d-flex flex-stack mb-5 cursor-pointer">
                                                <span class="d-flex align-items-center me-2">
                                                    <span class="symbol symbol-50px me-6">
                                                        <span class="symbol-label">
                                                            <i class="ki-outline ki-chart fs-1 text-gray-600"></i>
                                                        </span>
                                                    </span>

                                                    <span class="d-flex flex-column">
                                                        <span
                                                            class="fw-bold text-gray-800 text-hover-primary fs-5">Developer
                                                            Account</span>
                                                        <span class="fs-6 fw-semibold text-muted">Use images to your
                                                            post time</span>
                                                    </span>
                                                </span>

                                                <span class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" checked
                                                        name="account_plan" value="2" />
                                                </span>
                                            </label>

                                            <label class="d-flex flex-stack mb-0 cursor-pointer">
                                                <span class="d-flex align-items-center me-2">
                                                    <span class="symbol symbol-50px me-6">
                                                        <span class="symbol-label">
                                                            <i class="ki-outline ki-chart-pie-4 fs-1 text-gray-600"></i>
                                                        </span>
                                                    </span>

                                                    <span class="d-flex flex-column">
                                                        <span class="fw-bold text-gray-800 text-hover-primary fs-5">Testing
                                                            Account</span>
                                                        <span class="fs-6 fw-semibold text-muted">Use images to enhance
                                                            time travel rivers</span>
                                                    </span>
                                                </span>

                                                <span class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" name="account_plan"
                                                        value="3" />
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-12">
                                        <h2 class="fw-bold text-gray-900">Business Details</h2>

                                        <div class="text-muted fw-semibold fs-6">
                                            If you need more info, please check out
                                            <a href="#" class="link-primary fw-bold">Help Page</a>.
                                        </div>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="form-label required">Business Name</label>

                                        <input name="business_name"
                                            class="form-control form-control-lg form-control-solid"
                                            value="Keenthemes Inc." />
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="d-flex align-items-center form-label">
                                            <span class="required">Shortened Descriptor</span>
                                        </label>

                                        <input name="business_descriptor"
                                            class="form-control form-control-lg form-control-solid" value="KEENTHEMES" />

                                        <div class="form-text">
                                            Customers will see this shortened version of your statement descriptor
                                        </div>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="form-label required">Corporation Type</label>

                                        <select name="business_type" class="form-select form-select-lg form-select-solid"
                                            data-control="select2" data-placeholder="Select..." data-allow-clear="true"
                                            data-hide-search="true">
                                            <option></option>
                                            <option value="1">S Corporation</option>
                                            <option value="1">C Corporation</option>
                                            <option value="2">Sole Proprietorship</option>
                                            <option value="3">Non-profit</option>
                                            <option value="4">Limited Liability</option>
                                            <option value="5">General Partnership</option>
                                        </select>
                                    </div>

                                    <div class="fv-row mb-10">
                                        <label class="form-label">Business Description</label>

                                        <textarea name="business_description" class="form-control form-control-lg form-control-solid" rows="3"></textarea>
                                    </div>

                                    <div class="fv-row mb-0">
                                        <label class="fs-6 fw-semibold form-label required">Contact Email</label>

                                        <input name="business_email"
                                            class="form-control form-control-lg form-control-solid"
                                            value="corp@support.com" />
                                    </div>
                                </div>

                            </div>

                            <div class="" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-15">
                                        <h2 class="fw-bold text-gray-900">Billing Details</h2>

                                        <div class="text-muted fw-semibold fs-6">
                                            If you need more info, please check out
                                            <a href="#" class="text-primary fw-bold">Help Page</a>.
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Name On Card</span>

                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                title="Specify a card holder's name">
                                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>
                                        </label>

                                        <input type="text" class="form-control form-control-solid" placeholder=""
                                            name="card_name" value="Max Doe" />
                                    </div>

                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <label class="required fs-6 fw-semibold form-label mb-2">Card Number</label>

                                        <div class="position-relative">
                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter card number" name="card_number"
                                                value="4111 1111 1111 1111" />

                                            <div class="position-absolute translate-middle-y top-50 end-0 me-5">
                                                <img src="../../assets/media/svg/card-logos/visa.svg" alt=""
                                                    class="h-25px" />
                                                <img src="../../assets/media/svg/card-logos/mastercard.svg" alt=""
                                                    class="h-25px" />
                                                <img src="../../assets/media/svg/card-logos/american-express.svg"
                                                    alt="" class="h-25px" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-10">
                                        <div class="col-md-8 fv-row">
                                            <label class="required fs-6 fw-semibold form-label mb-2">Expiration
                                                Date</label>

                                            <div class="row fv-row">
                                                <div class="col-6">
                                                    <select name="card_expiry_month" class="form-select form-select-solid"
                                                        data-control="select2" data-hide-search="true"
                                                        data-placeholder="Month">
                                                        <option></option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                    </select>
                                                </div>

                                                <div class="col-6">
                                                    <select name="card_expiry_year" class="form-select form-select-solid"
                                                        data-control="select2" data-hide-search="true"
                                                        data-placeholder="Year">
                                                        <option></option>
                                                        <option value="2025">2025</option>
                                                        <option value="2026">2026</option>
                                                        <option value="2027">2027</option>
                                                        <option value="2028">2028</option>
                                                        <option value="2029">2029</option>
                                                        <option value="2030">2030</option>
                                                        <option value="2031">2031</option>
                                                        <option value="2032">2032</option>
                                                        <option value="2033">2033</option>
                                                        <option value="2034">2034</option>
                                                        <option value="2035">2035</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 fv-row">
                                            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                                <span class="required">CVV</span>

                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    title="Enter a card CVV code">
                                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>
                                            </label>

                                            <div class="position-relative">
                                                <input type="text" class="form-control form-control-solid"
                                                    minlength="3" maxlength="4" placeholder="CVV" name="card_cvv" />

                                                <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                                    <i class="ki-outline ki-credit-cart fs-2hx"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-stack">
                                        <div class="me-5">
                                            <label class="fs-6 fw-semibold form-label">Save Card for further
                                                billing?</label>
                                            <div class="fs-7 fw-semibold text-muted">If you need more info, please check
                                                budget planning</div>
                                        </div>

                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                checked="checked" />
                                            <span class="form-check-label fw-semibold text-muted">
                                                Save Card
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="" data-kt-stepper-element="content">

                                <div class="w-100">
                                    <div class="pb-8 pb-lg-10">
                                        <h2 class="fw-bold text-gray-900">Your Are Done!</h2>

                                        <div class="text-muted fw-semibold fs-6">
                                            If you need more info, please
                                            <a href="#" class="link-primary fw-bold">
                                                Sign In
                                            </a>
                                            .
                                        </div>
                                    </div>

                                    <div class="mb-0">
                                        <div class="fs-6 text-gray-600 mb-5">
                                            Writing headlines for blog posts is as much an art as it is a science
                                            and probably warrants its own post, but for all advise is with what
                                            works for your great & amazing audience.
                                        </div>

                                        <div
                                            class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                                            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>

                                            <div class="d-flex flex-stack flex-grow-1 ">
                                                <div class=" fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold">We need your attention!</h4>

                                                    <div class="fs-6 text-gray-700 ">To start using great tools, please,
                                                        <a href="../../utilities/wizards/vertical.html"
                                                            class="fw-bold">Create Team Platform</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="d-flex flex-stack pt-15">
                                <div class="mr-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3"
                                        data-kt-stepper-action="previous">
                                        <i class="ki-outline ki-arrow-left fs-4 me-1"></i> Previous
                                    </button>
                                </div>

                                <div>
                                    <button type="button" class="btn btn-lg btn-primary"
                                        data-kt-stepper-action="submit">
                                        <span class="indicator-label">
                                            Submit
                                            <i class="ki-outline ki-arrow-right fs-4 ms-2"></i> </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>

                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                        Continue
                                        <i class="ki-outline ki-arrow-right fs-4 ms-1"></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
