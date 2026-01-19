@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Admins</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('super_admin.admins-index') }}">Admins</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Admin Info</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Create --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.admins-create') }}" class="btn btn-dark">
                            <i data-feather="plus" class="fill-white feather-sm"></i>Create New
                        </a>
                    </div>

                    {{-- Show --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.admins-show', isset($admin->id) ? $admin->id : -1) }}"
                            class="btn btn-primary">
                            <i data-feather="eye" class="fill-white feather-sm"></i>View
                        </a>
                    </div>

                    {{-- Active / Inactive --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.admins-activeInactiveSingle', isset($admin->id) ? $admin->id : -1) }}"
                            class="btn btn-warning">
                            @if (isset($admin->status) && $admin->status == 'Active')
                                <i data-feather="pause" class="fill-white feather-sm"></i>Set Inactive
                            @elseif(isset($admin->status) && $admin->status == 'Inactive')
                                <i data-feather="play" class="fill-white feather-sm"></i>Set Active
                            @endif
                        </a>
                    </div>

                    {{-- Delete --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.admins-softDelete', isset($admin->id) ? $admin->id : -1) }}"
                            class="confirm btn btn-danger">
                            <i data-feather="trash" class="fill-white feather-sm"></i>Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- ========================================================== --}}
    {{-- ==================== Page Body Section =================== --}}
    {{-- ========================================================== --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{-- Form Section --}}
                <div class="card">
                    <div class="card-body">
                        <form
                            action="{{ route('super_admin.admins-update', isset($admin->id) ? $admin->id : -1) }}"
                            method="POST" enctype="multipart/form-data" id="editForm">
                            @csrf
                            <div class="row">
                                {{--  Name --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name"
                                            class="form-control border border-info @error('name') border-danger @enderror"
                                            id="tb-name"
                                            value="{{ old('name', isset($admin->name) ? $admin->name : null) }}"
                                            placeholder=" Name">
                                        <label for="tb-Name">
                                            <i data-feather="type" class="feather-sm text-info fill-white me-2"></i>
                                            Name
                                            <strong class="text-danger">
                                                @error('name')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="email"
                                            class="form-control border border-info @error('email') border-danger @enderror"
                                            id="tb-name"
                                            value="{{ old('email', isset($admin->email) ? $admin->email : null) }}"
                                            placeholder="Email">
                                        <label for="tb-Name">
                                            <i data-feather="type" class="feather-sm text-info fill-white me-2"></i>Email
                                            <strong class="text-danger">
                                                @error('email')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="status"
                                            class="form-control form-select border border-info @error('status') border-danger @enderror custom_select_style">
                                            <option>--- Choose Status ---</option>
                                            <option value="1" @if ($admin->status == 'Active') selected @endif
                                                @if ($admin->status == null) selected @endif>Active
                                            </option>
                                            <option value="2" @if ($admin->status == 'Inactive') selected @endif>
                                                Inactive </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password"
                                            class="form-control border border-info @error('password') border-danger @enderror"
                                            id="tb-name" value="{{ old('password') }}" placeholder="Password">
                                        <label for="tb-name">
                                            <i data-feather="type"
                                                class="feather-sm text-info fill-white me-2"></i>Password
                                            <strong class="text-danger">
                                                @error('password')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                    </div>
                                </div>

                                {{-- password_confirmation --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password_confirmation"
                                            class="form-control border border-info @error('password_confirmation') border-danger @enderror"
                                            id="tb-name" value="{{ old('password_confirmation') }}"
                                            placeholder="Confirm Password">
                                        <label for="tb-name">
                                            <i data-feather="type"
                                                class="feather-sm text-info fill-white me-2"></i>Confirm Password
                                            <strong class="text-danger">
                                                @error('password_confirmation')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                    </div>
                                </div>


                                {{-- Button --}}
                                <div class="col-12">
                                    <div class="d-md-flex align-items-center mt-3">
                                        <div class="ms-auto mt-3 mt-md-0">
                                            <button type="submit"
                                                class="btn btn-success font-weight-medium rounded-pill px-4">
                                                <div class="d-flex align-items-center">
                                                    <i data-feather="save" class="feather-sm fill-white me-2"></i>
                                                    Save Updates
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    {{-- select 2 script --}}
    <script>
        $(document).ready(function() {
            $('select[name="country_id"]').select2();
            $('select[name="city_id"]').select2();
        });
    </script>
@endsection
