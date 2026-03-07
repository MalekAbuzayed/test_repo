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
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Create --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-create') }}" class="btn btn-dark">
                            <i data-feather="plus" class="fill-white feather-sm"></i> Create New
                        </a>
                    </div>
                    {{-- Archive --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-showSoftDelete') }}" class="btn btn-danger">
                            <i data-feather="archive" class="fill-white feather-sm"></i> View Archive
                        </a>
                    </div>
                    @if (isset($products) && $products->count() > 0)
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
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Subcategory</th>
                                        <th>Grandchild</th>
                                        <th>Status</th>
                                        <th>Date/Time</th>
                                        <th>Control</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($products) && $products->count() > 0)
                                        @foreach ($products as $product)
                                            <tr>
                                                {{-- ID --}}
                                                <td>{{ $product->id }}</td>

                                                {{-- Image --}}
                                                <td>
                                                    @php
                                                        $img = $product->files->first(); // due to ordering (primary first)
                                                    @endphp

                                                    <a href="{{ route('super_admin.products-show', $product->id) }}">
                                                        @if ($img)
                                                            <img src="{{ asset('storage/' . $img->path) }}" alt="Image"
                                                                height="80" width="80"
                                                                class="img-thumbnail image-preview">
                                                        @else
                                                            no image
                                                        @endif
                                                    </a>
                                                </td>

                                                {{-- Name --}}
                                                <td>{{ isset($product->title) ? Str::limit($product->title, 30) : '----' }}
                                                </td>

                                                {{-- Subcategory --}}
                                                <td>{{ $product->subcategory->name ?? '----' }}</td>

                                                {{-- Grandchild --}}
                                                <td>{{ $product->grandchild->name ?? '----' }}</td>

                                                {{-- Status --}}
                                                <td>
                                                    @if ($product->status == 'Active')
                                                        <a href="{{ route('super_admin.products-activeInactiveSingle', isset($product->id) ? $product->id : -1) }}"
                                                            class="process btn waves-effect waves-light btn-light-danger btn-sm"
                                                            title="Set Inactive"><i class="mdi mdi-pause"></i></a>
                                                        <span
                                                            style="color:green;">{{ isset($product->status) ? $product->status : '----' }}</span>
                                                    @elseif($product->status == 'Inactive')
                                                        <a href="{{ route('super_admin.products-activeInactiveSingle', isset($product->id) ? $product->id : -1) }}"
                                                            class="process btn waves-effect waves-light btn-light-success btn-sm"
                                                            title="Set Active"><i class="mdi mdi-play"></i></a>
                                                        <span
                                                            style="color:red;">{{ isset($product->status) ? $product->status : '----' }}</span>
                                                    @endif
                                                </td>

                                                {{-- created at --}}
                                                <td>{!! isset($product->created_at)
                                                    ? '<strong>Date : </strong>' .
                                                        date('Y -m-d', strtotime($product->created_at)) .
                                                        '<br><strong>Time : </strong>' .
                                                        date('h:i A', strtotime($product->created_at)) .
                                                        '<br><strong>Since : </strong> ' .
                                                        $product->created_at->diffForHumans()
                                                    : "<span style='color:blue;'>----------</span>" !!}

                                                </td>

                                                {{-- control --}}
                                                <td>
                                                    <div class="button-group">
                                                        <a href="{{ route('super_admin.products-show', isset($product->id) ? $product->id : -1) }}"
                                                            class="btn waves-effect waves-light btn-primary btn-sm"
                                                            title="View Details"><i class="fas fa-eye"></i></a>
                                                        <a href="{{ route('super_admin.products-edit', isset($product->id) ? $product->id : -1) }}"
                                                            class="btn waves-effect waves-light btn-secondary btn-sm"
                                                            title="Edit"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('super_admin.products-softDelete', isset($product->id) ? $product->id : -1) }}"
                                                            class="confirm btn waves-effect waves-light btn-danger btn-sm"
                                                            title="Delete"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>

                                                {{-- select --}}
                                                <td class="text-center">
                                                    <input type="checkbox" class="selectedProducts"
                                                        name="selectedProducts[]" value="{{ $product->id }}">
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
            var selectedProducts = document.querySelectorAll(".selectedProducts");
            // Determine whether the boxes are selected or not
            var areAllChecked = true;
            for (var i = 0; i < selectedProducts.length; i++) {
                if (!selectedProducts[i].checked) {
                    areAllChecked = false;
                    break;
                }
            }
            // Change the status of the check box based on the current status
            for (var i = 0; i < selectedProducts.length; i++) {
                selectedProducts[i].checked = !areAllChecked;
            }
        }
    </script>

    {{-- Soft Delete Selected --}}
    <script>
        function softDeleteSelected() {
            //Collect the selected products
            var selectedProducts = [];
            $('input[name="selectedProducts[]"]:checked').each(function() {
                selectedProducts.push($(this).val());
            });

            //If products are selected, you can perform the function here
            if (selectedProducts.length > 0) {
                //Prepare the data as a query
                var query = '?selectedProducts=' + selectedProducts.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.products-softDeleteSelected') }}' + query;
                // Direct the bproducts to the link after preparing it
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
            //Collect the selected products
            var selectedProducts = [];
            $('input[name="selectedProducts[]"]:checked').each(function() {
                selectedProducts.push($(this).val());
            });

            //If products are selected, you can perform the function here
            if (selectedProducts.length > 0) {
                //Prepare the data as a query
                var query = '?selectedProducts=' + selectedProducts.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.products-activeSelected') }}' + query;
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
            //Collect the selected products
            var selectedProducts = [];
            $('input[name="selectedProducts[]"]:checked').each(function() {
                selectedProducts.push($(this).val());
            });

            //If products are selected, you can perform the function here
            if (selectedProducts.length > 0) {
                //Prepare the data as a query
                var query = '?selectedProducts=' + selectedProducts.join(',');
                // Create the link with the query
                var link = '{{ route('super_admin.products-inactiveSelected') }}' + query;
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
