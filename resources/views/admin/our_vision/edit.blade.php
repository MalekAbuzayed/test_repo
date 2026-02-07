@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Update Our Vision</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.our_vision-index') }}">Our Vision</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Our Vision</li>
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
                        <form action="{{ route('super_admin.our_vision-update', $ourVision->id) }}" method="POST" enctype="multipart/form-data" id="ourVisionForm">
                            @csrf
                            <div class="form">
                                <div class="row">
                                    {{-- icon --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Icon Name (Bootstrap Icons):
                                            <small class="text-muted">e.g., "lightbulb" for "bi-lightbulb"</small>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-icon"></span>
                                            </div>
                                            <input type="text" name="icon"
                                                   class="form-control @error('icon') is-invalid @enderror"
                                                   value="{{ old('icon', $ourVision->icon ?? 'lightbulb') }}"
                                                   placeholder="lightbulb">
                                            <div class="input-group-append">
                                                <span class="input-group-text">bi-</span>
                                            </div>
                                        </div>
                                        @error('icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-info mt-2 d-block">
                                            <i class="bi bi-{{ old('icon', $ourVision->icon ?? 'lightbulb') }}"></i>
                                            Preview: bi-{{ old('icon', $ourVision->icon ?? 'lightbulb') }}
                                        </small>
                                    </div>

                                    {{-- title_ar --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Title AR:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-format-title"></span>
                                            </div>
                                            <input type="text" name="title_ar" required
                                                   class="form-control ar @error('title_ar') is-invalid @enderror"
                                                   value="{{ old('title_ar', $ourVision->title_ar ?? 'رؤيتنا') }}"
                                                   placeholder="Title in Arabic">
                                        </div>
                                        @error('title_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- title_en --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Title EN:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-format-title"></span>
                                            </div>
                                            <input type="text" name="title_en" required
                                                   class="form-control @error('title_en') is-invalid @enderror"
                                                   value="{{ old('title_en', $ourVision->title_en ?? 'Our Vision') }}"
                                                   placeholder="Title in English">
                                        </div>
                                        @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- bold_description_ar --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Bold Description AR:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <textarea class="form-control ar ckeditor-textarea" required
                                                      name="bold_description_ar"
                                                      placeholder="Bold Description in Arabic"
                                                      rows="4">{{ old('bold_description_ar', $ourVision->bold_description_ar) }}</textarea>
                                        </div>
                                        @error('bold_description_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- bold_description_en --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Bold Description EN:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <textarea class="form-control ckeditor-textarea" required
                                                      name="bold_description_en"
                                                      placeholder="Bold Description in English"
                                                      rows="4">{{ old('bold_description_en', $ourVision->bold_description_en) }}</textarea>
                                        </div>
                                        @error('bold_description_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- normal_description_ar --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Normal Description AR:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <textarea class="form-control ar ckeditor-textarea" required
                                                      name="normal_description_ar"
                                                      placeholder="Normal Description in Arabic"
                                                      rows="4">{{ old('normal_description_ar', $ourVision->normal_description_ar) }}</textarea>
                                        </div>
                                        @error('normal_description_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- normal_description_en --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Normal Description EN:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <textarea class="form-control ckeditor-textarea" required
                                                      name="normal_description_en"
                                                      placeholder="Normal Description in English"
                                                      rows="4">{{ old('normal_description_en', $ourVision->normal_description_en) }}</textarea>
                                        </div>
                                        @error('normal_description_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Save Button --}}
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" type="submit">Save Updates</button>
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
    <script src="{{ asset('back_end_style/src/assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Initialize CKEditor for all textarea elements
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
