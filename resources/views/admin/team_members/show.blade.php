@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Team Member Details</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.team_members-index') }}">Team Members</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Member Details</li>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-bottom title-part-padding">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title mb-0">Member Details</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('super_admin.team_members-edit', $teamMember->id) }}" class="btn btn-primary">
                                        <i data-feather="edit" class="fill-white feather-sm"></i> Edit
                                    </a>
                                    <a href="{{ route('super_admin.team_members-index') }}" class="btn btn-secondary">
                                        <i data-feather="arrow-left" class="fill-white feather-sm"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Image & Basic Info --}}
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Profile</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        @if($teamMember->image)
                                            <img src="{{ asset('storage/' . $teamMember->image) }}"
                                                 alt="{{ $teamMember->name_en }}"
                                                 class="img-fluid rounded-circle mb-3"
                                                 style="width: 200px; height: 200px; object-fit: cover;">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($teamMember->name_en) }}&size=200&background=c52c26&color=fff&bold=true"
                                                 alt="{{ $teamMember->name_en }}"
                                                 class="img-fluid rounded-circle mb-3">
                                        @endif

                                        <h4 class="card-title">{{ $teamMember->name_en }}</h4>
                                        <h6 class="text-muted">{{ $teamMember->position_en }}</h6>

                                        <div class="mt-3">
                                            @if($teamMember->is_active == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Member Information --}}
                            <div class="col-md-8">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Member Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Order:</div>
                                            <div class="col-md-8">{{ $teamMember->order }}</div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Created At:</div>
                                            <div class="col-md-8">{{ $teamMember->created_at->format('Y-m-d H:i') }}</div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Updated At:</div>
                                            <div class="col-md-8">{{ $teamMember->updated_at->format('Y-m-d H:i') }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 fw-bold">Status:</div>
                                            <div class="col-md-8">
                                                @if($teamMember->is_active == 1)
                                                    <span class="badge bg-success">Active</span>
                                                    <small class="text-muted ms-2">(Visible on website)</small>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                    <small class="text-muted ms-2">(Hidden from website)</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Arabic Content --}}
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Arabic Content</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="fw-bold">Name (AR):</label>
                                            <p class="form-control-static">{{ $teamMember->name_ar }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <label class="fw-bold">Position (AR):</label>
                                            <p class="form-control-static">{{ $teamMember->position_ar }}</p>
                                        </div>

                                        <div>
                                            <label class="fw-bold">Description (AR):</label>
                                            <div class="border p-3 rounded bg-light">
                                                {!! $teamMember->description_ar !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- English Content --}}
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">English Content</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="fw-bold">Name (EN):</label>
                                            <p class="form-control-static">{{ $teamMember->name_en }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <label class="fw-bold">Position (EN):</label>
                                            <p class="form-control-static">{{ $teamMember->position_en }}</p>
                                        </div>

                                        <div>
                                            <label class="fw-bold">Description (EN):</label>
                                            <div class="border p-3 rounded bg-light">
                                                {!! $teamMember->description_en !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Preview Card --}}
                            <div class="col-md-12">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Website Preview</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="card team-card border-0 shadow h-100">
                                                    <div class="card-body text-center p-4">
                                                        @if($teamMember->image)
                                                            <img src="{{ asset('storage/' . $teamMember->image) }}"
                                                                 alt="{{ $teamMember->name_en }}"
                                                                 class="team-img">
                                                        @else
                                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($teamMember->name_en) }}&size=150&background=c52c26&color=fff&bold=true"
                                                                 alt="{{ $teamMember->name_en }}"
                                                                 class="team-img">
                                                        @endif

                                                        <h5 class="card-title fw-bold text-primary-custom mb-1">
                                                            {{ app()->getLocale() == 'ar' ? $teamMember->name_ar : $teamMember->name_en }}
                                                        </h5>

                                                        <p class="text-muted mb-3 fw-semibold">
                                                            {{ app()->getLocale() == 'ar' ? $teamMember->position_ar : $teamMember->position_en }}
                                                        </p>

                                                        <p class="card-text small">
                                                            {{ app()->getLocale() == 'ar' ? strip_tags($teamMember->description_ar) : strip_tags($teamMember->description_en) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Actions Card --}}
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Actions</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('super_admin.team_members-edit', $teamMember->id) }}" class="btn btn-primary">
                                                <i data-feather="edit" class="fill-white feather-sm"></i> Edit Member
                                            </a>

                                            @if($teamMember->is_active == 1)
                                                <a href="{{ route('super_admin.team_members-activeInactiveSingle', $teamMember->id) }}"
                                                   class="btn btn-warning"
                                                   onclick="return confirm('Are you sure you want to deactivate this member?')">
                                                    <i data-feather="pause" class="fill-white feather-sm"></i> Deactivate
                                                </a>
                                            @else
                                                <a href="{{ route('super_admin.team_members-activeInactiveSingle', $teamMember->id) }}"
                                                   class="btn btn-success"
                                                   onclick="return confirm('Are you sure you want to activate this member?')">
                                                    <i data-feather="play" class="fill-white feather-sm"></i> Activate
                                                </a>
                                            @endif

                                            <a href="{{ route('super_admin.team_members-softDelete', $teamMember->id) }}"
                                               class="btn btn-danger"
                                               onclick="return confirm('Are you sure you want to delete this member? This action can be undone.')">
                                                <i data-feather="trash" class="fill-white feather-sm"></i> Delete
                                            </a>

                                            <a href="{{ route('super_admin.team_members-index') }}" class="btn btn-secondary">
                                                <i data-feather="arrow-left" class="fill-white feather-sm"></i> Back to List
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    .team-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
        border: 3px solid #c52c26;
    }

    .text-primary-custom {
        color: #c52c26 !important;
    }

    .team-card {
        border-radius: 15px;
        transition: transform 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-5px);
    }

    .form-control-static {
        padding: 0.375rem 0.75rem;
        background-color: #f8f9fa;
        border-radius: 0.375rem;
        min-height: 38px;
        display: flex;
        align-items: center;
    }
</style>
@endsection
