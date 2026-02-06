@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Our Vision</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Vision</li>
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
        <div class="card">
            <div class="border-bottom title-part-padding">
                <h4 class="card-title mb-0">Our Vision Details</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- Icon Preview --}}
                    <div class="col-md-12 mb-4">
                        <label class="text-dark font-weight-medium">Icon:</label>
                        <p>
                            <i class="bi bi-{{ $ourVision->icon ?? 'lightbulb' }} display-4"></i>
                            <span class="ms-2">bi-{{ $ourVision->icon ?? 'lightbulb' }}</span>
                        </p>
                    </div>

                    {{-- Title AR & EN --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="card-title">
                                <label>Title AR:</label>
                                {{ $ourVision->title_ar ?? '----' }}
                            </h5>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title">
                                <label>Title EN:</label>
                                {{ $ourVision->title_en ?? '----' }}
                            </h5>
                        </div>
                    </div>

                    {{-- Bold Description AR --}}
                    <div class="col-md-12 mb-3">
                        <label>Bold Description AR:</label>
                        <p class="card-text font-weight-bold">
                            {{ $ourVision->bold_description_ar ?? '----' }}
                        </p>
                    </div>

                    {{-- Bold Description EN --}}
                    <div class="col-md-12 mb-3">
                        <label>Bold Description EN:</label>
                        <p class="card-text font-weight-bold">
                            {{ $ourVision->bold_description_en ?? '----' }}
                        </p>
                    </div>

                    {{-- Normal Description AR --}}
                    <div class="col-md-12 mb-3">
                        <label>Normal Description AR:</label>
                        <p class="card-text">
                            {{ $ourVision->normal_description_ar ?? '----' }}
                        </p>
                    </div>

                    {{-- Normal Description EN --}}
                    <div class="col-md-12 mb-3">
                        <label>Normal Description EN:</label>
                        <p class="card-text">
                            {{ $ourVision->normal_description_en ?? '----' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Edit Button --}}
            <div class="border-bottom title-part-padding">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="{{ route('super_admin.our_vision-edit', $ourVision->id) }}" class="btn btn-dark">
                            <i data-feather="edit" class="fill-white feather-sm"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
