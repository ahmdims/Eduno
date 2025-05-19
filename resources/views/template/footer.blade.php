<footer class="rbt-footer footer-style-1 bg-color-dark overflow-hidden">

    <div class="rbt-separator-mid">
        <div class="container">
            <hr class="rbt-separator m-0">
        </div>
    </div>

    <div class="pt--30 pb--30">
        <div class="container">
            <div class="row g-5 justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="footer-widget">
                        <div class="logo logo-dark">
                            <a href="/">
                                <img src="{{ asset('assets/images/logo/logo-light.svg') }}" alt="ClassXpert">
                            </a>
                        </div>
                        <div class="logo d-none logo-light">
                            <a href="/">
                                <img src="{{ asset('assets/images/logo/logo-light.svg') }}" alt="ClassXpert">
                            </a>
                        </div>

                        <p class="description mt--20">
                            Innovative e-learning platform designed to provide flexible courses for learners of all
                            levels. Allowing them to acquire new skills and advance their careers from anywhere,
                            anytime.
                        </p>

                        <span class="ft-title">Discover who we are and what we stand for</span>

                        <ul class="social-icon social-default justify-content-center mt--20">
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
    </div>

    <div class="rbt-separator-mid">
        <div class="container">
            <hr class="rbt-separator m-0">
        </div>
    </div>

    <div class="copyright-area copyright-style-1 ptb--20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-12">
                    <p class="rbt-link-hover text-center text-lg-start">Copyright ©
                        <script class="text-white">
                            document.write(new Date().getFullYear())
                        </script> ClassXpert. Build by <a href="https://www.instagram.com/digitalndream"
                            target="_blank">DigitalDream</a>
                    </p>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-12">
                    <ul
                        class="copyright-link rbt-link-hover justify-content-center justify-content-lg-end mt_sm--10 mt_md--10">
                        <li><a href="{{ route('app.faq.index') }}">Faq</a></li>

                        @guest
                            <li><a href="{{ route('login') }}">Login & Register</a></li>
                        @endguest

                        @auth
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <a hhref="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                </form>
                            </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

</main>
