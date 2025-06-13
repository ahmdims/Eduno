@extends('layouts.main')

@section('title', 'User')

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

                                    <div class="rbt-callto-action rbt-cta-default style-2">
                                        <div class="content">
                                            <div class="section-title">
                                                <div class="row gy-5 align-items-center">
                                                    <div class="col-lg-8 d-flex align-items-center">
                                                        <div class="section-title">
                                                            <div class="call-to-btn text-start position-relative">
                                                                <a class="rbt-btn btn-sm" data-bs-toggle="modal"
                                                                    data-bs-target="#createModal">
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
                                                    <th>Email</th>
                                                    <th>Username</th>
                                                    <th>Name</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user_data)
                                                    @if ($user_data->utype === 'student')
                                                        <tr>
                                                            <th>
                                                                <span class="h6 mb--5">{{ $user_data->email }}</span>
                                                            </th>
                                                            <td>
                                                                <span class="h6 mb--5">{{ $user_data->username }}</span>
                                                            </td>
                                                            <td>
                                                                <span class="h6 mb--5">{{ $user_data->name }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="rbt-button-group justify-content-end">
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#updateModal-{{ $user_data->id }}"
                                                                        type="button"
                                                                        class="rbt-btn-link left-icon text-primary">
                                                                        <i class="feather-edit"></i> Edit
                                                                    </a>

                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#deleteModal-{{ $user_data->id }}"
                                                                        type="button"
                                                                        class="rbt-btn-link left-icon text-danger">
                                                                        <i class="feather-trash-2"></i> Delete
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
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

        @include('admin.student.create')

        @foreach ($users as $user_data)
            @include('admin.student.update', ['user_data' => $user_data])
            @include('admin.student.delete', ['user_data' => $user_data])
        @endforeach

    </main>
@endsection
