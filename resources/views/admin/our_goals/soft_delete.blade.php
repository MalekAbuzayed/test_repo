@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Deleted Goals</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.our_goals-index') }}">Our Goals</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Deleted Goals</li>
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
                                <h4 class="card-title mb-0">Deleted Goals List</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('super_admin.our_goals-index') }}" class="btn btn-primary">
                                    <i data-feather="arrow-left" class="fill-white feather-sm"></i> Back to Active Goals
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
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
                                            <th>Deleted At</th>
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
                                                <td>{{ $goal->deleted_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('super_admin.our_goals-softDeleteRestore', $goal->id) }}"
                                                           class="btn btn-success btn-sm"
                                                           onclick="return confirm('Are you sure you want to restore this goal?')">
                                                            <i data-feather="refresh-ccw" class="fill-white feather-sm"></i> Restore
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
                                No deleted goals found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
