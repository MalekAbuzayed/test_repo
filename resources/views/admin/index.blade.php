@extends('admin.layouts.app')

@section('content')
    <!-- Dashboard Main Content -->
    <div class="container-fluid px-4">
        <div class="row mb-2">
            <div class="col-md-6">
                <h1 class="mt-4 mb-2">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard Overview & Quick Access</li>
                </ol>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center mt-4">
                <div class="time-display">
                    <div class="btn btn-secondary">
                        {{ $carbonGetNowTime ?? '---' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Row -->
        <div class="stats-container">
            <!-- Products -->
            <div class="stat-card stat-product">
                <div class="stat-info">
                    <a href="{{ route('super_admin.products-index') }}">
                        <h4 style="color: blue">Visit</h4>
                        <p>Products</p>
                    </a>

                </div>
                <div class="stat-icon">
                    <i class="fa-solid fa-basket-shopping"></i>
                </div>
            </div>

            <!-- About-Us -->
            <div class="stat-card stat-about">
                <div class="stat-info">
                    <a href="{{ route('super_admin.about_us-index') }}">
                        <h4 style="color: blue">Visit</h4>
                        <p>About-Us</p>
                    </a>

                </div>
                <div class="stat-icon">
                    <i class="fa fa-info-circle"></i>
                </div>
            </div>

            <!-- Contact-US -->
            <div class="stat-card stat-contact">
                <div class="stat-info">
                    <a href="{{ route('super_admin.contact_us-index') }}">
                        <h4 style="color: blue">Visit</h4>
                        <p>Contact-US</p>
                    </a>

                </div>
                <div class="stat-icon">
                    <i class="fa fa-address-card"></i>
                </div>
            </div>

            <!-- Contact-US Request -->
            <div class="stat-card stat-request">
                <div class="stat-info">
                    <a href="{{ route('super_admin.contact_us_requests-index') }}">
                        <h2>{{ $contactUsRequestsCount ?? 0 }}</h2>
                        <p>Contact-US Request</p>
                    </a>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-envelope"></i>
                </div>
            </div>

            <!-- Privacy & Policy -->
            <div class="stat-card stat-privacy">
                <div class="stat-info">
                    <a href="{{ route('super_admin.privacy_policies-index') }}">
                        <h4 style="color: blue">Visit</h4>
                        <p>Privacy & Policy</p>
                    </a>
                </div>

                <div class="stat-icon">
                    <i class="fa fa-shield-alt"></i>
                </div>
            </div>

            <!-- Terms & Conditions -->
            <div class="stat-card stat-terms">
                <div class="stat-info">
                    <a href="{{ route('super_admin.terms_and_conditions-index') }}">
                        <h4 style="color: blue">Visit</h4>
                        <p>Terms & Conditions</p>
                    </a>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-file-alt"></i>
                </div>
            </div>

            <!-- Users -->
            <div class="stat-card stat-users">
                <div class="stat-info">
                    <a href="{{ route('super_admin.users-index') }}">
                        <h2>{{ $usersCount ?? 0 }}</h2>
                        <p>Users</p>
                    </a>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-user"></i>
                </div>
            </div>

            <!-- Admins -->
            <div class="stat-card stat-admins">
                <div class="stat-info">
                    <a href="{{ route('super_admin.admins-index') }}">
                        <h2>{{ $adminsCount ?? 0 }}</h2>
                        <p>Admins</p>
                    </a>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-user-circle"></i> <!-- Changed to a more basic icon -->
                </div>
            </div>

            <!-- Sliders -->
            <div class="stat-card stat-sliders">
                <div class="stat-info">
                    <a href="{{ route('super_admin.sliders-index') }}">
                        <h2>{{ $slidersCount ?? 0 }}</h2>
                        <p>Sliders</p>
                    </a>
                </div>
                <div class="stat-icon">
                    <i class="fa fa-images"></i>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <script>
        // Any additional JavaScript can go here
        $(document).ready(function() {
            console.log('Dashboard loaded successfully');
        });
    </script>
@endsection

<style>

</style>
