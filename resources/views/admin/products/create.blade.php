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
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('super_admin.products-index') }}">Products</a>
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
                {{-- 1 Section --}}
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('super_admin.products-store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>There were some problems with your input:</strong>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">


                                {{-- Title --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title"
                                            class="form-control border border-info @error('title') border-danger @enderror"
                                            id="tb-title" value="{{ old('title') }}" placeholder="Product Title">
                                        <label for="tb-title">
                                            <i data-feather="type" class="feather-sm text-info fill-white me-2"></i>
                                            Product Title
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

                                        <select name="status" required
                                            class="form-control form-select border border-info @error('status') border-danger @enderror custom_select_style">
                                            <option value="">--- Choose Status ---</option>
                                            <option value="1" @selected(old('status', 1) == 1)>Active</option>
                                            <option value="2" @selected(old('status') == 2)>Inactive</option>
                                        </select>

                                        @error('status')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Subcategory --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i data-feather="tag" class="feather-sm text-info fill-white me-2"></i>
                                            Subcategory
                                            <strong class="text-danger">
                                                @error('subcategory_id')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>

                                        <select id="subcategorySelect" name="subcategory_id"
                                            class="form-control form-select border border-info @error('subcategory_id') border-danger @enderror custom_select_style"
                                            required>
                                            <option value="">--- Select subcategory ---</option>
                                            @foreach ($subcategories as $sub)
                                                <option value="{{ $sub->id }}" @selected(old('subcategory_id') == $sub->id)>
                                                    {{ $sub->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Images (multiple) --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="images" class="form-label">
                                            <i data-feather="image" class="feather-sm text-info fill-white me-2"></i>
                                            Product Images :
                                            <label style="color: red">Max Size: 2MB each | Formats: jpeg, png, jpg, gif,
                                                webp</label>
                                            <strong class="text-danger">
                                                @error('images')
                                                    ( {{ $message }} )
                                                @enderror
                                                @error('images.*')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>

                                        <input type="file" name="images[]" multiple
                                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                            class="form-control border border-info @error('images') border-danger @enderror @error('images.*') border-danger @enderror"
                                            id="images">
                                    </div>
                                </div>

                                {{-- Download Center Files (typed) --}}
                                <div class="col-12">
                                    <hr>
                                    <h5 class="mb-3">Downloads (Non-images)</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i data-feather="file" class="feather-sm text-info fill-white me-2"></i>
                                                Datasheets
                                            </label>
                                            <input type="file" name="files[datasheet][]" multiple
                                                class="form-control border border-info">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i data-feather="award" class="feather-sm text-info fill-white me-2"></i>
                                                Certificates
                                            </label>
                                            <input type="file" name="files[certificate][]" multiple
                                                class="form-control border border-info">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i data-feather="book-open"
                                                    class="feather-sm text-info fill-white me-2"></i>
                                                Manuals
                                            </label>
                                            <input type="file" name="files[manual][]" multiple
                                                class="form-control border border-info">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i data-feather="map" class="feather-sm text-info fill-white me-2"></i>
                                                Guides
                                            </label>
                                            <input type="file" name="files[guide][]" multiple
                                                class="form-control border border-info">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i data-feather="video" class="feather-sm text-info fill-white me-2"></i>
                                                Install Videos (file uploads)
                                            </label>
                                            <input type="file" name="files[install_video][]" multiple
                                                class="form-control border border-info">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i data-feather="folder" class="feather-sm text-info fill-white me-2"></i>
                                                OND Files
                                            </label>
                                            <input type="file" name="files[ond][]" multiple
                                                class="form-control border border-info">
                                        </div>
                                    </div>

                                    <strong class="text-danger">
                                        @error('files')
                                            ( {{ $message }} )
                                        @enderror
                                        @error('files.*.*')
                                            ( {{ $message }} )
                                        @enderror
                                    </strong>
                                </div>

                                {{-- Specifications (dynamic) --}}
                                <div class="col-12">
                                    <hr>
                                    <h5 class="mb-2">Specifications</h5>
                                    <div class="text-muted small mb-2">Select a subcategory to load specifications.</div>

                                    <div id="specsContainer"></div>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i data-feather="align-left" class="feather-sm text-info fill-white me-2"></i>
                                            Description :
                                            <strong class="text-danger">
                                                @error('description')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="description" class="form-control border border-info @error('description') border-danger @enderror"
                                            id="description" placeholder="Product Description" rows="6">{{ old('description') }}</textarea>
                                    </div>
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

                            </div> {{-- row --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Create page: no existing spec values
        window.existingSpecValues = {};

        const specsContainer = document.getElementById('specsContainer');
        const subSelect = document.getElementById('subcategorySelect');

        function esc(str) {
            return String(str ?? '').replace(/[&<>"']/g, s => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            } [s]));
        }

        function inputName(fieldId) {
            return `spec_values[${fieldId}]`;
        }

        function renderField(field, existingValue) {
            const label = esc(field.label);
            const unitText = field.unit ? ` (${esc(field.unit)})` : '';
            const star = field.is_key ? ' ⭐' : '';
            const name = inputName(field.id);
            const value = existingValue ?? '';

            // bool -> use select (not floating, because bootstrap floating+select is finicky)
            if (field.data_type === 'bool') {
                return `
        <div class="col-md-6">
          <div class="mb-3">
            <label class="form-label">
              ${label}${unitText}${star}
            </label>
            <select name="${esc(name)}"
              class="form-control form-select border border-info custom_select_style">
              <option value="" ${value===''?'selected':''}>—</option>
              <option value="1" ${value==='1'?'selected':''}>Yes</option>
              <option value="0" ${value==='0'?'selected':''}>No</option>
            </select>
          </div>
        </div>
      `;
            }

            // For number/text/range -> use form-floating like the rest of your page
            const typeAttr = (field.data_type === 'number') ? 'number' : 'text';

            return `
      <div class="col-md-6">
        <div class="form-floating mb-3">
          <input
            type="${typeAttr}"
            name="${esc(name)}"
            value="${esc(value)}"
            class="form-control border border-info"
            id="spec-${field.id}"
            placeholder="${label}${unitText}"
            step="any"
          >
          <label for="spec-${field.id}">
            ${label}${unitText}${star}
          </label>
        </div>
      </div>
    `;
        }

        function renderGroups(groups, existingValues) {
            specsContainer.innerHTML = '';

            groups.forEach(group => {
                const groupHtml = `
        <div class="col-12">
          <div class="card mb-3">
            <div class="card-body">
              <h5 class="card-title mb-3">${esc(group.title)}</h5>
              <div class="row">
                ${group.fields.map(f => renderField(f, existingValues[String(f.id)])).join('')}
              </div>
            </div>
          </div>
        </div>
      `;
                specsContainer.insertAdjacentHTML('beforeend', groupHtml);
            });
        }

        async function loadTemplate(subcategoryId) {
            if (!subcategoryId) {
                specsContainer.innerHTML = '';
                return;
            }

            const res = await fetch(`/admin/spec-template/${subcategoryId}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) {
                specsContainer.innerHTML = '<p style="color:red">Failed to load specs.</p>';
                return;
            }

            const data = await res.json();
            renderGroups(data.groups || [], window.existingSpecValues || {});
        }

        subSelect.addEventListener('change', (e) => {
            window.existingSpecValues = {}; // reset (subcategory changed)
            loadTemplate(e.target.value);
        });

        document.addEventListener('DOMContentLoaded', () => {
            const current = subSelect.value;
            if (current) loadTemplate(current);
        });
    </script>
@endpush

@push('styles')
    <style>
        .spec-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .spec-item label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .spec-item input,
        .spec-item select {
            width: 100%;
            padding: 8px;
        }

        .spec-group {
            margin-top: 18px;
            padding: 12px;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .spec-group h3 {
            margin: 0 0 12px;
        }
    </style>
@endpush
