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
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('super_admin.products-index') }}">Products</a></li>
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
                {{-- Form Section --}}
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('super_admin.products-store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Name --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="name"
                                            class="form-control border border-info @error('name') border-danger @enderror"
                                            id="tb-name" value="{{ old('name') }}" placeholder="Product Name">
                                        <label for="tb-name">
                                            <i data-feather="package"
                                                class="feather-sm text-info fill-white me-2"></i>Product
                                            Name
                                            <strong class="text-danger">
                                                @error('name')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                    </div>
                                </div>

                                {{-- Title --}}
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="title"
                                            class="form-control border border-info @error('title') border-danger @enderror"
                                            id="tb-title" value="{{ old('title') }}" placeholder="Product Title">
                                        <label for="tb-title">
                                            <i data-feather="type" class="feather-sm text-info fill-white me-2"></i>Product
                                            Title
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
                                        <select name="status"
                                            class="form-control form-select border border-info @error('status') border-danger @enderror custom_select_style">
                                            <option>--- Choose Status ---</option>
                                            <option value="1" @if (old('status') == 1) selected @endif
                                                @if (old('status') == null) selected @endif>Active
                                            </option>
                                            <option value="2" @if (old('status') == 2) selected @endif>
                                                Inactive </option>
                                        </select>
                                    </div>
                                </div>

                                {{-- Type / Category --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="type" id="product-type"
                                            class="form-control form-select border border-info @error('type') border-danger @enderror custom_select_style">
                                            <option>--- Select Type ---</option>
                                            <option value="batteries" @if (old('type') == 'batteries') selected @endif>
                                                Batteries</option>
                                            <option value="hybrid" @if (old('type') == 'hybrid') selected @endif>
                                                Hybrid Inverter
                                            </option>
                                            <option value="onGrid" @if (old('type') == 'onGrid') selected @endif>
                                                On Grid Inverter
                                            </option>
                                            <option value="pv-module" @if (old('type') == 'pv-module') selected @endif>
                                                PV-Module
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row" id="specs-section">
                                        <div class="col-12 text-muted small">Select a type to load specifications.</div>
                                    </div>
                                </div>
                                {{-- Image --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">
                                            <i data-feather="image" class="feather-sm text-info fill-white me-2"></i>Product
                                            Image :
                                            <label style="color: red">Max Size: 2MB | Formats: jpeg, png, jpg, gif, svg,
                                                webp</label>
                                            <strong class="text-danger">
                                                @error('image')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="file" name="image"
                                            class="form-control border border-info @error('image') border-danger @enderror"
                                            id="image" value="{{ old('image') }}" placeholder="Product Image">
                                    </div>
                                </div>

                                {{-- File --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="file" class="form-label">
                                            <i data-feather="file" class="feather-sm text-info fill-white me-2"></i>Product
                                            File :
                                            <label style="color: red">Max Size: 5MB | Formats: pdf, doc, docx, xls, xlsx,
                                                zip, rar, txt</label>
                                            <strong class="text-danger">
                                                @error('file')
                                                    ( {{ $message }} )
                                                @enderror
                                            </strong>
                                        </label>
                                        <input type="file" name="file"
                                            class="form-control border border-info @error('file') border-danger @enderror"
                                            id="file" value="{{ old('file') }}" placeholder="Product File">
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">
                                            <i data-feather="align-left"
                                                class="feather-sm text-info fill-white me-2"></i>Description :
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    <script>
        // Initialize textarea with Summernote
        $(document).ready(function() {
            if ($.fn.summernote) {
                $('#description').summernote({
                    height: 200,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                        ['help', ['help']]
                    ],
                    placeholder: 'Enter product description here...'
                });
            }

            const specsByType = {
                'batteries': [
                    'Rated Energy (kWh)',
                    'Usable Energy (kWh)',
                    'Nominal Voltage (V)',
                    'Max. Continuous Charging Power (kW)',
                    'Max. Continuous Discharging Power (kW)',
                    'Peak Output Power (kW)',
                    'Cycle Lifespan',
                    'IP Rating',
                    'Round Trip Efficiency',
                    'Depth of Discharge'
                ],
                'hybrid': [
                    'Max Input Voltage (V)',
                    'MPPT Voltage Range (V)',
                    'Start-up Voltage (V)',
                    'Nominal Input Voltage (V)',
                    'Max Input Current Per MPPT (A)',
                    'Max Short Circuit Current Per MPPT (A)',
                    'Number of MPP Trackers',
                    'Number of Strings Per MPPT',
                    'Number of Battery Input',
                    'Nominal Battery Voltage (V)',
                    'Battery Voltage Range (V)',
                    'Max. Continuous Charging Current (A)',
                    'Max. Continuous Discharging Current (A)',
                    'Max. Charging Power (kW)',
                    'Max. Discharging Power (kW)',
                    'Nominal Output Power (W)',
                    'Nominal Output Apparent Power (VA)',
                    'Max. AC Active Power (W)',
                    'Max. AC Apparent Power To Grid (VA)',
                    'Max. AC Apperant power input From Grid (kVA)',
                    'Nominal Output Voltage (V)',
                    'AC Grid Frequency Range (Hz)',
                    'Max. Output Current',
                    'Max. Input Current',
                    'Back-up Nominal Apparent Power (kVA)',
                    'Max. Output Apparent Power without Grid (kVA)',
                    'Max. Output Apparent Power with Grid (kVA)',
                    'Nominal Output Voltage (V)',
                    'Nominal Apparent Power from AC generator (kVA)',
                    'Max. Apparent Power from AC generator (kVA)',
                    'Input Voltage Range (V)',
                    'Max. AC Current From AC generator (A)',
                    'Resicdual Current Monitoring',
                    'PV-Reverse Polarity',
                    'AC (Overvoltage - Overcurrent - Short Circuit)',
                    'DC & AC Surge Preotection',
                    'AFCI Type 3 AI driven',
                    'MAX. Efiiciency (%)',
                    'EU Efficiency (%)',
                    'IP Rating',
                    'LED Screen',
                    'Dimensions (mm)'
                ],
                'onGrid': [
                    'Max Input Voltage (V)',
                    'MPPT Voltage Range (V)',
                    'Start-up Voltage (V)',
                    'Nominal Input Voltage (V)',
                    'Max Input Current Per MPPT (A)',
                    'Max Short Circuit Current Per MPPT (A)',
                    'Number of MPP Trackers',
                    'Number of Strings Per MPPT',
                    'Nominal Output Power (W)',
                    'Nominal Output Apparent Power (VA)',
                    'Max. AC Active Power (W)',
                    'Max. AC Apparent Power (VA)',
                    'Nominal Output Voltage (V)',
                    'AC Grid Frequency Range (Hz)',
                    'Max. Output Current',
                    'Resicdual Current Monitoring',
                    'PV-Reverse Polarity',
                    'AC (Overvoltage - Overcurrent - Short Circuit)',
                    'DC & AC Surge Preotection',
                    'AFCI Type 3 AI driven',
                    'MAX. Efiiciency (%)',
                    'EU Efficiency (%)',
                    'IP Rating',
                    'LED Screen',
                    'Dimensions (mm)'
                ],
                'pv-module': [
                    'Maximum Power (Wp)',
                    'Open Crcuit Voltage (Voc)',
                    'Short Circuit Current (Isc)',
                    'MPPT Voltage (Vmp)',
                    'MPPT Current (Imp)',
                    'Module Efficiency (%)',
                    'Dimensions',
                    'Warranty Against Manufacturing Defects',
                    'Warranty Against Degradation',
                    'Efficiency at year 30'
                ]
            };

            const $typeSelect = $('#product-type');
            const $specsSection = $('#specs-section');

            const oldSpecTitles = @json(old('spec_titles', []));
            const oldSpecValues = @json(old('spec_values', []));
            const oldValueMap = {};

            const titlesArray = Array.isArray(oldSpecTitles) ? oldSpecTitles : [];
            const valuesArray = Array.isArray(oldSpecValues) ? oldSpecValues : [];

            titlesArray.forEach((title, index) => {
                if (!oldValueMap[title]) {
                    oldValueMap[title] = [];
                }
                oldValueMap[title].push(valuesArray[index] || '');
            });

            const slugify = (value) => value.toString().toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');

            const getOldValue = (label) => {
                if (!oldValueMap[label] || oldValueMap[label].length === 0) {
                    return '';
                }
                return oldValueMap[label].shift();
            };

            const renderSpecs = (type) => {
                $specsSection.empty();

                const specs = specsByType[type] || [];
                if (specs.length === 0) {
                    $specsSection.append(
                        $('<div class="col-12 text-muted small">Select a type to load specifications.</div>')
                    );
                    return;
                }

                specs.forEach((label, index) => {
                    const inputId = `spec-${slugify(type)}-${index}`;
                    const value = getOldValue(label);

                    const $col = $('<div class="col-md-6"></div>');
                    const $group = $('<div class="mb-3"></div>');
                    const $label = $('<label class="form-label"></label>').attr('for', inputId).text(label);
                    const $titleInput = $('<input type="hidden" name="spec_titles[]">').val(label);
                    const $valueInput = $('<input type="text" name="spec_values[]" class="form-control border border-info">')
                        .attr('id', inputId)
                        .attr('placeholder', label)
                        .val(value);

                    $group.append($label, $titleInput, $valueInput);
                    $col.append($group);
                    $specsSection.append($col);
                });
            };

            renderSpecs($typeSelect.val());
            $typeSelect.on('change', function() {
                renderSpecs($(this).val());
            });
            $typeSelect.on('select2:select', function() {
                renderSpecs($(this).val());
            });
        });
    </script>
@endsection
