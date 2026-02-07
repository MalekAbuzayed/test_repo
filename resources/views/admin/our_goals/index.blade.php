@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Our Goals</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Goals</li>
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
                <a href="{{ route('super_admin.our_goals-create') }}" class="btn btn-primary">
                    <i data-feather="plus" class="fill-white feather-sm"></i> Add New Goal
                </a>
                <a href="{{ route('super_admin.our_goals-showSoftDelete') }}" class="btn btn-warning">
                    <i data-feather="trash-2" class="fill-white feather-sm"></i> Deleted Goals
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="border-bottom title-part-padding">
                        <h4 class="card-title mb-0">Our Goals List</h4>
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

                        @if($ourGoals->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Icon</th>
                                            <th>Title (AR)</th>
                                            <th>Title (EN)</th>
                                            <th>Order</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ourGoals as $index => $goal)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <i class="bi bi-{{ $goal->icon }} fs-4"></i>
                                                    <br>
                                                    <small>bi-{{ $goal->icon }}</small>
                                                </td>
                                                <td>{{ $goal->title_ar }}</td>
                                                <td>{{ $goal->title_en }}</td>
                                                <td>{{ $goal->order }}</td>
                                                <td>
                                                    @if($goal->is_active == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('super_admin.our_goals-show', $goal->id) }}" class="btn btn-info btn-sm">
                                                            <i data-feather="eye" class="fill-white feather-sm"></i>
                                                        </a>
                                                        <a href="{{ route('super_admin.our_goals-edit', $goal->id) }}" class="btn btn-primary btn-sm">
                                                            <i data-feather="edit" class="fill-white feather-sm"></i>
                                                        </a>
                                                        <a href="{{ route('super_admin.our_goals-softDelete', $goal->id) }}"
                                                           class="btn btn-danger btn-sm"
                                                           onclick="return confirm('Are you sure you want to delete this goal?')">
                                                            <i data-feather="trash" class="fill-white feather-sm"></i>
                                                        </a>
                                                        <a href="{{ route('super_admin.our_goals-activeInactiveSingle', $goal->id) }}" class="btn btn-warning btn-sm">
                                                            @if($goal->is_active == 1)
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
                                No goals found. <a href="{{ route('super_admin.our_goals-create') }}">Create the first goal</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
