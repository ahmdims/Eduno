<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - ClassXpert</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="admin/media/logos/default.svg" />

    <link rel="shortcut icon" href="{{ asset('admin/media/logos/default.svg') }}" />

    <link href="{{ asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

@include('template.flasher')

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">

    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">

            <div id="kt_app_header" class="app-header " data-kt-sticky="true"
                data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky"
                data-kt-sticky-offset="{default: false, lg: '300px'}">

                <div class="app-container  container-xxl d-flex align-items-stretch justify-content-between "
                    id="kt_app_header_container">
                    <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                            <i class="ki-outline ki-abstract-14 fs-2"></i>
                        </div>
                    </div>

                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-18">
                        <a href="index.html">
                            <img alt="Logo"
                                src="{{ asset('admin/media/logos/demo34-small.svg" class="h-25px d-sm-none') }}" />
                            <img alt="Logo" src="{{ asset('admin/media/logos/demo34.png') }}"
                                class="h-25px d-none d-sm-block" />
                        </a>
                    </div>

                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                        id="kt_app_header_wrapper">

                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                            data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                            data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
                            data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                            data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                            <div class=" menu
                                menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                                id="kt_app_header_menu" data-kt-menu="true">

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0"
                                    class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                    <a href="index.html" class="menu-link">
                                        <span class="menu-title">Dashboard</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0"
                                    class="menu-item menu-lg-down-accordion me-0 me-lg-2">
                                    <a href="index.html" class="menu-link">
                                        <span class="menu-title">Category</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0"
                                    class="menu-item menu-lg-down-accordion me-0 me-lg-2 {{ request()->routeIs('admin.course.*') ? 'here show menu-here-bg' : '' }}">
                                    <a href="{{ route('admin.course.index') }}" class="menu-link">
                                        <span class="menu-title">Course</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0"
                                    class="menu-item menu-lg-down-accordion me-0 me-lg-2 {{ request()->routeIs('admin.article.*') ? 'here show menu-here-bg' : '' }}">
                                    <a href="{{ route('admin.article.index') }}" class="menu-link">
                                        <span class="menu-title">Article</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0"
                                    class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <a href="admin.html" class="menu-link">
                                        <span class="menu-title">FAQ</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0"
                                    class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <a href="admin.html" class="menu-link">
                                        <span class="menu-title">Website</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0"
                                    class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <a href="admin.html" class="menu-link">
                                        <span class="menu-title">User</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start" data-kt-menu-offset="-200,0"
                                    class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                                    <a href="admin.html" class="menu-link">
                                        <span class="menu-title">Mail</span>
                                        <span class="menu-arrow d-lg-none"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="app-navbar flex-shrink-0">
                            <div class="app-navbar-item ms-5" id="kt_header_user_menu_toggle">
                                <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
                                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <img class="symbol symbol-circle symbol-35px symbol-md-40px"
                                        src="admin/media/avatars/300-13.jpg" alt="user" />
                                </div>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                <img alt="Logo"
                                                    src="{{ asset('admin/media/avatars/300-13.jpg') }}" />
                                            </div>

                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">
                                                    {{ Auth::user()->name }}
                                                </div>

                                                <a href="#"
                                                    class="fw-semibold text-muted text-hover-primary fs-7">
                                                    {{ Auth::user()->email }} </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="separator my-2"></div>

                                    <div class="menu-item px-5">
                                        <a href="profil.html" class="menu-link px-5">
                                            My Profile
                                        </a>
                                    </div>

                                    <div class="menu-item px-5">
                                        <a href="setting.html" class="menu-link px-5">
                                            Setting
                                        </a>
                                    </div>

                                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                        <a href="#" class="menu-link px-5">
                                            <span class="menu-title position-relative">
                                                Mode

                                                <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                                    <i class="ki-outline ki-night-day theme-light-show fs-2"></i> <i
                                                        class="ki-outline ki-moon theme-dark-show fs-2"></i> </span>
                                            </span>
                                        </a>

                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                            data-kt-menu="true" data-kt-element="theme-mode-menu">
                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                                    data-kt-value="light">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <i class="ki-outline ki-night-day fs-2"></i> </span>
                                                    <span class="menu-title">
                                                        Light
                                                    </span>
                                                </a>
                                            </div>

                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                                    data-kt-value="dark">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <i class="ki-outline ki-moon fs-2"></i> </span>
                                                    <span class="menu-title">
                                                        Dark
                                                    </span>
                                                </a>
                                            </div>

                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                                    data-kt-value="system">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <i class="ki-outline ki-screen fs-2"></i> </span>
                                                    <span class="menu-title">
                                                        System
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="menu-item px-5">
                                        <a href="authentication/layouts/corporate/sign-in.html"
                                            class="menu-link px-5">
                                            Sign Out
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                <div id="kt_app_toolbar" class="app-toolbar  py-6 ">
                    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex align-items-start ">
                        <div class="d-flex flex-column flex-row-fluid">
                            <div class="d-flex align-items-center pt-1">

                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold">

                                    <li class="breadcrumb-item text-white fw-bold lh-1">
                                        <a href="index.html" class="text-white text-hover-primary">
                                            <i class="ki-outline ki-home text-gray-700 fs-6"></i> </a>
                                    </li>

                                    <li class="breadcrumb-item">
                                        <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                                    </li>

                                    <li class="breadcrumb-item text-white fw-bold lh-1">
                                        Course </li>
                                </ul>
                            </div>

                            <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                                <div class="page-title me-5">
                                    <h1
                                        class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                                        Welcome back, {{ Auth::user()->name }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>

        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <i class="ki-outline ki-arrow-up"></i>
        </div>

        <script>
            var hostUrl = "admin/index.html";
        </script>

        <script src="{{ asset('admin/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('admin/js/scripts.bundle.js') }}"></script>

        <script src="{{ asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
        <script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>

        <script src="{{ asset('admin/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('admin/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('admin/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ asset('admin/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
        <script src="{{ asset('admin/js/custom/utilities/modals/new-target.js') }}"></script>
        <script src="{{ asset('admin/js/custom/utilities/modals/create-app.js') }}"></script>
        <script src="{{ asset('admin/js/custom/utilities/modals/users-search.js') }}"></script>

        <script src="{{ asset('admin/js/custom/apps/admin/course/course.js') }}"></script>
        <script src="{{ asset('admin/js/custom/apps/admin/course/edit-course.js') }}"></script>
</body>

</html>
