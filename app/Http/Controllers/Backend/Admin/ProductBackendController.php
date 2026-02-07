<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Product;
use App\Models\Specification;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use Illuminate\Routing\Route;
use App\Traits\UploadPdfTrait;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\StoreProductFormRequest;
use App\Http\Requests\Backend\Product\UpdateProductFormRequest;

class ProductBackendController extends Controller
{
    use UploadImageTrait;
    use UploadPdfTrait;

    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $products = Product::orderBy('created_at', 'desc')->get();

            return view('admin.products.index', compact('products'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // =========================== Create Function ============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function create(Route $route)
    {
        try {
            // get the next autoincrement id :
            $statement = DB::select("SHOW TABLE STATUS LIKE 'products'");
            $nextId = $statement[0]->Auto_increment;

            return view('admin.products.create', compact('nextId'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // =========================== Store Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function store(StoreProductFormRequest $request, Route $route)
    {
        try {
            $typeValue = $request->type;
            $typeToCategory = [
                'batteries' => 'Batteries',
                'hybrid' => 'Hybrid Inverter',
                'onGrid' => 'On Grid Inverter',
                'pv-module' => 'PV-Module',
                'other' => 'Other',
            ];
            $categoryTitle = $typeToCategory[$typeValue] ?? $typeValue;

            $categoryId = $request->input('category_id');
            if (!$categoryId && $categoryTitle) {
                $category = Category::firstOrCreate(
                    ['title' => $categoryTitle],
                    ['status' => '1']
                );
                $categoryId = $category->id;
            }

            $subcategory = $request->input('subcategory');
            if (!$subcategory) {
                $subcategory = $categoryTitle ?: ($typeValue ?: 'General');
            }

            // Prepare Data :
            $created_data = [
                'name' => $request->name,
                'type' => $request->type,
                'category_id' => $categoryId,
                'subcategory' => $subcategory,
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
            ];

            //request category_id,product_id and specs to store them in the specs table
            // we need to find a way to store the specifications that are rendered depending on the selected type / category

            // Upload Image Section :
            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/images/products/';
                $last_image = $this->saveFile($orginal_image, $upload_location);
                $created_data['image'] = $last_image;
            }

            // Upload File Section :
            if (isset($request->file)) {
                $orginal_file = $request->file('file');
                $upload_location = 'storage/files/products/';
                $last_file = $this->savePdfFile($orginal_file, $upload_location);
                $created_data['file'] = $last_file;
            }

            // Store in DB :
            DB::transaction(function () use ($created_data, $request) {
                $product = Product::create($created_data);

                // Specifications
                $specTitles = $request->input('spec_titles', []);
                $specValues = $request->input('spec_values', []);

                $categoryId = $product->category_id ?? $categoryId ?? 0;

                $specRows = [];
                foreach ($specTitles as $index => $title) {
                    $title = trim((string) $title);
                    $value = trim((string) ($specValues[$index] ?? ''));

                    if ($title === '' || $value === '') {
                        continue;
                    }

                    $specRows[] = [
                        'category_id' => $categoryId,
                        'product_id' => $product->id,
                        'spec_title' => $title,
                        'spec_desc' => $value,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                if (!empty($specRows)) {
                    Specification::insert($specRows);
                }
            });

            return redirect()->route('super_admin.products-index')->with('success', 'Record Has Been Added Successfully');
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ============================ Show Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function show($id, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                return view('admin.products.show', compact('product'));
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ============================ Edit Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function edit($id, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                return view('admin.products.edit', compact('product'));
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'This data is not in the records');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // =========================== Update Function ============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function update($id, UpdateProductFormRequest $request, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                // Prepare Data :
                $updated_data = [
                    'name' => $request->name,
                    'type' => $request->type,
                    'title' => $request->title,
                    'description' => $request->description,
                    'status' => $request->status,
                ];

                // Upload Image Section :
                if (isset($request->image)) {
                    $orginal_image = $request->file('image');
                    $upload_location = 'storage/images/products/';
                    $last_image = $this->saveFile($orginal_image, $upload_location);
                    $updated_data['image'] = $last_image;
                }

                // Upload File Section :
                if (isset($request->file)) {
                    $orginal_file = $request->file('file');
                    $upload_location = 'storage/files/products/';
                    $last_file = $this->savePdfFile($orginal_file, $upload_location);
                    $updated_data['file'] = $last_file;
                }

                // Update in DB :
                DB::transaction(function () use ($updated_data, $product) {
                    $product->update($updated_data);
                });

                return redirect()->route('super_admin.products-index')->with('success', 'Record Has Been Updated');
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ======================== Soft Delete Function ==========================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function softDelete($id, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                DB::transaction(function () use ($product) {
                    $product->delete();
                });

                return redirect()->route('super_admin.products-index')->with('success', 'The Deletion Process Has Been Successful');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ====================== Show Soft Delete Function =======================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function showSoftDelete(Request $request, Route $route)
    {
        try {
            $products = new Product;
            $products = $products->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();

            return view('admin.products.trashed', compact('products'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ==================== Soft Delete Restore Function ======================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function softDeleteRestore($id, Route $route)
    {
        try {
            $product = Product::onlyTrashed()->find($id);
            if ($product) {
                DB::transaction(function () use ($product) {
                    $product->restore();
                });

                return redirect()->route('super_admin.products-showSoftDelete')->with('success', 'Restore Completed Successfully');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ====================== Active/Inactive Single ==========================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {
            $product = Product::find($id);
            if ($product) {
                if ($product->status == 'Active') {
                    $product->status = 2;  // 2 => Inactive
                } elseif ($product->status == 'Inactive') {
                    $product->status = 1;  // 1 => Active
                }
                $product->save();

                return redirect()->back()->with('success', 'Process Has Been Done Successfully');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ======================== Soft Delete Selected Function =================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function softDeleteSelected(Request $request, Route $route)
    {
        try {
            $query = $request->selectedProducts;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedProducts = explode(',', $query);
                $products = Product::whereIn('id', $selectedProducts)->get();
                if (isset($products) && $products->count() > 0) {
                    DB::transaction(function () use ($selectedProducts) {
                        Product::whereIn('id', $selectedProducts)->delete();
                    });

                    return redirect()->route('super_admin.products-index')->with('success', 'The Deletion Process Has Been Successful');
                } else {
                    return redirect()->route('super_admin.products-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ======================== Soft Delete Restore Selected Function =========
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function softDeleteRestoreSelected(Request $request, Route $route)
    {
        try {
            $query = $request->selectedProducts;
            if ($query) {
                // Split the query into an array using the comma ","
                $selectedProducts = explode(',', $query);
                $products = Product::onlyTrashed()->whereIn('id', $selectedProducts)->get();
                if ($products) {
                    DB::transaction(function () use ($selectedProducts) {
                        Product::onlyTrashed()->whereIn('id', $selectedProducts)->restore();
                    });

                    return redirect()->route('super_admin.products-showSoftDelete')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.products-showSoftDelete')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.products-showSoftDelete')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ======================== Active Selected Function ======================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function activeSelected(Request $request, Route $route)
    {
        try {
            $query = $request->selectedProducts;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedProducts = explode(',', $query);
                $products = Product::whereIn('id', $selectedProducts)->get();
                if (isset($products) && $products->count() > 0) {
                    DB::transaction(function () use ($selectedProducts) {
                        Product::whereIn('id', $selectedProducts)->update(['status' => '1']); // 1 => Active
                    });

                    return redirect()->route('super_admin.products-index')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.products-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }

    // ========================================================================
    // ======================== Inactive Selected Function ====================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function inactiveSelected(Request $request, Route $route)
    {
        try {
            $query = $request->selectedProducts;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedProducts = explode(',', $query);
                $products = Product::whereIn('id', $selectedProducts)->get();
                if (isset($products) && $products->count() > 0) {
                    DB::transaction(function () use ($selectedProducts) {
                        Product::whereIn('id', $selectedProducts)->update(['status' => 2]); // 2 => Inactive
                    });

                    return redirect()->route('super_admin.products-index')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.products-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.products-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket;
            $check_old_errors = $check_old_errors->select('*')->where([
                'error_location' => $th->getFile(),
                'error_description' => $th->getMessage(),
                'function_name' => $function_name,
                'error_line' => $th->getLine(),
            ])->get();

            if ($check_old_errors->count() == 0) {
                $new_error_ticket = SupportTicket::create([
                    'error_location' => $th->getFile(),
                    'error_description' => $th->getMessage(),
                    'function_name' => $function_name,
                    'error_line' => $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }

            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }
}
