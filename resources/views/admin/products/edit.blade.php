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
                            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Archive --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-showSoftDelete') }}" class="btn btn-danger">
                            <i data-feather="archive" class="fill-white feather-sm"></i>View Archive
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
                        <form action="{{ route('super_admin.products-update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Name --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name"
                                            class="form-control border border-info @error('name') border-danger @enderror"
                                            id="tb-name" value="{{ old('name', $product->name) }}"
                                            placeholder="Product Name">
                                        <label for="tb-name">
                                            <i data-feather="package" class="feather-sm text-info fill-white me-2"></i>Product
                                            Name
                                            <strong class="text-danger">
                                                @error('name')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title"
                                            class="form-control border border-info @error('title') border-danger @enderror"
                                            id="tb-title" value="{{ old('title', $product->title) }}"
                                            placeholder="Product Title">
                                        <label for="tb-title">
                                            <i data-feather="type" class="feather-sm text-info fill-white me-2"></i>Product
                                            Title
                                            <strong class="text-danger">
                                                @error('title')
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
                                            <option value="1" @if (old('status', $product->getRawOriginal('status')) == 1) selected @endif>
                                                Active</option>
                                            <option value="2" @if (old('status', $product->getRawOriginal('status')) == 2) selected @endif>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Type --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="type"
                                            class="form-control form-select border border-info @error('type') border-danger @enderror custom_select_style">
                                            <option>--- Select Type ---</option>
                                            <option value="batteries" @if (old('type', $product->getRawOriginal('type')) == 'batteries') selected @endif>
                                                Batteries</option>
                                            <option value="hybrid" @if (old('type', $product->getRawOriginal('type')) == 'hybrid') selected @endif>
                                                Hybrid</option>
                                            <option value="onGrid" @if (old('type', $product->getRawOriginal('type')) == 'onGrid') selected @endif>
                                                OnGrid</option>
                                            <option value="other" @if (old('type', $product->getRawOriginal('type')) == 'other') selected @endif>
                                                Other</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Image --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">
                                            <i data-feather="image" class="feather-sm text-info fill-white me-2"></i>Product
                                            Image :
                                            @if ($product->image && file_exists($product->image))
                                                <br>
                                                <div class="mt-2">
                                                    <img src="{{ asset($product->image) }}" alt="Current Image"
                                                        height="100" width="100" class="img-thumbnail">
                                                    <a href="{{ asset($product->image) }}" target="_blank"
                                                        class="btn btn-sm btn-info ms-2">View Full Image</a>
                                                </div>
                                            @endif
                                            <label style="color: red">Max Size: 2MB | Formats: jpeg, png, jpg, gif, svg,
                                                webp</label>
                                            <strong class="text-danger">
                                                @error('image')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="file" name="image"
                                            class="form-control border border-info @error('image') border-danger @enderror"
                                            id="image" placeholder="Product Image">
                                    </div>
                                </div>

                                {{-- File --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">
                                            <i data-feather="file" class="feather-sm text-info fill-white me-2"></i>Product
                                            File :
                                            @if ($product->file && file_exists($product->file))
                                                <br>
                                                <div class="mt-2">
                                                    <a href="{{ asset($product->file) }}" target="_blank"
                                                        class="btn btn-sm btn-info">
                                                        <i data-feather="download"
                                                            class="feather-sm fill-white me-1"></i>
                                                        Download Current File
                                                    </a>
                                                </div>
                                            @endif
                                            <label style="color: red">Max Size: 5MB | Formats: pdf, doc, docx, xls, xlsx,
                                                zip, rar, txt</label>
                                            <strong class="text-danger">
                                                @error('file')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="file" name="file"
                                            class="form-control border border-info @error('file') border-danger @enderror"
                                            id="file" placeholder="Product File">
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i data-feather="align-left"
                                                class="feather-sm text-info fill-white me-2"></i>Description :
                                            <strong class="text-danger">
                                                @error('description')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="description"
                                            class="form-control border border-info @error('description') border-danger @enderror"
                                            id="description" placeholder="Product Description" rows="6">{{ old('description', $product->description) }}</textarea>
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
                                                    Update Product
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
    <script>
        // Initialize textarea with Summernote
        $(document).ready(function() {
            $('#description').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ],
                placeholder: 'Enter product description here...'
            });
        });
    </script>
@endsection