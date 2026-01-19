<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Admin\StoreAdminFormRequest;
use App\Http\Requests\Backend\Admin\UpdateAdminFormRequest;
use App\Models\Admin;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use App\Traits\UploadImageTrait;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminBackendController extends Controller
{
    use UploadImageTrait;
    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $admins = Admin::orderBy('created_at', 'desc')->paginate(12);
            return view('admin.admins.index', compact('admins'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $statement = DB::select("SHOW TABLE STATUS LIKE 'admins'");
            $nextId = $statement[0]->Auto_increment;

            return view('admin.admins.create', compact('nextId'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
    public function store(StoreAdminFormRequest $request, Route $route)
    {
        try {
            // Prepare Data :
            $created_data = [
                'name' => $request->name,
                'status' => $request->status,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),

            ];

            // Store in DB :
            DB::transaction(function () use ($created_data) {
                Admin::create($created_data);
            });

            return redirect()->route('super_admin.admins-index')->with('success', 'Record Has Been Added Successfully');
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $admin = Admin::find($id);
            if ($admin) {
                return view('admin.admins.show', compact('admin'));
            } else {
                return redirect()->route('super_admin.admins-index')->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $admin = Admin::find($id);
            if ($admin) {
                return view('admin.admins.edit', compact('admin'));
            } else {
                return redirect()->route('super_admin.admins-index')->with('danger', 'This data is not in the records');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
    public function update($id, UpdateAdminFormRequest $request, Route $route)
    {
        try {
            $admin = Admin::find($id);
            if ($admin) {
                // Prepare Data :
                $updated_data = [
                    'name' => $request->name,
                    'status' => $request->status,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ];

                // password change
                if ($request->filled('password')) {
                    $update_data['password'] = Hash::make($request->password);
                }

                // Update in DB :
                DB::transaction(function () use ($updated_data, $admin) {
                    $admin->update($updated_data);
                });

                return redirect()->route('super_admin.admins-index')->with('success', 'Record Has Been Updated');
            } else {
                return redirect()->route('super_admin.admins-index')->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $admin = Admin::find($id);
            if ($admin) {
                DB::transaction(function () use ($admin) {
                    $admin->delete();
                });
                return redirect()->route('super_admin.admins-index')->with('success', 'The Deletion Process Has Been Successful');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $admins = new Admin();
            $admins = $admins->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.admins.trashed', compact('admins'));
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $admin = Admin::onlyTrashed()->find($id);
            if ($admin) {
                DB::transaction(function () use ($admin) {
                    $admin->restore();
                });
                return redirect()->route('super_admin.admins-showSoftDelete')->with('success', 'Restore Completed Successfully');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $admin = Admin::find($id);
            if ($admin) {
                if ($admin->status == 'Active') {
                    $admin->status = 2;  // 2 => Inactive
                } elseif ($admin->status == 'Inactive') {
                    $admin->status = 1;  // 1 => Active
                }
                $admin->save();
                return redirect()->back()->with('success', 'Process Has Been Done Successfully');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $query = $request->selectedAdmins;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedAdmins = explode(',', $query);
                $admins = Admin::whereIn('id', $selectedAdmins)->get();
                if (isset($admins) && $admins->count() > 0) {
                    DB::transaction(function () use ($selectedAdmins) {
                        Admin::whereIn('id', $selectedAdmins)->delete();
                    });
                    return redirect()->route('super_admin.admins-index')->with('success', 'The Deletion Process Has Been Successful');
                } else {
                    return redirect()->route('super_admin.admins-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.admins-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $query = $request->selectedAdmins;
            if ($query) {
                // Split the query into an array using the comma ","
                $selectedAdmins = explode(',', $query);
                $admins = Admin::onlyTrashed()->whereIn('id', $selectedAdmins)->get();
                if ($admins) {
                    DB::transaction(function () use ($selectedAdmins) {
                        Admin::onlyTrashed()->whereIn('id', $selectedAdmins)->restore();
                    });
                    return redirect()->route('super_admin.admins-index')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.admins-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.admins-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $query = $request->selectedAdmins;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedAdmins = explode(',', $query);
                $admins = Admin::whereIn('id', $selectedAdmins)->get();
                if (isset($admins) && $admins->count() > 0) {
                    DB::transaction(function () use ($selectedAdmins) {
                        Admin::whereIn('id', $selectedAdmins)->update(['status' => '1']); // 1 => Active
                    });
                    return redirect()->route('super_admin.admins-index')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.admins-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.admins-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
            $query = $request->selectedAdmins;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedAdmins = explode(',', $query);
                $admins = Admin::whereIn('id', $selectedAdmins)->get();
                if (isset($admins) && $admins->count() > 0) {
                    DB::transaction(function () use ($selectedAdmins) {
                        Admin::whereIn('id', $selectedAdmins)->update(['status' => 2]); // 1 => Inactive
                    });
                    return redirect()->route('super_admin.admins-index')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.admins-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.admins-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name = $route->getActionName();
            $check_old_errors = new SupportTicket();
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
