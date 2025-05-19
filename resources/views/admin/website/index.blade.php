@extends('layouts.main')

@section('title', 'Website')

@section('content')

    <main>
        <div class="rbt-page-banner-wrapper">
            <div class="rbt-banner-image"></div>
        </div>

        <div class="rbt-dashboard-area rbt-section-overlayping-top rbt-section-gapBottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div>
                            <div class="rbt-dashboard-content bg-color-white rbt-shadow-box">
                                <div class="content">

                                    <form action="{{ route('website.update', $contact->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-4">
                                            <div class="rbt-form-group">
                                                <label for="phone_number" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" name="phone_number"
                                                    value="{{ old('phone_number', $contact->phone_number ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="rbt-form-group">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email', $contact->email ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="rbt-form-group">
                                                <label for="social_media" class="form-label">Social Media</label>
                                                <input type="text" class="form-control" name="social_media"
                                                    value="{{ old('social_media', $contact->social_media ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="rbt-form-group">
                                                <label for="video" class="form-label">Video Profile</label>
                                                <input type="text" class="form-control" name="video"
                                                    value="{{ old('video', $contact->video ?? '') }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button class="rbt-btn btn-gradient btn-gradient-3 btn-sm w-100"
                                                type="submit">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>

@endsection
