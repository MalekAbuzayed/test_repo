@extends('admin.layouts.app')

@section('content')
    {{-- =========================================================== --}}
    {{-- =================== Page Header Section =================== --}}
    {{-- =========================================================== --}}
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">Deleted Products</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('super_admin.products-index') }}">Products</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Deleted Products</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                <div class="d-flex">
                    {{-- Back to Products --}}
                    <div class="dropdown me-2">
                        <a href="{{ route('super_admin.products-index') }}" class="btn btn-dark">
                            <i data-feather="arrow-left" class="fill-white feather-sm"></i> Back to Products
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
                                <li><button id="softDeleteRestoreSelected" class="process dropdown-item"
                                        onclick="softDeleteRestoreSelected()">Restore Selected</button></li>
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
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Deleted At</th>
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
                                                    @if (isset($product) && $product->image && file_exists($product->image))
                                                        <img src="{{ asset($product->image) }}" alt="Image"
                                                            height="80" width="80"
                                                            class="img-thumbnail image-preview">
                                                    @else
                                                        <img src="{{ asset('style_files/shared/images_default/default.jpg') }}"
                                                            alt="Image" height="80" width="80"
                                                            class="img-thumbnail image-preview">
                                                    @endif
                                                </td>

                                                {{-- Name --}}
                                                <td>{{ isset($product->name) ? $product->name : '----' }}</td>

                                                {{-- Type --}}
                                                <td>{{ isset($product->type) ? $product->type : '----' }}</td>

                                                {{-- Title --}}
                                                <td>{{ isset($product->title) ? Str::limit($product->title, 30) : '----' }}
                                                </td>

                                                {{-- Deleted At --}}
                                                <td>{!! isset($product->deleted_at)
                                                    ? '<strong>Date : </strong>' .
                                                        date('Y -m-d', strtotime($product->deleted_at)) .
                                                        '<br><strong>Time : </strong>' .
                                                        date('h:i A', strtotime($product->deleted_at)) .
                                                        '<br><strong>Since : </strong> ' .
                                                        $product->deleted_at->diffForHumans()
                                                    : "<span style='color:blue;'>----------</span>" !!}
                                                </td>

                                                {{-- control --}}
                                                <td>
                                                    <div class="button-group">
                                                        <a href="{{ route('super_admin.products-softDeleteRestore', $product->id) }}"
                                                            class="btn waves-effect waves-light btn-success btn-sm"
                                                            title="Restore">
                                                            <i class="fas fa-undo"></i>
                                                        </a>
                                                    </div>
                                                </td>

                                                {{-- select --}}
                                                <td class="text-center">
                                                    <input type="checkbox" class="selectedProducts" name="selectedProducts[]"
                                                        value="{{ $product->id }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">
                                                No deleted products found
                                            </td>
                                        </tr>
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
            // Get checkbox using CSS class classes
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

    {{-- Restore Selected --}}
    <script>
        function softDeleteRestoreSelected() {
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
                var link = '{{ route('super_admin.products-softDeleteRestoreSelected') }}' + query;
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