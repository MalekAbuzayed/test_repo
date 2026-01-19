@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    {{-- privacyPolices --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Terms & Conditions</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Create --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.terms_and_conditions-create') }}" class="btn btn-dark">
                            <i data-feather="plus" class="fill-white feather-sm"></i>Create New
                        </a>
                    </div>
                    {{-- Archive --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.terms_and_conditions-showSoftDelete') }}" class="btn btn-danger">
                            <i data-feather="archive" class="fill-white feather-sm"></i>View Archive
                        </a>
                    </div>
                    @if (isset($termsConditions) && $termsConditions->count() > 0)
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
                                        <th>Title EN</th>
                                        <th>Title AR</th>
                                        <th>Status</th>
                                        <th>Date/Time</th>
                                        <th>Control</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($termsConditions) && $termsConditions->count() > 0)
                                        @foreach ($termsConditions as $termsCondition)
                                            <tr>
                                                <td><a
                                                        href="{{ route('super_admin.terms_and_conditions-show', isset($termsCondition->id) ? $termsCondition->id : -1) }}">{{ isset($termsCondition->title_en) ? $termsCondition->title_en : '----' }}</a>
                                                </td>
                                                <td><a
                                                        href="{{ route('super_admin.terms_and_conditions-show', isset($termsCondition->id) ? $termsCondition->id : -1) }}">{{ isset($termsCondition->title_ar) ? $termsCondition->title_ar : '----' }}</a>
                                                </td>
                                                <td>
                                                    @if ($termsCondition->status == 'Active')
                                                        <a href="{{ route('super_admin.terms_and_conditions-activeInactiveSingle', isset($termsCondition->id) ? $termsCondition->id : -1) }}"
                                                            class="process btn waves-effect waves-light btn-light-danger btn-sm"
                                                            title="Set Inactive"><i class="mdi mdi-pause"></i></a>
                                                        <span
                                                            style="color:green;">{{ isset($termsCondition->status) ? $termsCondition->status : '----' }}</span>
                                                    @elseif($termsCondition->status == 'Inactive')
                                                        <a href="{{ route('super_admin.terms_and_conditions-activeInactiveSingle', isset($termsCondition->id) ? $termsCondition->id : -1) }}"
                                                            class="process btn waves-effect waves-light btn-light-success btn-sm"
                                                            title="Set Active"><i class="mdi mdi-play"></i></a>
                                                        <span
                                                            style="color:red;">{{ isset($termsCondition->status) ? $termsCondition->status : '----' }}</span>
                                                    @endif
                                                </td>
                                                <td>{!! isset($termsCondition->created_at)
                                                    ? '<strong>Date : </strong>' .
                                                        date('Y -m-d', strtotime($termsCondition->created_at)) .
                                                        '<br><strong>Time : </strong>' .
                                                        date('h:i A', strtotime($termsCondition->created_at)) .
                                                        '<br><strong>Since : </strong> ' .
                                                        $termsCondition->created_at->diffForHumans()
                                                    : "<span style='color:blue;'>----------</span>" !!}</td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="{{ route('super_admin.terms_and_conditions-show', isset($termsCondition->id) ? $termsCondition->id : -1) }}"
                                                            class="btn waves-effect waves-light btn-primary btn-sm"
                                                            title="View Details"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('super_admin.terms_and_conditions-edit', isset($termsCondition->id) ? $termsCondition->id : -1) }}"
                                                            class="btn waves-effect waves-light btn-secondary btn-sm"
                                                            title="Edit"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('super_admin.terms_and_conditions-softDelete', isset($termsCondition->id) ? $termsCondition->id : -1) }}"
                                                            class="confirm btn waves-effect waves-light btn-danger btn-sm"
                                                            title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="selectedTerms"
                                                        name="selectedTerms[]" value="{{ $termsCondition->id }}">
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
            var selectedTerms = document.querySelectorAll(".selectedTerms");
            // Determine whether the boxes are selected or not
            var areAllChecked = true;
            for (var i = 0; i < selectedTerms.length; i++) {
                if (!selectedTerms[i].checked) {
                    areAllChecked = false;
                    break;
                }
            }
            // Change the status of the check box based on the current status
            for (var i = 0; i < selectedTerms.length; i++) {
                selectedTerms[i].checked = !areAllChecked;
            }
        }
    </script>


    {{-- Soft Delete Selected --}}
    <script>
        function softDeleteSelected() {
            //Collect the selected ourCompanys
            var selectedTerms = [];
            $('input[name="selectedTerms[]"]:checked').each(function() {
                selectedTerms.push($(this).val());
            });

            //If ourCompanys are selected, you can perform the function here
            if (selectedTerms.length > 0) {
                //Prepare the data as a query
                var query = '?selectedTerms=' + selectedTerms.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.terms_and_conditions-softDeleteSelected') }}' + query;
                // Direct the ourCompanies to the link after preparing it
                window.location.href = link;
            } else {
                Swal.fire(
                    'Oops',
                    'Please Select At Least One Row',
                    'error'
                )
            }
        }
    </script>


    {{-- Active Selected --}}
    <script>
        function activeSelected() {
            //Collect the selected ourCompanies
            var selectedTerms = [];
            $('input[name="selectedTerms[]"]:checked').each(function() {
                selectedTerms.push($(this).val());
            });

            //If ourCompanies are selected, you can perform the function here
            if (selectedTerms.length > 0) {
                //Prepare the data as a query
                var query = '?selectedTerms=' + selectedTerms.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.terms_and_conditions-activeSelected') }}' + query;
                // Direct the browser to the link after preparing it
                window.location.href = link;
            } else {
                Swal.fire(
                    'Oops',
                    'Please Select At Least One Row',
                    'error'
                )
            }
        }
    </script>


    {{-- Inactive Selected --}}
    <script>
        function inactiveSelected() {
            //Collect the selected ourCompanies
            var selectedTerms = [];
            $('input[name="selectedTerms[]"]:checked').each(function() {
                selectedTerms.push($(this).val());
            });

            //If ourCompanies are selected, you can perform the function here
            if (selectedTerms.length > 0) {
                //Prepare the data as a query
                var query = '?selectedTerms=' + selectedTerms.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.terms_and_conditions-inactiveSelected') }}' + query;
                // Direct the browser to the link after preparing it
                window.location.href = link;
            } else {
                Swal.fire(
                    'Oops',
                    'Please Select At Least One Row',
                    'error'
                )
            }
        }
    </script>
@endsection
