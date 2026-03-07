@extends('admin.layouts.app')

@section('content')
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
                            <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-showSoftDelete') }}" class="btn btn-danger">
                            <i data-feather="archive" class="fill-white feather-sm"></i>View Archive
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            {{-- LEFT: UPDATE FORM --}}
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">

                        {{-- GLOBAL ERRORS --}}
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

                        @php
                            $subcategoryTree = $subcategories
                                ->map(fn($subcategory) => [
                                    'id' => $subcategory->id,
                                    'name' => $subcategory->name,
                                    'grandchilds' => $subcategory->grandchilds
                                        ->map(fn($grandchild) => [
                                            'id' => $grandchild->id,
                                            'name' => $grandchild->name,
                                        ])
                                        ->values(),
                                ])
                                ->values();
                        @endphp

                        <form action="{{ route('super_admin.products-update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- inject existing spec values for JS --}}
                            <script>
                                window.existingSpecValues = @json($existingSpecValues);
                            </script>
                            <script>
                                window.subcategoriesWithGrandchilds = @json($subcategoryTree);
                            </script>

                            {{-- used to build fetch url safely --}}
                            <input type="hidden" id="specTemplateBase"
                                value="{{ route('admin.spec-template', ['subcategory' => '__ID__']) }}">

                            <div class="row">

                                {{-- Title --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title"
                                            class="form-control border border-info @error('title') border-danger @enderror"
                                            id="tb-title" value="{{ old('title', $product->title) }}"
                                            placeholder="Product Title">
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
                                        <label class="form-label">
                                            <i data-feather="check-circle" class="feather-sm text-info fill-white me-2"></i>
                                            Status
                                            <strong class="text-danger">
                                                @error('status')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        @php
                                            $statusValue = old('status', $product->getRawOriginal('status'));
                                            $statusValue = $statusValue !== null ? (string) $statusValue : '';
                                        @endphp
                                        <select name="status" required
                                            class="form-control form-select border border-info @error('status') border-danger @enderror custom_select_style">
                                            <option value="" @selected($statusValue === '')>--- Choose Status ---</option>
                                            <option value="1" @selected($statusValue === '1')>
                                                Active</option>
                                            <option value="2" @selected($statusValue === '2')>
                                                Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Subcategory --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i data-feather="layers" class="feather-sm text-info fill-white me-2"></i>
                                            Subcategory
                                            <strong class="text-danger">
                                                @error('subcategory_id')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>

                                        <select id="subcategorySelect" name="subcategory_id" required
                                            class="form-control form-select border border-info @error('subcategory_id') border-danger @enderror custom_select_style">
                                            <option value="">--- Select Subcategory ---</option>
                                            @foreach ($subcategories as $sub)
                                                <option value="{{ $sub->id }}" @selected(old('subcategory_id', $product->subcategory_id) == $sub->id)>
                                                    {{ $sub->category?->name ? $sub->category->name . ' / ' : '' }}{{ $sub->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- Grandchild --}}
                                <div class="col-md-6 d-none" id="grandchildFieldWrapper">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i data-feather="git-branch" class="feather-sm text-info fill-white me-2"></i>
                                            Grandchild
                                            <strong class="text-danger">
                                                @error('grandchild_id')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>

                                        <select id="grandchildSelect" name="grandchild_id" required
                                            class="form-control form-select border border-info @error('grandchild_id') border-danger @enderror custom_select_style">
                                            <option value="">--- Select Grandchild ---</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i data-feather="align-left" class="feather-sm text-info fill-white me-2"></i>
                                            Description
                                            <strong class="text-danger">
                                                @error('description')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <textarea name="description" class="form-control border border-info @error('description') border-danger @enderror"
                                            id="description" placeholder="Product Description" rows="6">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>

                                {{-- ADD NEW IMAGES --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i data-feather="upload" class="feather-sm text-info fill-white me-2"></i>
                                            Add Images
                                            <span class="text-danger small">Max 2MB each</span>
                                            <strong class="text-danger">
                                                @error('images.*')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="file" name="images[]" multiple accept="image/*"
                                            class="form-control border border-info @error('images.*') border-danger @enderror">
                                    </div>
                                </div>

                                {{-- ADD NEW FILES (TYPED) --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i data-feather="upload" class="feather-sm text-info fill-white me-2"></i>
                                            Add Downloadable Files (by type)
                                        </label>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Datasheets</label>
                                                <input type="file" name="files[datasheet][]" multiple
                                                    class="form-control border border-info">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Certificates</label>
                                                <input type="file" name="files[certificate][]" multiple
                                                    class="form-control border border-info">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Manuals</label>
                                                <input type="file" name="files[manual][]" multiple
                                                    class="form-control border border-info">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Guides</label>
                                                <input type="file" name="files[guide][]" multiple
                                                    class="form-control border border-info">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Install Videos</label>
                                                <input type="file" name="files[install_video][]" multiple
                                                    class="form-control border border-info" accept="video/*">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">OND</label>
                                                <input type="file" name="files[ond][]" multiple
                                                    class="form-control border border-info">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Other</label>
                                                <input type="file" name="files[other][]" multiple
                                                    class="form-control border border-info">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- SPECS --}}
                                <div class="col-12">
                                    <label class="form-label">
                                        <i data-feather="list" class="feather-sm text-info fill-white me-2"></i>
                                        Specifications
                                    </label>
                                    <div id="specsContainer"></div>
                                </div>

                                {{-- Submit --}}
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

            {{-- RIGHT: EXISTING MEDIA (OUTSIDE UPDATE FORM) --}}
            <div class="col-12 col-lg-4">
                {{-- Existing Images --}}
                <div class="card">
                    <div class="card-body">
                        <label class="form-label mb-3">
                            <i data-feather="image" class="feather-sm text-info fill-white me-2"></i>
                            Existing Images
                        </label>

                        @php
                            $images = $product->files->where('type', 'image');
                        @endphp

                        @if ($images->count())
                            <div class="row">
                                @foreach ($images as $img)
                                    <div class="col-12 mb-3">
                                        <div class="border rounded p-2">
                                            <img class="img-fluid rounded mb-2"
                                                src="{{ asset('storage/' . $img->path) }}" alt="image">

                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">{{ $img->is_primary ? 'Primary' : '' }}</small>

                                                <div class="d-flex gap-1">
                                                    @if (!$img->is_primary)
                                                        <form method="POST"
                                                            action="{{ route('super_admin.product-files.primary', $img->id) }}">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button class="btn btn-sm btn-warning" type="submit">
                                                                Set Primary
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <form method="POST"
                                                        action="{{ route('super_admin.product-files.destroy', $img->id) }}"
                                                        onsubmit="return confirm('Delete this image?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" type="submit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-muted">No images uploaded yet.</div>
                        @endif
                    </div>
                </div>

                {{-- Existing Files --}}
                <div class="card">
                    <div class="card-body">
                        <label class="form-label mb-3">
                            <i data-feather="file" class="feather-sm text-info fill-white me-2"></i>
                            Existing Downloadable Files
                        </label>

                        @php
                            $nonImages = $product->files->where('type', '!=', 'image')->groupBy('type');
                        @endphp

                        @if ($nonImages->count())
                            @foreach ($nonImages as $type => $items)
                                <div class="border rounded p-2 mb-2">
                                    <strong
                                        class="d-block mb-2 text-capitalize">{{ str_replace('_', ' ', $type) }}</strong>
                                    <ul class="mb-0">
                                        @foreach ($items as $f)
                                            <li class="d-flex justify-content-between align-items-center mb-1">
                                                <a href="{{ asset('storage/' . $f->path) }}" target="_blank">
                                                    {{ $f->title ?? basename($f->path) }}
                                                </a>

                                                <form method="POST"
                                                    action="{{ route('super_admin.product-files.destroy', $f->id) }}"
                                                    onsubmit="return confirm('Delete this file?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        @else
                            <div class="text-muted">No downloadable files uploaded yet.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Specs JS --}}
    @push('scripts')
        <script>
            const specsContainer = document.getElementById('specsContainer');
            const subSelect = document.getElementById('subcategorySelect');
            const grandchildSelect = document.getElementById('grandchildSelect');
            const grandchildFieldWrapper = document.getElementById('grandchildFieldWrapper');
            const templateBase = document.getElementById('specTemplateBase').value;
            const subcategories = window.subcategoriesWithGrandchilds || [];
            let previousSubcategoryId = subSelect.value || '';

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

            function getGrandchildsBySubcategory(subcategoryId) {
                if (!subcategoryId) return [];
                const subcategory = subcategories.find((item) => String(item.id) === String(subcategoryId));
                return subcategory && Array.isArray(subcategory.grandchilds) ? subcategory.grandchilds : [];
            }

            function renderGrandchildOptions(subcategoryId, selectedGrandchildId = '') {
                const grandchilds = getGrandchildsBySubcategory(subcategoryId);
                let html = '<option value="">--- Select Grandchild ---</option>';

                grandchilds.forEach((grandchild) => {
                    const selected = String(selectedGrandchildId) === String(grandchild.id) ? 'selected' : '';
                    html += `<option value="${esc(grandchild.id)}" ${selected}>${esc(grandchild.name)}</option>`;
                });

                grandchildSelect.innerHTML = html;
                const shouldShow = !!subcategoryId && grandchilds.length > 0;
                if (!shouldShow) {
                    grandchildSelect.value = '';
                }
                grandchildSelect.disabled = !shouldShow;
                grandchildSelect.required = shouldShow;
                grandchildFieldWrapper.classList.toggle('d-none', !shouldShow);
            }

            function renderField(field, existingValue) {
                const label = esc(field.label);
                const unitText = field.unit ? ` (${esc(field.unit)})` : '';
                const star = field.is_key ? ' ⭐' : '';
                const name = inputName(field.id);
                const value = existingValue ?? '';

                if (field.data_type === 'bool') {
                    return `
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label class="form-label">${label}${unitText}${star}</label>
                            <select name="${esc(name)}" class="form-control form-select border border-info custom_select_style">
                              <option value="" ${value===''?'selected':''}>—</option>
                              <option value="1" ${value==='1'?'selected':''}>Yes</option>
                              <option value="0" ${value==='0'?'selected':''}>No</option>
                            </select>
                          </div>
                        </div>
                    `;
                }

                const typeAttr = (field.data_type === 'number') ? 'number' : 'text';

                return `
                    <div class="col-md-6">
                      <div class="form-floating mb-3">
                        <input type="${typeAttr}" name="${esc(name)}" value="${esc(value)}"
                          class="form-control border border-info" id="spec-${field.id}"
                          placeholder="${label}${unitText}" step="any">
                        <label for="spec-${field.id}">${label}${unitText}${star}</label>
                      </div>
                    </div>
                `;
            }

            function renderGroups(groups, existingValues) {
                specsContainer.innerHTML = '';
                groups.forEach(group => {
                    const groupHtml = `
                        <div class="card mb-3">
                          <div class="card-body">
                            <h5 class="card-title mb-3">${esc(group.title)}</h5>
                            <div class="row">
                              ${group.fields.map(f => renderField(f, (existingValues || {})[String(f.id)])).join('')}
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

                const url = templateBase.replace('__ID__', subcategoryId);
                const res = await fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                if (!res.ok) {
                    specsContainer.innerHTML =
                        `<p class="text-danger mb-0">Failed to load specs (HTTP ${res.status}).</p>`;
                    return;
                }

                const data = await res.json();
                renderGroups(data.groups || [], window.existingSpecValues || {});
            }

            subSelect.addEventListener('change', (e) => {
                const nextSubcategoryId = e.target.value;
                renderGrandchildOptions(nextSubcategoryId);

                if (previousSubcategoryId !== nextSubcategoryId) {
                    window.existingSpecValues = {};
                    previousSubcategoryId = nextSubcategoryId;
                }

                loadTemplate(nextSubcategoryId);
            });

            document.addEventListener('DOMContentLoaded', () => {
                const current = subSelect.value;
                renderGrandchildOptions(current, @json(old('grandchild_id', $product->grandchild_id)));
                if (current) loadTemplate(current);
            });
        </script>
    @endpush
@endsection
