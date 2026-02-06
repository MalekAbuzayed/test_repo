@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Add New Team Member</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.team_members-index') }}">Team Members</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Member</li>
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
                        <form action="{{ route('super_admin.team_members-store') }}" method="POST" enctype="multipart/form-data" id="teamMemberForm">
                            @csrf
                            <div class="form">
                                <div class="row">
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

                                    {{-- name_ar --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Name (AR):
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-account"></span>
                                            </div>
                                            <input type="text" name="name_ar" required
                                                   class="form-control ar @error('name_ar') is-invalid @enderror"
                                                   value="{{ old('name_ar') }}"
                                                   placeholder="Name in Arabic">
                                        </div>
                                        @error('name_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- name_en --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Name (EN):
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-account"></span>
                                            </div>
                                            <input type="text" name="name_en" required
                                                   class="form-control @error('name_en') is-invalid @enderror"
                                                   value="{{ old('name_en') }}"
                                                   placeholder="Name in English">
                                        </div>
                                        @error('name_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- position_ar --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Position (AR):
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-briefcase"></span>
                                            </div>
                                            <input type="text" name="position_ar" required
                                                   class="form-control ar @error('position_ar') is-invalid @enderror"
                                                   value="{{ old('position_ar') }}"
                                                   placeholder="Position in Arabic">
                                        </div>
                                        @error('position_ar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- position_en --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Position (EN):
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-briefcase"></span>
                                            </div>
                                            <input type="text" name="position_en" required
                                                   class="form-control @error('position_en') is-invalid @enderror"
                                                   value="{{ old('position_en') }}"
                                                   placeholder="Position in English">
                                        </div>
                                        @error('position_en')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- image --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Profile Image:
                                            <small class="text-muted">(Recommended: 150x150px, square image)</small>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text mdi mdi-cloud-upload"></span>
                                            </div>
                                            <input type="file" name="image"
                                                   class="form-control @error('image') is-invalid @enderror"
                                                   accept="image/*">
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">If no image is uploaded, an avatar will be generated from the name.</small>
                                    </div>

                                    {{-- image preview --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">Image Preview:</label>
                                        <div id="imagePreview" class="border p-2 text-center" style="min-height: 150px;">
                                            <img id="previewImage" src="https://ui-avatars.com/api/?name=John+Doe&size=150&background=c52c26&color=fff&bold=true"
                                                 alt="Preview"
                                                 style="max-width: 150px; max-height: 150px; border-radius: 50%;">
                                            <p class="mt-2 text-muted">Default Avatar Preview</p>
                                        </div>
                                    </div>

                                    {{-- description_ar --}}
                                    <div class="col-md-12 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">
                                            Description (AR):
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
                                            Description (EN):
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
                                            <i data-feather="save" class="fill-white feather-sm"></i> Add Member
                                        </button>
                                        <a href="{{ route('super_admin.team_members-index') }}" class="btn btn-secondary">
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

        // Image preview functionality
        document.querySelector('input[name="image"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('previewImage');
            const previewContainer = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    previewContainer.querySelector('p').textContent = 'Selected Image Preview';
                }
                reader.readAsDataURL(file);
            } else {
                // Generate avatar from name
                const nameAr = document.querySelector('input[name="name_ar"]').value || 'عضو فريق';
                const nameEn = document.querySelector('input[name="name_en"]').value || 'Team Member';
                const name = encodeURIComponent(nameEn || nameAr || 'Team Member');
                preview.src = `https://ui-avatars.com/api/?name=${name}&size=150&background=c52c26&color=fff&bold=true`;
                previewContainer.querySelector('p').textContent = 'Avatar Preview';
            }
        });

        // Update avatar preview when name changes
        document.querySelector('input[name="name_en"]').addEventListener('input', function(e) {
            const fileInput = document.querySelector('input[name="image"]');
            if (!fileInput.files.length) {
                const name = encodeURIComponent(e.target.value || 'Team Member');
                const preview = document.getElementById('previewImage');
                preview.src = `https://ui-avatars.com/api/?name=${name}&size=150&background=c52c26&color=fff&bold=true`;
            }
        });
    </script>
@endsection
