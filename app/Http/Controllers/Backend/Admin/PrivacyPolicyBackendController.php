<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\PrivacyPolicy\StorePrivacyPolicyFormRequest;
use App\Http\Requests\Backend\PrivacyPolicy\UpdatePrivacyPolicyFormRequest;
use App\Models\PrivacyPolicy;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class PrivacyPolicyBackendController extends Controller
{
    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $privacyPolices = PrivacyPolicy::orderBy('created_at', 'desc')->get();

            return view('admin.privacy_polices.index', compact('privacyPolices'));
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
            $statement = DB::select("SHOW TABLE STATUS LIKE 'privacy_policies'");
            $nextId = $statement[0]->Auto_increment;

            return view('admin.privacy_polices.create', compact('nextId'));
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
    public function store(StorePrivacyPolicyFormRequest $request, Route $route)
    {
        try {
            // Prepare Data :
            $created_data = [
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'status' => $request->status,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
            ];

            // Store in DB :
            DB::transaction(function () use ($created_data) {
                PrivacyPolicy::create($created_data);
            });

            return redirect()->route('super_admin.privacy_policies-index')->with('success', 'The Record Has Been Added Successfully');
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
            $privacyPolicy = PrivacyPolicy::find($id);
            if ($privacyPolicy) {
                return view('admin.privacy_polices.show', compact('privacyPolicy'));
            } else {
                return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Record Not Found');
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
            $privacyPolicy = PrivacyPolicy::find($id);
            if ($privacyPolicy) {
                return view('admin.privacy_polices.edit', compact('privacyPolicy'));
            } else {
                return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Record Not Found');
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
    public function update($id, UpdatePrivacyPolicyFormRequest $request, Route $route)
    {
        try {
            $privacyPolicy = PrivacyPolicy::find($id);
            if ($privacyPolicy) {
                // Prepare Data :
                $updated_data = [
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'status' => $request->status,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                ];

                // Update in DB :
                DB::transaction(function () use ($updated_data, $privacyPolicy) {
                    $privacyPolicy->update($updated_data);
                });

                return redirect()->route('super_admin.privacy_policies-index')->with('success', 'Record Has Been Updated Successfully');
            } else {
                return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Record Not Found');
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
            $privacyPolicy = PrivacyPolicy::find($id);
            if ($privacyPolicy) {
                DB::transaction(function () use ($privacyPolicy) {
                    $privacyPolicy->delete();
                });

                return redirect()->route('super_admin.privacy_policies-index')->with('success', 'Record Has Been Deleted Successfully');
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
            $privacyPolices = new PrivacyPolicy;
            $privacyPolices = $privacyPolices->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();

            return view('admin.privacy_polices.trashed', compact('privacyPolices'));
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
            $privacyPolicy = PrivacyPolicy::onlyTrashed()->find($id);
            if ($privacyPolicy) {
                DB::transaction(function () use ($privacyPolicy) {
                    $privacyPolicy->restore();
                });

                return redirect()->route('super_admin.privacy_policies-showSoftDelete')->with('success', 'Record Has Been Restored Successfully');
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
            $privacyPolicy = PrivacyPolicy::find($id);
            if ($privacyPolicy) {
                if ($privacyPolicy->status == 'Active') {
                    $privacyPolicy->status = 2;  // 2 => Inactive
                } elseif ($privacyPolicy->status == 'Inactive') {
                    $privacyPolicy->status = 1;  // 1 => Active
                }
                $privacyPolicy->save();

                return redirect()->back()->with('success', 'Process Done Successfully');
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
            $query = $request->selectedPrivaciesPolices;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedPrivaciesPolices = explode(',', $query);
                $privacyPolices = PrivacyPolicy::whereIn('id', $selectedPrivaciesPolices)->get();
                if (isset($privacyPolices) && $privacyPolices->count() > 0) {
                    DB::transaction(function () use ($selectedPrivaciesPolices) {
                        PrivacyPolicy::whereIn('id', $selectedPrivaciesPolices)->delete();
                    });

                    return redirect()->route('super_admin.privacy_policies-index')->with('success', 'The Deletion Process Has Been Successful');
                } else {
                    return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Please Select At Least One Row');
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
            $query = $request->selectedPrivaciesPolices;
            if ($query) {
                $selectedPrivaciesPolices = explode(',', $query);
                $privacyPolices = PrivacyPolicy::onlyTrashed()->whereIn('id', $selectedPrivaciesPolices)->get();
                if ($privacyPolices) {
                    DB::transaction(function () use ($selectedPrivaciesPolices) {
                        PrivacyPolicy::onlyTrashed()->whereIn('id', $selectedPrivaciesPolices)->restore();
                    });

                    return redirect()->route('super_admin.privacy_policies-index')->with('success', 'Process Done Successfully');
                } else {
                    return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Please Select At Least One Row');
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
            $query = $request->selectedPrivaciesPolices;

            if ($query) {
                $selectedPrivaciesPolices = explode(',', $query);
                $privacyPolices = PrivacyPolicy::whereIn('id', $selectedPrivaciesPolices)->get();
                if (isset($privacyPolices) && $privacyPolices->count() > 0) {
                    DB::transaction(function () use ($selectedPrivaciesPolices) {
                        PrivacyPolicy::whereIn('id', $selectedPrivaciesPolices)->update(['status' => '1']); // 1 => Active
                    });

                    return redirect()->route('super_admin.privacy_policies-index')->with('success', 'Process Done Successfully');
                } else {
                    return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Please Select At Least One Row');
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
            $query = $request->selectedPrivaciesPolices;

            if ($query) {
                $selectedPrivaciesPolices = explode(',', $query);
                $privacyPolices = PrivacyPolicy::whereIn('id', $selectedPrivaciesPolices)->get();
                if (isset($privacyPolices) && $privacyPolices->count() > 0) {
                    DB::transaction(function () use ($selectedPrivaciesPolices) {
                        PrivacyPolicy::whereIn('id', $selectedPrivaciesPolices)->update(['status' => 2]);
                    });

                    return redirect()->route('super_admin.privacy_policies-index')->with('success', 'Process Done Successfully');
                } else {
                    return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.privacy_policies-index')->with('danger', 'Please Select At Least One Row');
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
