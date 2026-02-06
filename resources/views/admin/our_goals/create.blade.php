@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Add New Goal</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.our_goals-index') }}">Our Goals</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Goal</li>
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
                        <form action="{{ route('super_admin.our_goals-store') }}" method="POST" id="ourGoalForm">
                            @csrf
                            <div class="form">
                                <div class="row">
                                    {{-- icon --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Icon Name (Bootstrap Icons):
                                            <strong class="text-danger">*</strong>
                                            <small class="text-muted">e.g., "trophy" for "bi-trophy"</small>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-icon"></span>
                                            </div>
                                            <input type="text" name="icon" required
                                                   class="form-control @error('icon') is-invalid @enderror"
                                                   value="{{ old('icon', 'trophy') }}"
                                                   placeholder="trophy">
                                            <div class="input-group-append">
                                                <span class="input-group-text">bi-</span>
                                            </div>
                                        </div>
                                        @error('icon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-info mt-2 d-block">
                                            <i class="bi bi-{{ old('icon', 'trophy') }}"></i>
                                            Preview: bi-{{ old('icon', 'trophy') }}
                                        </small>
                                        <small class="text-muted">Popular icons: trophy, people, graph-up-arrow, shield-check, star, check-circle</small>
                                    </div>

                                    {{-- order --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Order:
                                            <small class="text-muted">(Lower numbers appear first)</small>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-sort"></span>
                                            </div>
                                            <input type="number" name="order"
                                                   class="form-control @error('order') is-invalid @enderror"
                                                   value="{{ old('order', 0) }}"
                                                   placeholder="0">
                                        </div>
                                        @error('order')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                                   value="{{ old('title_ar') }}"
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
                                                   value="{{ old('title_en') }}"
                                                   placeholder="Title in English">
                                        </div>
                                        @error('title_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- description_ar --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Description AR:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <textarea class="form-control ar ckeditor-textarea" required
                                                      name="description_ar"
                                                      placeholder="Description in Arabic"
                                                      rows="4">{{ old('description_ar') }}</textarea>
                                        </div>
                                        @error('description_ar')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- description_en --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Description EN:
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <textarea class="form-control ckeditor-textarea" required
                                                      name="description_en"
                                                      placeholder="Description in English"
                                                      rows="4">{{ old('description_en') }}</textarea>
                                        </div>
                                        @error('description_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" type="submit">
                                            <i data-feather="save" class="fill-white feather-sm"></i> Save Goal
                                        </button>
                                        <a href="{{ route('super_admin.our_goals-index') }}" class="btn btn-secondary">
                                            <i data-feather="x" class="fill-white feather-sm"></i> Cancel
                                        </a>
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

        // Live icon preview
        document.querySelector('input[name="icon"]').addEventListener('input', function(e) {
            const iconValue = e.target.value.trim();
            const previewElement = document.querySelector('.text-info i');
            const previewText = document.querySelector('.text-info small');

            if (previewElement) {
                previewElement.className = 'bi bi-' + (iconValue || 'trophy');
            }
            if (previewText) {
                previewText.textContent = 'Preview: bi-' + (iconValue || 'trophy');
            }
        });
    </script>
@endsection
