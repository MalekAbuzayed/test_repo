@extends('admin.layouts.app')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Products</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('super_admin.products-index') }}">Products</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">View Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-edit', $product->id) }}" class="btn btn-warning">
                            <i data-feather="edit" class="fill-white feather-sm"></i> Edit
                        </a>
                    </div>
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-showSoftDelete') }}" class="btn btn-danger">
                            <i data-feather="archive" class="fill-white feather-sm"></i> View Archive
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Primary Image</h5>

                        @php
                            $primaryImage = $product->files->firstWhere('type', 'image');
                        @endphp

                        @if ($primaryImage)
                            <img src="{{ asset('storage/' . ltrim($primaryImage->path, '/')) }}" alt="{{ $product->title }}"
                                class="img-fluid rounded shadow-sm">
                        @else
                            <div class="text-muted">No image uploaded for this product.</div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Product Information</h4>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>ID:</strong></label>
                                <div class="form-control bg-light">{{ $product->id }}</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Status:</strong></label>
                                <div class="form-control bg-light">
                                    @if ($product->status === 'Active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label"><strong>Title:</strong></label>
                                <div class="form-control bg-light">{{ $product->title }}</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label"><strong>Category:</strong></label>
                                <div class="form-control bg-light">{{ $product->category?->name ?? '----' }}</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label"><strong>Subcategory:</strong></label>
                                <div class="form-control bg-light">{{ $product->subcategory?->name ?? '----' }}</div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label"><strong>Grandchild:</strong></label>
                                <div class="form-control bg-light">{{ $product->grandchild?->name ?? '----' }}</div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label"><strong>Description:</strong></label>
                                <div class="form-control bg-light" style="min-height: 150px;">
                                    {!! nl2br(e($product->description ?? '')) !!}
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Created At:</strong></label>
                                <div class="form-control bg-light">
                                    {{ $product->created_at?->format('Y-m-d h:i A') ?? '----' }}<br>
                                    <small>{{ $product->created_at?->diffForHumans() ?? '' }}</small>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Updated At:</strong></label>
                                <div class="form-control bg-light">
                                    {{ $product->updated_at?->format('Y-m-d h:i A') ?? '----' }}<br>
                                    <small>{{ $product->updated_at?->diffForHumans() ?? '' }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('super_admin.products-index') }}" class="btn btn-secondary">
                                <i data-feather="arrow-left" class="feather-sm fill-white me-2"></i>
                                Back to List
                            </a>

                            <div>
                                <a href="{{ route('super_admin.products-edit', $product->id) }}" class="btn btn-warning me-2">
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
@endsection
