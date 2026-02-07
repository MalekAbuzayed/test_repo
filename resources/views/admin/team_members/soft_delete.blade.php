@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Deleted Team Members</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.team_members-index') }}">Team Members</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Deleted Members</li>
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
                                <h4 class="card-title mb-0">Deleted Members List</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('super_admin.team_members-index') }}" class="btn btn-primary">
                                    <i data-feather="arrow-left" class="fill-white feather-sm"></i> Back to Active Members
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
                                            <th>Deleted At</th>
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
                                                             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                                    @else
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name_en) }}&size=50&background=c52c26&color=fff&bold=true"
                                                             alt="{{ $member->name_en }}"
                                                             style="border-radius: 50%;">
                                                    @endif
                                                </td>
                                                <td>{{ $member->name_ar }}</td>
                                                <td>{{ $member->name_en }}</td>
                                                <td>{{ app()->getLocale() == 'ar' ? $member->position_ar : $member->position_en }}</td>
                                                <td>{{ $member->deleted_at->format('Y-m-d H:i') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('super_admin.team_members-softDeleteRestore', $member->id) }}"
                                                           class="btn btn-success btn-sm"
                                                           onclick="return confirm('Are you sure you want to restore this member?')">
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
                                No deleted team members found.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
