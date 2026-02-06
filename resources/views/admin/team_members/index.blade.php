@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Team Members</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Team Members</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================== --}}
    {{-- ==================== Page Body Section =================== --}}
    {{-- ========================================================== --}}
    <div class="container-fluid">
        {{-- Create Button --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="{{ route('super_admin.team_members-create') }}" class="btn btn-primary">
                    <i data-feather="plus" class="fill-white feather-sm"></i> Add New Member
                </a>
                <a href="{{ route('super_admin.team_members-showSoftDelete') }}" class="btn btn-warning">
                    <i data-feather="trash-2" class="fill-white feather-sm"></i> Deleted Members
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-bottom title-part-padding">
                        <h4 class="card-title mb-0">Team Members List</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(session('danger'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('danger') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($teamMembers->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Name (AR)</th>
                                            <th>Name (EN)</th>
                                            <th>Position</th>
                                            <th>Order</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teamMembers as $index => $member)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if($member->image)
                                                        <img src="{{ asset('storage/' . $member->image) }}"
                                                             alt="{{ $member->name_en }}"
                                                             style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name_en) }}&size=60&background=c52c26&color=fff&bold=true"
                                                             alt="{{ $member->name_en }}"
                                                             style="border-radius: 50%;">
                                                    @endif
                                                </td>
                                                <td>{{ $member->name_ar }}</td>
                                                <td>{{ $member->name_en }}</td>
                                                <td>{{ app()->getLocale() == 'ar' ? $member->position_ar : $member->position_en }}</td>
                                                <td>{{ $member->order }}</td>
                                                <td>
                                                    @if($member->is_active == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('super_admin.team_members-show', $member->id) }}" class="btn btn-info btn-sm">
                                                            <i data-feather="eye" class="fill-white feather-sm"></i>
                                                        </a>
                                                        <a href="{{ route('super_admin.team_members-edit', $member->id) }}" class="btn btn-primary btn-sm">
                                                            <i data-feather="edit" class="fill-white feather-sm"></i>
                                                        </a>
                                                        <a href="{{ route('super_admin.team_members-softDelete', $member->id) }}"
                                                           class="btn btn-danger btn-sm"
                                                           onclick="return confirm('Are you sure you want to delete this member?')">
                                                            <i data-feather="trash" class="fill-white feather-sm"></i>
                                                        </a>
                                                        <a href="{{ route('super_admin.team_members-activeInactiveSingle', $member->id) }}" class="btn btn-warning btn-sm">
                                                            @if($member->is_active == 1)
                                                                <i data-feather="pause" class="fill-white feather-sm"></i>
                                                            @else
                                                                <i data-feather="play" class="fill-white feather-sm"></i>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                No team members found. <a href="{{ route('super_admin.team_members-create') }}">Add the first member</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
