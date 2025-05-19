@extends('layouts.main')

@section('title', 'Contact')

@section('content')
    <main>
        <div class="rbt-conatct-area bg-gradient-11 rbt-section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center mb--60">
                            <h2 class="title">@yield('title')</h2>
                        </div>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-12 col-md-6 col-lg-4 sal-animate" data-sal="slide-up" data-sal-delay="150"
                        data-sal-duration="800">
                        <div class="rbt-address">
                            <div class="icon">
                                <i class="feather-headphones"></i>
                            </div>
                            <div class="inner">
                                <h4 class="title">Contact Phone Number</h4>
                                <p><a href="tel:+{{ $contact->phone_number }}">{{ $contact->phone_number }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 sal-animate" data-sal="slide-up" data-sal-delay="200"
                        data-sal-duration="800">
                        <div class="rbt-address">
                            <div class="icon">
                                <i class="feather-mail"></i>
                            </div>
                            <div class="inner">
                                <h4 class="title">Our Email Address</h4>
                                <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 sal-animate" data-sal="slide-up" data-sal-delay="250"
                        data-sal-duration="800">
                        <div class="rbt-address">
                            <div class="icon">
                                <i class="feather-instagram"></i>
                            </div>
                            <div class="inner">
                                <h4 class="title">Our Social Media</h4>
                                <p><a href="{{ $contact->social_media }}">{{ $contact->social_media }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rbt-contact-address mb--60">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="thumbnail">
                            <img class="w-100 radius-6" src="{{ asset('assets/images/bg/contact.png') }}" alt="ClassXpert">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div
                            class="rbt-contact-form contact-form-style-1 max-width-auto h-100 d-flex flex-column justify-content-center">
                            <h3 class="title text-start">Ask Something</h3>
                            <p class="text-start">We're here to provide guidance and help you choose the ideal program to
                                achieve your goals.</p>

                            <form id="contact-form" method="POST" action="{{ route('app.mail.store') }}">
                                @csrf
                                <div class="form-group">
                                    <input name="contact-name" id="contact-name" type="text" required>
                                    <label>Name</label>
                                    <span class="focus-border"></span>
                                </div>
                                <div class="form-group">
                                    <input name="contact-phone" type="email" required>
                                    <label>Email</label>
                                    <span class="focus-border"></span>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="subject" name="subject" required>
                                    <label>Your Subject</label>
                                    <span class="focus-border"></span>
                                </div>
                                <div class="form-group">
                                    <textarea name="contact-message" id="contact-message" required></textarea>
                                    <label>Message</label>
                                    <span class="focus-border"></span>
                                </div>
                                <div class="form-submit-group">
                                    <button name="submit" type="submit" id="submit"
                                        class="rbt-btn btn-md btn-gradient hover-icon-reverse w-100">
                                        <span class="icon-reverse-wrapper">
                                            <span class="btn-text">Send</span>
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
