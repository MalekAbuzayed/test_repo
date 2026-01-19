@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Terms & Conditions</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('super_admin.terms_and_conditions-index') }}">Terms & Conditions</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Update Info</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Create --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.terms_and_conditions-create') }}" class="btn btn-dark">
                            <i data-feather="plus" class="fill-white feather-sm"></i>Create New
                        </a>
                    </div>
                    {{-- Show --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.terms_and_conditions-show', isset($termCondition->id) ? $termCondition->id : -1) }}"
                            class="btn btn-primary">
                            <i data-feather="eye" class="fill-white feather-sm"></i> View
                        </a>
                    </div>
                    {{-- Active / Inactive --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.terms_and_conditions-activeInactiveSingle', isset($termCondition->id) ? $termCondition->id : -1) }}"
                            class="btn btn-warning">
                            @if (isset($termCondition->status) && $termCondition->status == 'Active')
                                <i data-feather="pause" class="fill-white feather-sm"></i> Set Inactive
                            @elseif(isset($termCondition->status) && $termCondition->status == 'Inactive')
                                <i data-feather="play" class="fill-white feather-sm"></i> Set Active
                            @endif
                        </a>
                    </div>
                    {{-- Delete --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.terms_and_conditions-softDelete', isset($termCondition->id) ? $termCondition->id : -1) }}"
                            class="confirm btn btn-danger">
                            <i data-feather="trash" class="fill-white feather-sm"></i> Delete
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
        <div class="col-12">
            {{-- Form Section --}}
            <div class="card">
                <div class="card-body">
                    <form
                        action="{{ route('super_admin.terms_and_conditions-update', isset($termCondition->id) ? $termCondition->id : -1) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- Title EN --}}
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="title_en"
                                        class="form-control border border-info @error('title_en') border-danger @enderror"
                                        id="tb-name"
                                        value="{{ isset($termCondition->title_en) ? $termCondition->title_en : null }}"
                                        placeholder="Title En">
                                    <label for="tb-name">
                                        <i data-feather="type"
                                            class="feather-sm text-info fill-white me-2"></i>Title En
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
                                        id="tb-name"
                                        value="{{ isset($termCondition->title_ar) ? $termCondition->title_ar : null }}"
                                        placeholder="Title Ar">
                                    <label for="tb-name">
                                        <i data-feather="type"
                                            class="feather-sm text-info fill-white me-2"></i>Title Ar
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
                                        <option value="1" @if ($termCondition->status == 'Active') selected @endif
                                            @if ($termCondition->status == null) selected @endif>Active </option>
                                        <option value="2" @if ($termCondition->status == 'Inactive') selected @endif>
                                            Inactive </option>
                                    </select>
                                </div>
                            </div>

                            {{-- Description EN --}}
                            <div class="col-md-12">
                                <h5> Description En :</h5>
                                <textarea name="description_en"
                                    class="form-control ckeditor en ltr-editor border border-info @error('description_en') border-danger @enderror en" id="tb-description-en"
                                    placeholder="Description En" rows="5">{{ isset($termCondition->description_en) ? $termCondition->description_en : null }}</textarea>
                                <label for="tb-description-en">
                                    <strong class="text-danger">
                                        @error('description_en')
                                            ( {{ $message }} )
                                        @enderror
                                    </strong>
                                </label>
                            </div>

                            {{-- Description AR --}}
                            <div class="col-md-12">
                                <h5> Description AR :</h5>
                                <textarea name="description_ar"
                                    class="form-control ckeditor rtl-editor border border-info @error('description_ar') border-danger @enderror ar" id="tb-description-ar"
                                    placeholder="Description AR" rows="5">{{ isset($termCondition->description_ar) ? $termCondition->description_ar : null }}</textarea>
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
                                        <button type="submit" class="btn btn-success font-weight-medium rounded-pill px-4">
                                            <div class="d-flex align-items-center">
                                                <i data-feather="save" class="feather-sm fill-white me-2"></i>
                                                Save Updates
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
