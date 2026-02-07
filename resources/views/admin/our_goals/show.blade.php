@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Goal Details</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.our_goals-index') }}">Our Goals</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Goal Details</li>
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
                                <h4 class="card-title mb-0">Goal Details</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('super_admin.our_goals-edit', $ourGoal->id) }}" class="btn btn-primary">
                                        <i data-feather="edit" class="fill-white feather-sm"></i> Edit
                                    </a>
                                    <a href="{{ route('super_admin.our_goals-index') }}" class="btn btn-secondary">
                                        <i data-feather="arrow-left" class="fill-white feather-sm"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Basic Information Card --}}
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Basic Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Icon:</div>
                                            <div class="col-md-8">
                                                <i class="bi bi-{{ $ourGoal->icon }} fs-3"></i>
                                                <span class="ms-2">bi-{{ $ourGoal->icon }}</span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Order:</div>
                                            <div class="col-md-8">{{ $ourGoal->order }}</div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Status:</div>
                                            <div class="col-md-8">
                                                @if($ourGoal->is_active == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4 fw-bold">Created At:</div>
                                            <div class="col-md-8">{{ $ourGoal->created_at->format('Y-m-d H:i') }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 fw-bold">Updated At:</div>
                                            <div class="col-md-8">{{ $ourGoal->updated_at->format('Y-m-d H:i') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Preview Card --}}
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Preview</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card goal-card border-0 shadow-sm h-100">
                                            <div class="card-body text-center p-4">
                                                <div class="icon-box mb-3">
                                                    <i class="bi bi-{{ $ourGoal->icon }}"></i>
                                                </div>
                                                <h5 class="card-title text-primary-custom fw-bold mb-3">
                                                    {{ app()->getLocale() == 'ar' ? $ourGoal->title_ar : $ourGoal->title_en }}
                                                </h5>
                                                <p class="card-text">
                                                    {{ app()->getLocale() == 'ar' ? $ourGoal->description_ar : $ourGoal->description_en }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Arabic Content Card --}}
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Arabic Content</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="fw-bold">Title (AR):</label>
                                            <p class="form-control-static">{{ $ourGoal->title_ar }}</p>
                                        </div>
                                        <div>
                                            <label class="fw-bold">Description (AR):</label>
                                            <div class="border p-3 rounded bg-light">
                                                {!! $ourGoal->description_ar !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- English Content Card --}}
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">English Content</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="fw-bold">Title (EN):</label>
                                            <p class="form-control-static">{{ $ourGoal->title_en }}</p>
                                        </div>
                                        <div>
                                            <label class="fw-bold">Description (EN):</label>
                                            <div class="border p-3 rounded bg-light">
                                                {!! $ourGoal->description_en !!}
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
                                            <a href="{{ route('super_admin.our_goals-edit', $ourGoal->id) }}" class="btn btn-primary">
                                                <i data-feather="edit" class="fill-white feather-sm"></i> Edit Goal
                                            </a>

                                            @if($ourGoal->is_active == 1)
                                                <a href="{{ route('super_admin.our_goals-activeInactiveSingle', $ourGoal->id) }}"
                                                   class="btn btn-warning"
                                                   onclick="return confirm('Are you sure you want to deactivate this goal?')">
                                                    <i data-feather="pause" class="fill-white feather-sm"></i> Deactivate
                                                </a>
                                            @else
                                                <a href="{{ route('super_admin.our_goals-activeInactiveSingle', $ourGoal->id) }}"
                                                   class="btn btn-success"
                                                   onclick="return confirm('Are you sure you want to activate this goal?')">
                                                    <i data-feather="play" class="fill-white feather-sm"></i> Activate
                                                </a>
                                            @endif

                                            <a href="{{ route('super_admin.our_goals-softDelete', $ourGoal->id) }}"
                                               class="btn btn-danger"
                                               onclick="return confirm('Are you sure you want to delete this goal? This action can be undone.')">
                                                <i data-feather="trash" class="fill-white feather-sm"></i> Delete
                                            </a>

                                            <a href="{{ route('super_admin.our_goals-index') }}" class="btn btn-secondary">
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
    .icon-box {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #c52c26 0%, #e74c3c 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }

    .icon-box i {
        font-size: 30px;
        color: white;
    }

    .text-primary-custom {
        color: #c52c26 !important;
    }

    .goal-card {
        border-radius: 15px;
        transition: transform 0.3s ease;
    }

    .goal-card:hover {
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
