@extends('layouts.main')

@section('title', 'Mail')

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

                                    <div class="rbt-dashboard-table table-responsive mobile-table-750 mt--30">
                                        <table class="rbt-table table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Message</th>
                                                    <th></th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($mails as $mail_data)
                                                    <tr>
                                                        <th>
                                                            <span class="h6 mb--5">{{ $mail_data->name }}</span>
                                                            <p class="b3">Email: <a
                                                                    href="#">{{ $mail_data->email }}</a></p>
                                                        </th>
                                                        <td>
                                                            <span class="h6 mb--5">{{ $mail_data->subject }}</span>
                                                            <p class="b3">{{ $mail_data->message }}</p>
                                                        </td>
                                                        <td>
                                                            <p class="b3 mb--5">
                                                                {{ $mail_data->created_at->format('d F Y') }}</p>
                                                        </td>
                                                        <td>
                                                            <div class="rbt-button-group justify-content-end">
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#contentModal-{{ $mail_data->id }}"
                                                                    type="button"
                                                                    class="rbt-btn btn-xs bg-success radius-round"
                                                                    title="Detail">
                                                                    <i class="feather-eye pl--0"></i>
                                                                </a>
                                                                <a data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal-{{ $mail_data->id }}"
                                                                    type="button"
                                                                    class="rbt-btn btn-xs bg-danger radius-round"
                                                                    title="Delete">
                                                                    <i class="feather-trash-2 pl--0"></i>
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

        @foreach ($mails as $mail_data)
            @include('admin.mail.content', ['mail_data' => $mail_data])
            @include('admin.mail.delete', ['mail_data' => $mail_data])
        @endforeach

    </main>

@endsection
