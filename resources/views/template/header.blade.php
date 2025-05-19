<header class="rbt-header rbt-header-4">
    <div class="rbt-header-wrapper header-space-betwween header-sticky">
        <div class="container-fluid">
            <div class="mainbar-row rbt-navigation-start align-items-center">

                <div class="header-left">
                    <div class="logo logo-dark">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo/logo-dark.svg') }}" alt="ClassXpert">
                        </a>
                    </div>

                    <div class="logo d-none logo-light">
                        <a href="/">
                            <img src="{{ asset('assets/images/logo/logo-light.svg') }}" alt="ClassXpert">
                        </a>
                    </div>
                </div>

                <div class="rbt-main-navigation d-none d-xl-block">
                    <nav class="mainmenu-nav">
                        <ul class="mainmenu">
                            <li class="with-megamenu has-menu-child-item position-static">
                                <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
                            </li>
                            <li class="with-megamenu has-menu-child-item position-static">
                                <a href="{{ route('courses.index') }}"
                                    class="{{ Request::is('course*') ? 'active' : '' }}">Course</a>
                            </li>
                            <li class="with-megamenu has-menu-child-item position-static">
                                <a href="{{ route('article.index') }}"
                                    class="{{ Request::is('article*') ? 'active' : '' }}">Article</a>
                            </li>
                            <li class="with-megamenu has-menu-child-item position-static">
                                <a href="{{ route('app.faq.index') }}"
                                    class="{{ Request::is('faq') ? 'active' : '' }}">Faq</a>
                            </li>
                            <li class="with-megamenu has-menu-child-item position-static">
                                <a href="{{ route('app.contact.index') }}"
                                    class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                            </li>
                            @auth
                                @if (Auth::user()->utype === 'admin')
                                    <li class="has-dropdown has-menu-child-item">
                                        <a href="#" class="{{ Request::is('admin*') ? 'active' : '' }}">
                                            Manage Admin <i class="feather-chevron-down"></i>
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('admin.course.index') }}"
                                                    class="{{ Request::is('*admin/course*') ? 'active' : '' }}">Manage
                                                    Course</a></li>
                                            <li><a href="{{ route('admin.article.index') }}"
                                                    class="{{ Request::is('*admin/article') ? 'active' : '' }}">Manage
                                                    Article</a></li>
                                            <li><a href="{{ route('admin.faq.index') }}"
                                                    class="{{ Request::is('*admin/faq') ? 'active' : '' }}">Manage Faq</a>
                                            </li>
                                            <li><a href="{{ route('admin.website.index') }}"
                                                    class="{{ Request::is('*admin/website') ? 'active' : '' }}">Manage
                                                    Website</a></li>
                                            <li><a href="{{ route('admin.user.index') }}"
                                                    class="{{ Request::is('*admin/user') ? 'active' : '' }}">Manage
                                                    User</a></li>
                                            <li><a href="{{ route('admin.admin.index') }}"
                                                    class="{{ Request::is('*admin/admin') ? 'active' : '' }}">Manage
                                                    Admin</a></li>
                                            <li><a href="{{ route('admin.mail.index') }}"
                                                    class="{{ Request::is('*admin/mail') ? 'active' : '' }}">Manage
                                                    Mail</a></li>
                                        </ul>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </nav>
                </div>

                <div class="header-right">
                    <ul class="quick-access">

                        @guest
                            <a class="rbt-btn rbt-switch-btn btn-gradient btn-sm hover-transform-none"
                                href="{{ route('login') }}">
                                <span data-text="Login">Login</span>
                            </a>
                        @endguest

                        @auth
                            <li class="account-access rbt-user-wrapper d-block right-align-dropdown">
                                <a href="#">
                                    <i class="feather-user"></i>
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="rbt-user-menu-list-wrapper">
                                    <div class="inner">
                                        <div class="rbt-admin-profile">
                                            <div class="admin-thumbnail">
                                                <img src="{{ Auth::user()->profile ? asset('storage/' . Auth::user()->profile) : asset('assets/images/about/avatar.svg') }}"
                                                    alt="{{ Auth::user()->name }}">
                                            </div>
                                            <div class="admin-info">
                                                <span class="name">{{ explode(' ', Auth::user()->name)[0] }}</span>
                                                <a class="rbt-btn-link color-primary"
                                                    href="{{ route('profile.index', Auth::user()->username) }}">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                        <ul class="user-list-wrapper">
                                            <li>
                                                <a href="{{ route('profile.index', Auth::user()->username) }}">
                                                    <i class="feather-home"></i>
                                                    <span>My Dashboard</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <hr class="mt--10 mb--10">
                                        <ul class="user-list-wrapper">
                                            <li>
                                                <a href="{{ route('profile.edit', Auth::user()->id) }}">
                                                    <i class="feather-settings"></i>
                                                    <span>Settings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                                    @csrf
                                                    <a href="#"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <i class="feather-log-out"></i>
                                                        <span>Logout</span>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endauth
                    </ul>

                    <div class="mobile-menu-bar d-block d-xl-none">
                        <div class="hamberger">
                            <button class="hamberger-button rbt-round-btn">
                                <i class="feather-menu"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="popup-mobile-menu">
    <div class="inner-wrapper">
        <div class="inner-top">
            <div class="content">
                <div class="logo">
                    <div class="logo logo-dark">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo/logo-dark.svg') }}" alt="ClassXpert">
                        </a>
                    </div>

                    <div class="logo d-none logo-light">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo/logo-dark.svg') }}" alt="ClassXpert">
                        </a>
                    </div>
                </div>
                <div class="rbt-btn-close">
                    <button class="close-button rbt-round-btn"><i class="feather-x"></i></button>
                </div>
            </div>
        </div>

        <nav class="mainmenu-nav">
            <ul class="mainmenu">
                <li class="position-static">
                    <a href="{{ route('home') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
                </li>
                <li class="position-static">
                    <a href="{{ route('courses.index') }}" class="{{ Request::is('course*') ? 'active' : '' }}">Course</a>
                </li>
                <li class="position-static">
                    <a href="{{ route('article.index') }}" class="{{ Request::is('article*') ? 'active' : '' }}">Article</a>
                </li>
                <li class="position-static">
                    <a href="{{ route('app.faq.index') }}" class="{{ Request::is('faq') ? 'active' : '' }}">Faq</a>
                </li>
                <li class="position-static">
                    <a href="{{ route('app.contact.index') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a>
                </li>

                @auth
                    @if (Auth::user()->utype === 'admin')
                        <li class="with-megamenu has-menu-child-item position-static">
                            <a href="#" class="{{ Request::is('admin*') ? 'active' : '' }}">Manage Admin <i
                                    class="feather-chevron-down"></i></a>
                            <div class="rbt-megamenu grid-item-3">
                                <div class="wrapper">
                                    <div class="row row--15 single-dropdown-menu-presentation">
                                        <div class="col-lg-4 col-xxl-4 single-mega-item">
                                            <ul class="mega-menu-item">
                                                <li><a href="{{ route('admin.course.index') }}"
                                                        class="{{ Request::is('*admin/course*') ? 'active' : '' }}">Manage
                                                        Course</a>
                                                </li>
                                                <li><a href="{{ route('admin.article.index') }}"
                                                        class="{{ Request::is('*admin/article') ? 'active' : '' }}">Manage
                                                        Article</a></li>
                                                <li><a href="{{ route('admin.faq.index') }}"
                                                        class="{{ Request::is('*admin/faq') ? 'active' : '' }}">Manage
                                                        Faq</a>
                                                </li>
                                                <li><a href="{{ route('admin.website.index') }}"
                                                        class="{{ Request::is('*admin/website') ? 'active' : '' }}">Manage
                                                        Website</a>
                                                </li>
                                                <li><a href="{{ route('admin.user.index') }}"
                                                        class="{{ Request::is('*admin/user') ? 'active' : '' }}">Manage
                                                        User</a>
                                                </li>
                                                <li><a href="{{ route('admin.admin.index') }}"
                                                        class="{{ Request::is('*admin/admin') ? 'active' : '' }}">Manage
                                                        Admin</a></li>
                                                <li><a href="{{ route('admin.mail.index') }}"
                                                        class="{{ Request::is('*admin/mail') ? 'active' : '' }}">Manage
                                                        Mail</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
                    @endif
                @endauth
            </ul>
        </nav>

        <div class="mobile-menu-bottom">

            @guest
                <div class="rbt-btn-wrapper mb--20">
                    <a class="rbt-btn btn-border-gradient radius-round btn-sm hover-transform-none w-100 justify-content-center text-center"
                        href="{{ route('login') }}">
                        <span>Login</span>
                    </a>
                </div>
            @endguest

            @auth
                <div class="rbt-btn-wrapper mb--20">
                    <form method="POST" action="{{ route('logout') }}" class="w-100">
                        @csrf
                        <button type="submit"
                            class="rbt-btn btn-border-gradient radius-round btn-sm hover-transform-none w-100 justify-content-center text-center">
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            @endauth

            <div class="social-share-wrapper">
                <span class="rbt-short-title d-block">Find With Us</span>
                <ul class="social-icon social-default transparent-with-border justify-content-start mt--20">
                    <li><a href="tel:+62 896-6402-1388" target="_blank">
                            <i class="feather-phone"></i>
                        </a>
                    </li>
                    <li><a href="mailto:digitaldream320@gmail.com" target="_blank">
                            <i class="feather-mail"></i>
                        </a>
                    </li>
                    <li><a href="https://www.instagram.com/digitalndream" target="_blank">
                            <i class="feather-instagram"></i>
                        </a>
                    </li>
                    <li><a href="https://linkedin.com/company/digitalndream" target="_blank">
                            <i class="feather-linkedin"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
