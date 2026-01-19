@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Sliders</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sliders</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Create --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.sliders-create') }}" class="btn btn-dark">
                            <i data-feather="plus" class="fill-white feather-sm"></i> Create New
                        </a>
                    </div>
                    {{-- Archive --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.sliders-showSoftDelete') }}" class="btn btn-danger">
                            <i data-feather="archive" class="fill-white feather-sm"></i> View Archive
                        </a>
                    </div>
                    @if (isset($sliders) && $sliders->count() > 0)
                        {{-- Setting --}}
                        <div class="dropdown me-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Setting
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><button id="softDeleteSelected" class="confirm dropdown-item"
                                        onclick="softDeleteSelected()">Delete Selected</button></li>
                                <li><button id="activeSelected" class="process dropdown-item"
                                        onclick="activeSelected()">Active Selected</button></li>
                                <li><button id="inactiveSelected" class="process dropdown-item"
                                        onclick="inactiveSelected()">Inactive Selected</button></li>
                            </ul>
                        </div>

                        <div class="dropdown me-2">
                            <button class="toggleSelectAllButton btn btn-primary" onclick="selectDeselectAll()">
                                Select/Deselect All</button>
                        </div>
                    @endif
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
                <div class="card">
                    <div class="card-body">
                        {{-- Table Section --}}
                        <div class="table-responsive">
                            <table id="file_export" class="table table-striped table-bordered display">
                                <thead>
                                    <tr>
                                        <th>Media</th>
                                        <th>Title EN</th>
                                        <th>Title AR</th>
                                        <th>Status</th>
                                        <th>Date/Time</th>
                                        <th>Control</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($sliders) && $sliders->count() > 0)
                                        @foreach ($sliders as $slider)
                                            <tr>
                                                {{-- media --}}
                                                <td>
                                                    <a
                                                        href="{{ route('super_admin.sliders-show', isset($slider->id) ? $slider->id : -1) }}">
                                                        @if (isset($slider) && $slider->image && file_exists($slider->image))
                                                            <img src="{{ asset($slider->image) }}" alt="Image"
                                                                height="180" width="200"
                                                                class="img-thumbnail image-preview">
                                                        @else
                                                            <img src="{{ asset('style_files/shared/images_default/default.jpg') }}"
                                                                alt="Image" class="img-thumbnail image-preview">
                                                        @endif

                                                    </a>
                                                </td>

                                                {{-- title en --}}
                                                <td><a
                                                        href="{{ route('super_admin.sliders-show', isset($slider->id) ? $slider->id : -1) }}">{{ isset($slider->title_en) ? $slider->title_en : '----' }}</a>
                                                </td>

                                                {{-- title ar --}}
                                                <td><a
                                                        href="{{ route('super_admin.sliders-show', isset($slider->id) ? $slider->id : -1) }}">{{ isset($slider->title_ar) ? $slider->title_ar : '----' }}</a>
                                                </td>

                                                {{-- status --}}
                                                <td>
                                                    @if ($slider->status == 'Active')
                                                        <a href="{{ route('super_admin.sliders-activeInactiveSingle', isset($slider->id) ? $slider->id : -1) }}"
                                                            class="process btn waves-effect waves-light btn-light-danger btn-sm"
                                                            title="Set Inactive"><i class="mdi mdi-pause"></i></a>
                                                        <span
                                                            style="color:green;">{{ isset($slider->status) ? $slider->status : '----' }}</span>
                                                    @elseif($slider->status == 'Inactive')
                                                        <a href="{{ route('super_admin.sliders-activeInactiveSingle', isset($slider->id) ? $slider->id : -1) }}"
                                                            class="process btn waves-effect waves-light btn-light-success btn-sm"
                                                            title="Set Active"><i class="mdi mdi-play"></i></a>
                                                        <span
                                                            style="color:red;">{{ isset($slider->status) ? $slider->status : '----' }}</span>
                                                    @endif
                                                </td>

                                                {{-- created at --}}
                                                <td>{!! isset($slider->created_at)
                                                    ? '<strong>Date : </strong>' .
                                                        date('Y -m-d', strtotime($slider->created_at)) .
                                                        '<br><strong>Time : </strong>' .
                                                        date('h:i A', strtotime($slider->created_at)) .
                                                        '<br><strong>Since : </strong> ' .
                                                        $slider->created_at->diffForHumans()
                                                    : "<span style='color:blue;'>----------</span>" !!}

                                                </td>

                                                {{-- control --}}
                                                <td>
                                                    <div class="button-group">
                                                        <a href="{{ route('super_admin.sliders-show', isset($slider->id) ? $slider->id : -1) }}"
                                                            class="btn waves-effect waves-light btn-primary btn-sm"
                                                            title="View Details"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('super_admin.sliders-edit', isset($slider->id) ? $slider->id : -1) }}"
                                                            class="btn waves-effect waves-light btn-secondary btn-sm"
                                                            title="Edit"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('super_admin.sliders-softDelete', isset($slider->id) ? $slider->id : -1) }}"
                                                            class="confirm btn waves-effect waves-light btn-danger btn-sm"
                                                            title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>

                                                {{-- select --}}
                                                <td class="text-center">
                                                    <input type="checkbox" class="selectedSliders" name="selectedSliders[]"
                                                        value="{{ $slider->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
    {{-- Select/Deselect all --}}
    <script>
        function selectDeselectAll() {
            // Get bcheckbox using CSS class classes
            var selectedSliders = document.querySelectorAll(".selectedSliders");
            // Determine whether the boxes are selected or not
            var areAllChecked = true;
            for (var i = 0; i < selectedSliders.length; i++) {
                if (!selectedSliders[i].checked) {
                    areAllChecked = false;
                    break;
                }
            }
            // Change the status of the check box based on the current status
            for (var i = 0; i < selectedSliders.length; i++) {
                selectedSliders[i].checked = !areAllChecked;
            }
        }
    </script>

    {{-- Soft Delete Selected --}}
    <script>
        function softDeleteSelected() {
            //Collect the selected sliders
            var selectedSliders = [];
            $('input[name="selectedSliders[]"]:checked').each(function() {
                selectedSliders.push($(this).val());
            });

            //If sliders are selected, you can perform the function here
            if (selectedSliders.length > 0) {
                //Prepare the data as a query
                var query = '?selectedSliders=' + selectedSliders.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.sliders-softDeleteSelected') }}' + query;
                // Direct the bsliderser to the link after preparing it
                window.location.href = link;
            } else {
                Swal.fire(
                    'Oops',
                    'Please Select  At Least One Row',
                    'error'
                )
            }
        }
    </script>

    {{-- Active Selected --}}
    <script>
        function activeSelected() {
            //Collect the selected sliders
            var selectedSliders = [];
            $('input[name="selectedSliders[]"]:checked').each(function() {
                selectedSliders.push($(this).val());
            });

            //If sliders are selected, you can perform the function here
            if (selectedSliders.length > 0) {
                //Prepare the data as a query
                var query = '?selectedSliders=' + selectedSliders.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.sliders-activeSelected') }}' + query;
                // Direct the browser to the link after preparing it
                window.location.href = link;
            } else {
                Swal.fire(
                    'Oops',
                    'Please Select  At Least One Row',
                    'error'
                )
            }
        }
    </script>

    {{-- Inactive Selected --}}
    <script>
        function inactiveSelected() {
            //Collect the selected sliders
            var selectedSliders = [];
            $('input[name="selectedSliders[]"]:checked').each(function() {
                selectedSliders.push($(this).val());
            });

            //If sliders are selected, you can perform the function here
            if (selectedSliders.length > 0) {
                //Prepare the data as a query
                var query = '?selectedSliders=' + selectedSliders.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.sliders-inactiveSelected') }}' + query;
                // Direct the browser to the link after preparing it
                window.location.href = link;
            } else {
                Swal.fire(
                    'Oops',
                    'Please Select  At Least One Row',
                    'error'
                )
            }
        }
    </script>
@endsection
