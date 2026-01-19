<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TermsConditoins\StoreTermsConditoinsFormRequest;
use App\Http\Requests\Backend\TermsConditoins\UpdateTermsConditoinsFormRequest;
use App\Models\SupportTicket;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class TermsConditionBackendController extends Controller
{
    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $termsConditions = TermsAndCondition::orderBy('created_at', 'desc')->get();
            return view('admin.terms.index', compact('termsConditions'));
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
            $statement = DB::select("SHOW TABLE STATUS LIKE 'terms_and_conditions'");
            $nextId = $statement[0]->Auto_increment;
            return view('admin.terms.create', compact('nextId'));
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
    public function store(StoreTermsConditoinsFormRequest $request, Route $route)
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
                TermsAndCondition::create($created_data);
            });

            return redirect()->route('super_admin.terms_and_conditions-index')->with('success', 'The Record Has Been Added Successfully');
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
            $termCondition = TermsAndCondition::find($id);
            if ($termCondition) {
                return view('admin.terms.show', compact('termCondition'));
            } else {
                return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Record Not Found');
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
            $termCondition = TermsAndCondition::find($id);
            if ($termCondition) {
                return view('admin.terms.edit', compact('termCondition'));
            } else {
                return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Record Not Found');
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
    public function update($id, UpdateTermsConditoinsFormRequest $request, Route $route)
    {
        try {
            $termCondition = TermsAndCondition::find($id);
            if ($termCondition) {
                // Prepare Data :
                $updated_data = [
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'status' => $request->status,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                ];

                // Update in DB :
                DB::transaction(function () use ($updated_data, $termCondition) {
                    $termCondition->update($updated_data);
                });

                return redirect()->route('super_admin.terms_and_conditions-index')->with('success', 'Record Has Been Updated Successfully');
            } else {
                return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Record Not Found');
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
            $termCondition = TermsAndCondition::find($id);
            if ($termCondition) {
                DB::transaction(function () use ($termCondition) {
                    $termCondition->delete();
                });
                return redirect()->route('super_admin.terms_and_conditions-index')->with('success', 'Record Has Been Deleted Successfully');
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
            $termConditions = new TermsAndCondition();
            $termConditions = $termConditions->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.terms.trashed', compact('termConditions'));
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
            $termCondition = TermsAndCondition::onlyTrashed()->find($id);
            if ($termCondition) {
                DB::transaction(function () use ($termCondition) {
                    $termCondition->restore();
                });
                return redirect()->route('super_admin.terms_and_conditions-showSoftDelete')->with('success', 'Record Has Been Restored Successfully');
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
            $termCondition = TermsAndCondition::find($id);
            if ($termCondition) {
                if ($termCondition->status == 'Active') {
                    $termCondition->status = 2;  // 2 => Inactive
                } elseif ($termCondition->status == 'Inactive') {
                    $termCondition->status = 1;  // 1 => Active
                }
                $termCondition->save();
                return redirect()->back()->with('success', 'Process Done Successfully');
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
            $query = $request->selectedTerms;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedTerms = explode(',', $query);
                $termConditions = TermsAndCondition::whereIn('id', $selectedTerms)->get();
                if (isset($termConditions) && $termConditions->count() > 0) {
                    DB::transaction(function () use ($selectedTerms) {
                        TermsAndCondition::whereIn('id', $selectedTerms)->delete();
                    });
                    return redirect()->route('super_admin.terms_and_conditions-index')->with('success', 'The Deletion Process Has Been Successful');
                } else {
                    return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Please Select At Least One Row');
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
            $query = $request->selectedTerms;
            if ($query) {
                $selectedTerms = explode(',', $query);
                $termConditions = TermsAndCondition::onlyTrashed()->whereIn('id', $selectedTerms)->get();
                if ($termConditions) {
                    DB::transaction(function () use ($selectedTerms) {
                        TermsAndCondition::onlyTrashed()->whereIn('id', $selectedTerms)->restore();
                    });
                    return redirect()->route('super_admin.terms_and_conditions-index')->with('success', 'Process Done Successfully');
                } else {
                    return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Please Select At Least One Row');
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
            $query = $request->selectedTerms;

            if ($query) {
                $selectedTerms = explode(',', string: $query);
                $termConditions = TermsAndCondition::whereIn('id', $selectedTerms)->get();
                if (isset($termConditions) && $termConditions->count() > 0) {
                    DB::transaction(function () use ($selectedTerms) {
                        TermsAndCondition::whereIn('id', $selectedTerms)->update(['status' => '1']); // 1 => Active
                    });
                    return redirect()->route('super_admin.terms_and_conditions-index')->with('success', 'Process Done Successfully');
                } else {
                    return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Please Select At Least One Row');
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
            $query = $request->selectedTerms;

            if ($query) {
                $selectedTerms = explode(',', string: $query);
                $termConditions = TermsAndCondition::whereIn('id', $selectedTerms)->get();
                if (isset($termConditions) && $termConditions->count() > 0) {
                    DB::transaction(function () use ($selectedTerms) {
                        TermsAndCondition::whereIn('id', $selectedTerms)->update(['status' => 2]);
                    });
                    return redirect()->route('super_admin.terms_and_conditions-index')->with('success', 'Process Done Successfully');
                } else {
                    return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.terms_and_conditions-index')->with('danger', 'Please Select At Least One Row');
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
