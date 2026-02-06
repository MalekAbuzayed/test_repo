@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="aboutUs">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">About Us</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">About Us</li>
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
                <h4 class="card-title mb-0">About Us</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        {{-- Details --}}
                        <div class="row">
                            {{-- Title AR --}}
                            <div class="col-md-6">
                                <h5 class="card-title">
                                    <label>Title AR:</label>
                                    {{ isset($aboutUs->title_ar) ? $aboutUs->title_ar : '----' }}
                                </h5>
                            </div>

                            {{-- Title EN --}}
                            <div class="col-md-6">
                                <h5 class="card-title">
                                    <label>Title EN:</label>
                                    {{ isset($aboutUs->title_en) ? $aboutUs->title_en : '----' }}
                                </h5>
                            </div>
                        </div>

                        <br>

                        {{-- description_ar --}}
                        <div class="row">
                            <div class="col-md-12">
                                <label>Description AR:</label>
                                <p class="card-text">
                                    {{ isset($aboutUs->description_ar) ? $aboutUs->description_ar : '----' }}</p>
                            </div>
                        </div>

                        <br>

                        {{-- description_en --}}
                        <div class="row">
                            <div class="col-md-12">

                                <label for="">Description EN:</label>
                                <p class="card-text">
                                    {{ isset($aboutUs->description_en) ? $aboutUs->description_en : '----' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Edit --}}
            <div class="border-bottom title-part-padding">
                <div class="row justify-content-end">
                    <div class="col-auto">
                        <a href="{{ route('super_admin.about_us-edit', isset($aboutUs->id) ? $aboutUs->id : -1) }}"
                            class="btn btn-dark">
                            <i data-feather="plus" class="fill-white feather-sm"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <style>
        label {

            font-weight: bold;
        }
    </style>
@endsection
