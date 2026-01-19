@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Terms & Conditions</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="{{ route('super_admin.terms_and_conditions-index') }}">Terms & Conditions</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Archive</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Create --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.terms_and_conditions-create') }}" class="btn btn-dark">
                            <i data-feather="plus" class="fill-white feather-sm"></i> Create New
                        </a>
                    </div>
                    @if (isset($termConditions) && $termConditions->count() > 0)
                        {{-- Setting --}}
                        <div class="dropdown me-2">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Setting
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><button id="softDeleteRestoreSelected" class="unarchive dropdown-item"
                                        onclick="softDeleteRestoreSelected()">Restore Selected Rows</button>
                                </li>
                            </ul>
                        </div>
                        {{-- Select/Deselect all --}}
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
                                    @if (isset($termConditions) && $termConditions->count() > 0)
                                        @foreach ($termConditions as $termCondition)
                                            <tr>
                                                <td>{{ isset($termCondition->title_en) ? $termCondition->title_en : '----' }}
                                                </td>
                                                <td>{{ isset($termCondition->title_ar) ? $termCondition->title_ar : '----' }}
                                                </td>
                                                <th>
                                                    @if ($termCondition->status == 'Active')
                                                        <span
                                                            style="color:green;">{{ isset($termCondition->status) ? $termCondition->status : '----' }}</span>
                                                    @elseif($termCondition->status == 'Inactive')
                                                        <span
                                                            style="color:red;">{{ isset($termCondition->status) ? $termCondition->status : '----' }}</span>
                                                    @endif
                                                </th>
                                                <td>{!! isset($termCondition->created_at)
                                                    ? '<strong>Date : </strong>' .
                                                        date('Y -m-d', strtotime($termCondition->created_at)) .
                                                        '<br><strong>Time : </strong>' .
                                                        date('h:i A', strtotime($termCondition->created_at)) .
                                                        '<br><strong>Since : </strong> ' .
                                                        $termCondition->created_at->diffForHumans()
                                                    : "<span style='color:blue;'>----------</span>" !!}</td>
                                                <td>
                                                    <div class="button-group">
                                                        <a href="{{ route('super_admin.terms_and_conditions-softDeleteRestore', [isset($termCondition->id) ? $termCondition->id : -1]) }}"
                                                            class="unarchive btn waves-effect waves-light btn-success btn-sm"
                                                            title="Restore this Record"><i
                                                                class="mdi mdi-redo-variant"></i></a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="selectedTerms"
                                                        name="selectedTerms[]" value="{{ $termCondition->id }}">
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



    {{-- Soft Delete Restore Selected --}}
    <script>
        function softDeleteRestoreSelected() {
            // Collect the selected rows
            var selectedTerms = [];
            $('input[name="selectedTerms[]"]:checked').each(function() {
                selectedTerms.push($(this).val());
            });
            //If rows are selected, you can perform the function here
            if (selectedTerms.length > 0) {
                //Prepare the data as a query
                var query = '?selectedTerms=' + selectedTerms.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.terms_and_conditions-softDeleteRestoreSelected') }}' + query;
                // Direct the browser to the link after preparing it
                window.location.href = link;
            } else {
                Swal.fire(
                    'Oops...',
                    'Please select at least one row',
                    'error'
                )
            }
        }
    </script>
@endsection
