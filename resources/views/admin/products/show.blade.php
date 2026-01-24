@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Products</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('super_admin.products-index') }}">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Edit Button --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-edit', $product->id) }}" class="btn btn-warning">
                            <i data-feather="edit" class="fill-white feather-sm"></i> Edit
                        </a>
                    </div>
                    {{-- Archive --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-showSoftDelete') }}" class="btn btn-danger">
                            <i data-feather="archive" class="fill-white feather-sm"></i> View Archive
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
                {{-- Product Details Section --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{-- Product Image --}}
                            <div class="col-md-4">
                                <div class="text-center mb-4">
                                    @if ($product->image && file_exists($product->image))
                                        <img src="{{ asset($product->image) }}" alt="Product Image"
                                            class="img-fluid rounded shadow" style="max-height: 300px;">
                                    @else
                                        <img src="{{ asset('style_files/shared/images_default/default.jpg') }}"
                                            alt="Default Image" class="img-fluid rounded shadow"
                                            style="max-height: 300px;">
                                    @endif
                                </div>

                                {{-- File Download --}}
                                @if ($product->file && file_exists($product->file))
                                    <div class="text-center">
                                        <a href="{{ asset($product->file) }}" target="_blank"
                                            class="btn btn-info btn-lg w-100">
                                            <i data-feather="download" class="feather-sm fill-white me-2"></i>
                                            Download Product File
                                        </a>
                                    </div>
                                @endif
                            </div>

                            {{-- Product Information --}}
                            <div class="col-md-8">
                                <h4 class="card-title mb-4">Product Information</h4>

                                <div class="row">
                                    {{-- ID --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>ID:</strong></label>
                                        <div class="form-control bg-light">{{ $product->id }}</div>
                                    </div>

                                    {{-- Name --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Product Name:</strong></label>
                                        <div class="form-control bg-light">{{ $product->name }}</div>
                                    </div>

                                    {{-- Title --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label"><strong>Product Title:</strong></label>
                                        <div class="form-control bg-light">{{ $product->title }}</div>
                                    </div>

                                    {{-- Type --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Product Type:</strong></label>
                                        <div class="form-control bg-light">{{ $product->type }}</div>
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Status:</strong></label>
                                        <div class="form-control bg-light">
                                            @if ($product->status == 'Active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label"><strong>Description:</strong></label>
                                        <div class="form-control bg-light" style="min-height: 150px;">
                                            {!! nl2br(e($product->description)) !!}
                                        </div>
                                    </div>

                                    {{-- Created At --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label"><strong>Created At:</strong></label>
                                        <div class="form-control bg-light">
                                            {{ $product->created_at->format('Y-m-d h:i A') }}<br>
                                            <small>({{ $product->created_at->diffForHumans() }})</small>
                                        </div>
                                    </div>

                                    {{-- Updated At --}}
                                    @if ($product->updated_at)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><strong>Last Updated:</strong></label>
                                            <div class="form-control bg-light">
                                                {{ $product->updated_at->format('Y-m-d h:i A') }}<br>
                                                <small>({{ $product->updated_at->diffForHumans() }})</small>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Action Buttons --}}
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <a href="{{ route('super_admin.products-index') }}"
                                                    class="btn btn-secondary">
                                                    <i data-feather="arrow-left" class="feather-sm fill-white me-2"></i>
                                                    Back to List
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{ route('super_admin.products-edit', $product->id) }}"
                                                    class="btn btn-warning me-2">
                                                    <i data-feather="edit" class="feather-sm fill-white me-2"></i>
                                                    Edit
                                                </a>
                                                <a href="{{ route('super_admin.products-softDelete', $product->id) }}"
                                                    class="confirm btn btn-danger">
                                                    <i data-feather="trash-2" class="feather-sm fill-white me-2"></i>
                                                    Delete
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
    </div>
@endsection