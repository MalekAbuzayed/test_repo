@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Update about-Us Info</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('super_admin.about_us-index') }}">About-Us</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update About-Us Info</li>
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
                {{-- Form Section --}}
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('super_admin.about_us-update', isset($aboutUs->id) ? $aboutUs->id : -1) }}"
                            method="POST" enctype="multipart/form-data" id="aboutUsForm">
                            @csrf
                            <div class="form">
                                <div class="row">
                                    {{--  title_ar --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Title AR:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-format-title"
                                                    id="inputGroupPrepend2"></span>
                                            </div>
                                            <input type="text" name="title_ar" data-validation="required" required
                                                class="form-control ar"
                                                value="{{ old('title_ar', isset($aboutUs->title_ar) ? $aboutUs->title_ar : null) }}"
                                                class="form-control @error('title_ar') is-invalid @enderror"
                                                id="validationServer01" placeholder="Title AR">
                                        </div>
                                        @error('title_ar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- title_en --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Title En:
                                            <strong class="text-danger">
                                                *
                                                @error('title_en')
                                                    -
                                                    {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-format-title"
                                                    id="inputGroupPrepend2"></span>
                                            </div>
                                            <input type="text" name="title_en" data-validation="required" required
                                                value="{{ old('title_en', isset($aboutUs->title_en) ? $aboutUs->title_en : null) }}"
                                                class="form-control @error('title_en') is-invalid @enderror"
                                                id="validationServer01" placeholder="Title En">
                                        </div>
                                    </div>

                                    {{-- description_ar --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Description AR : <strong class="text-danger"> *
                                                @error('description_ar')
                                                    - {{ $message }}
                                                @enderror
                                            </strong>
                                        </label>
                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control ar ckeditor-textarea" required
                                                name="description_ar" placeholder="Description In Arabic" rows="8">{{ old('description_ar', isset($aboutUs->description_ar) ? $aboutUs->description_ar : null) }}</textarea>
                                        </div>
                                    </div>

                                    {{-- description_en --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                            Description EN :
                                            <strong class="text-danger"> * @error('description_en')
                                                    - {{ $message }}
                                                @enderror </strong>
                                        </label>

                                        <div class="input-group">
                                            <textarea style="width: 90% !important" maxlength="1600" class="form-control ckeditor-textarea"required
                                                name="description_en" placeholder="Description In English" rows="8">{{ old('description_en', isset($aboutUs->description_en) ? $aboutUs->description_en : null) }}</textarea>

                                        </div>
                                    </div>

                                    {{-- image  --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3" for="validationServer01">About Us
                                            Image  : <strong class="text-danger">
                                                @error('image')
                                                    - {{ $message }}
                                                @enderror
                                            </strong></label>
                                        <br>
                                        {{-- <label style="color: red">Recommnded Dimensions are :529px * 500px</label> --}}
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-cloud-upload"></span>
                                            </div>
                                            <input type="file" name="image" class="form-control"
                                                id="validationServer01">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        @if (isset($aboutUs->image) && $aboutUs->getRawOriginal('image') && file_exists($aboutUs->getRawOriginal('image')))
                                            <img src="{{ asset($aboutUs->image) }}" width="100" height="100"
                                                style="border-radius: 10px; border:solid 1px black;">
                                        @else
                                            <img src="{{ asset('style_files\images\notfound.png') }}" width="100"
                                                height="100" style="border-radius: 10px; border:solid 1px black;">
                                        @endif
                                    </div>
                                </div>



                                {{-- Button --}}
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">Save Updates</button>
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
    <script src="{{ asset('back_end_style/src/assets/libs/ckeditor/ckeditor.js') }}"></script>

    <!-- Script to initialize CKEditor for all textarea elements -->
    <script>
        // Select all textarea elements with the class "ckeditor-textarea"
        document.querySelectorAll('.ckeditor-textarea').forEach(textarea => {
            ClassicEditor
                .create(textarea)
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endsection
