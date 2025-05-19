@extends('layouts.main')

@section('title', 'Faq')

@section('content')
    <link href="{{ asset('assets/css/vendor/trix.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/vendor/trix.min.js') }}" defer></script>

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

                                    <div class="rbt-callto-action rbt-cta-default style-2">
                                        <div class="content">

                                            <div class="section-title">
                                                <div class="row gy-5 align-items-center">
                                                    <div class="col-lg-8 d-flex align-items-center">
                                                        <div class="section-title">
                                                            <div class="call-to-btn text-start position-relative">
                                                                <a class="rbt-btn btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#formModal">
                                                                    <span>Create @yield('title')</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="rbt-dashboard-table table-responsive mobile-table-750 mt--30">
                                        <table class="rbt-table table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Question</th>
                                                    <th>Answer</th>
                                                    <th>Created</th>
                                                    <th>Updated</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($faqs as $faq_data)
                                                    <tr>
                                                        <th>
                                                            <span class="h6 mb--5">{{ $faq_data->question }}</span>
                                                        </th>
                                                        <td>
                                                            <span class="h6 mb--5">{!! $faq_data->answer !!}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="h6 mb--5">{{ $faq_data->created_at_formatted }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="h6 mb--5">{{ $faq_data->updated_at_formatted }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="rbt-button-group justify-content-end">
                                                                <a data-bs-toggle="modal" data-bs-target="#formModal"
                                                                    type="button" data-id="{{ $faq_data->id }}"
                                                                    class="btn-edit rbt-btn-link left-icon text-primary">
                                                                    <i class="feather-edit"></i> Edit
                                                                </a>

                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal-{{ $faq_data->id }}"
                                                                    type="button"
                                                                    class="rbt-btn-link left-icon text-danger">
                                                                    <i class="feather-trash-2"></i> Delete
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('admin.faq.create')

        @foreach ($faqs as $faq_data)
            @include('admin.faq.delete', ['faq_data' => $faq_data])
        @endforeach

    </main>

    <script src="{{ asset('assets/js/admin/faq.js') }}"></script>

@endsection
