@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<main>
    <div class="rbt-elements-area d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row gy-5 row--30 justify-content-center">
                <div class="col-lg-6">
                    <div
                        class="rbt-contact-form contact-form-style-1 max-width-auto radius-round-6 d-flex flex-column justify-content-center">
                        <h3 class="title text-center">@yield('title')</h3>
                        <p class="text-center mb-10">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="text-primary-grad">Sign up</a>
                        </p>
                        <form method="POST" action="{{ route('login') }}"
                            class="max-width-auto d-flex flex-column justify-content-center gap-15">
                            @csrf

                            <div class="form-group mb-10">
                                <input id="email" name="email" type="email" :value="old('email')" required autofocus
                                    placeholder=" " />
                                <label>Email</label>
                                <span class="focus-border"></span>
                            </div>

                            <div class="form-group mb-10">
                                <input id="password" name="password" type="password" required placeholder=" " />
                                <label>Password</label>
                                <span class="focus-border"></span>
                            </div>

                            <div class="row mb--30">
                                <div class="col-lg-6">
                                    <div class="rbt-checkbox">
                                        <input type="checkbox" id="remember_me" name="remember">
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-submit-group mb-3">
                                <button type="submit" class="rbt-btn btn-md btn-gradient w-100">
                                    <span class="icon-reverse-wrapper">
                                        <span class="btn-text">Log In</span>
                                    </span>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection