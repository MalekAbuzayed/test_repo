@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-12 align-self-center">
                <h3 class="page-title">Update Team Member</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.team_members-index') }}">Team Members</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Update Member</li>
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
                        <form action="{{ route('super_admin.team_members-update', $teamMember->id) }}" method="POST" enctype="multipart/form-data" id="teamMemberForm">
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
                                                   value="{{ old('order', $teamMember->order) }}"
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
                                                   value="{{ old('name_ar', $teamMember->name_ar) }}"
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
                                                   value="{{ old('name_en', $teamMember->name_en) }}"
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
                                                   value="{{ old('position_ar', $teamMember->position_ar) }}"
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
                                                   value="{{ old('position_en', $teamMember->position_en) }}"
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
                                        <small class="text-muted">Leave empty to keep current image</small>
                                    </div>

                                    {{-- current image preview --}}
                                    <div class="col-md-6 mb-3">
                                        <label class="text-dark font-weight-medium mb-3">Current Image:</label>
                                        <div class="border p-2 text-center">
                                            @if($teamMember->image)
                                                <img src="{{ asset('storage/' . $teamMember->image) }}"
                                                     alt="{{ $teamMember->name_en }}"
                                                     style="max-width: 150px; max-height: 150px; border-radius: 50%;">
                                                <p class="mt-2 text-success">Current Image</p>
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($teamMember->name_en) }}&size=150&background=c52c26&color=fff&bold=true"
                                                     alt="{{ $teamMember->name_en }}"
                                                     style="max-width: 150px; max-height: 150px; border-radius: 50%;">
                                                <p class="mt-2 text-muted">Generated Avatar</p>
                                            @endif
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
                                                      rows="4">{{ old('description_ar', $teamMember->description_ar) }}</textarea>
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
                                                      rows="4">{{ old('description_en', $teamMember->description_en) }}</textarea>
                                        </div>
                                        @error('description_en')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Status Info --}}
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-info">
                                            <strong>Current Status:</strong>
                                            @if($teamMember->is_active == 1)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                            <br>
                                            <small>To change status, go back to the list and use the activate/deactivate button.</small>
                                        </div>
                                    </div>

                                    {{-- Buttons --}}
                                    <div class="col-md-12">
                                        <button class="btn btn-primary" type="submit">
                                            <i data-feather="save" class="fill-white feather-sm"></i> Update Member
                                        </button>
                                        <a href="{{ route('super_admin.team_members-index') }}" class="btn btn-secondary">
                                            <i data-feather="x" class="fill-white feather-sm"></i> Cancel
                                        </a>
                                        <a href="{{ route('super_admin.team_members-show', $teamMember->id) }}" class="btn btn-info">
                                            <i data-feather="eye" class="fill-white feather-sm"></i> View
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
    </script>
@endsection
