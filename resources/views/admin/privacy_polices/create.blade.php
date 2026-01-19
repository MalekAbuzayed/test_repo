@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Privacy Policy</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('super_admin.privacy_policies-index') }}">Privacy Policy</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Create New</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Archive --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.privacy_policies-showSoftDelete') }}" class="btn btn-danger">
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
                        <form action="{{ route('super_admin.privacy_policies-store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                {{-- Title EN --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title_en"
                                            class="form-control border border-info @error('title_en') border-danger @enderror"
                                            id="tb-name" value="{{ old('title_en') }}" placeholder="Title En">
                                        <label for="tb-name">
                                            <i data-feather="type" class="feather-sm text-info fill-white me-2"></i>Title En
                                            <strong class="text-danger">
                                                @error('title_en')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                    </div>
                                </div>

                                {{-- Title AR --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title_ar"
                                            class="form-control border border-info @error('title_ar') border-danger @enderror"
                                            id="tb-name" value="{{ old('title_ar') }}" placeholder="Title Ar">
                                        <label for="tb-name">
                                            <i data-feather="type" class="feather-sm text-info fill-white me-2"></i>Title Ar
                                            <strong class="text-danger">
                                                @error('title_ar')
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
                                            <option value="">--- Select Status ---</option>
                                            <option value="1" @if (old('status') == 1) selected @endif
                                                @if (old('status') == null) selected @endif>Active
                                            </option>
                                            <option value="2" @if (old('status') == 2) selected @endif>
                                                Inactive </option>
                                        </select>
                                        <strong class="text-danger">
                                            @error('status')
                                                ( {{ $message }} )
                                            @enderror
                                        </strong>
                                    </div>
                                </div>

                                {{-- Description EN --}}
                                <div class="col-md-12">
                                    <h5>Description En</h5>
                                    <textarea name="description_en"
                                        class="form-control ckeditor ltr-editor border-info @error('description_en') border-danger @enderror en"
                                        id="tb-description-en" placeholder="Description En" rows="5">{{ old('description_en') }}</textarea>
                                    <label for="tb-description-en">
                                        <strong class="text-danger">
                                            @error('description_en')
                                                ( {{ $message }} )
                                            @enderror
                                        </strong>
                                    </label>
                                </div>
                                <br>
                                {{-- Description AR --}}
                                <div class="col-md-12">
                                    <h5>Description AR</h5>
                                    <textarea name="description_ar"
                                        class="form-control ckeditor rtl-editor border-info @error('description_ar') border-danger @enderror ar"
                                        id="tb-description-ar" placeholder="Description AR" rows="5">{{ old('description_ar') }}</textarea>
                                    <label for="tb-description-ar">
                                        <strong class="text-danger">
                                            @error('description_ar')
                                                ( {{ $message }} )
                                            @enderror
                                        </strong>
                                    </label>
                                </div>

                                {{-- Button --}}
                                <div class="col-12">
                                    <div class="d-md-flex align-items-center mt-3">
                                        <div class="ms-auto mt-3 mt-md-0">
                                            <button type="submit"
                                                class="btn btn-success font-weight-medium rounded-pill px-4">
                                                <div class="d-flex align-items-center">
                                                    <i data-feather="plus" class="feather-sm fill-white me-2"></i>
                                                    Create New
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

@endsection
