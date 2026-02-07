<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OurGoal\StoreOurGoalFormRequest;
use App\Http\Requests\Backend\OurGoal\UpdateOurGoalFormRequest;
use App\Models\OurGoal;
use App\Models\SupportTicket;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class OurGoalBackendController extends Controller
{
    use UploadImageTrait;

    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $ourGoals = OurGoal::orderBy('order')->orderBy('created_at', 'desc')->get();
            return view('admin.our_goals.index', compact('ourGoals'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // =========================== Create Function ============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function create(Route $route)
    {
        try {
            return view('admin.our_goals.create');
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ============================ Store Function ============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function store(StoreOurGoalFormRequest $request, Route $route)
    {
        try {
            $validatedData = $request->validated();

            // Add order if not provided
            if (!isset($validatedData['order'])) {
                $maxOrder = OurGoal::max('order');
                $validatedData['order'] = $maxOrder + 1;
            }

            DB::transaction(function () use ($validatedData) {
                OurGoal::create($validatedData);
            });

            return redirect()->route('super_admin.our_goals-index')->with('success', 'تم إنشاء الهدف بنجاح');
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ============================ Edit Function =============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function edit($id, Route $route)
    {
        try {
            $ourGoal = OurGoal::find($id);
            if ($ourGoal) {
                return view('admin.our_goals.edit', compact('ourGoal'));
            } else {
                return redirect()->route('super_admin.our_goals-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
            }
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // =========================== Update Function ============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function update($id, UpdateOurGoalFormRequest $request, Route $route)
    {
        try {
            $ourGoal = OurGoal::find($id);
            if ($ourGoal) {
                $validatedData = $request->validated();

                DB::transaction(function () use ($validatedData, $ourGoal) {
                    $ourGoal->update($validatedData);
                });

                return redirect()->route('super_admin.our_goals-index')->with('success', 'تم تحديث البيانات بنجاح');
            } else {
                return redirect()->route('super_admin.our_goals-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
            }
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ========================== Show Function ===============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function show($id, Route $route)
    {
        try {
            $ourGoal = OurGoal::find($id);
            if ($ourGoal) {
                return view('admin.our_goals.show', compact('ourGoal'));
            } else {
                return redirect()->route('super_admin.our_goals-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
            }
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ======================== Soft Delete Function ==========================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function softDelete($id, Route $route)
    {
        try {
            $ourGoal = OurGoal::find($id);
            if ($ourGoal) {
                DB::transaction(function () use ($ourGoal) {
                    $ourGoal->delete();
                });
                return redirect()->route('super_admin.our_goals-index')->with('success', 'تم حذف الهدف بنجاح');
            } else {
                return redirect()->route('super_admin.our_goals-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
            }
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ======================== Show SoftDelete Function ======================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function showSoftDelete(Request $request, Route $route)
    {
        try {
            $ourGoals = OurGoal::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
            return view('admin.our_goals.soft_delete', compact('ourGoals'));
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ====================== Soft Delete Restore Function ====================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function softDeleteRestore($id, Route $route)
    {
        try {
            $ourGoal = OurGoal::onlyTrashed()->find($id);
            if ($ourGoal) {
                DB::transaction(function () use ($ourGoal) {
                    $ourGoal->restore();
                });
                return redirect()->route('super_admin.our_goals-showSoftDelete')->with('success', 'تم استعادة الهدف بنجاح');
            } else {
                return redirect()->route('super_admin.our_goals-showSoftDelete')->with('danger', 'هذه البيانات غير موجودة في السجلات');
            }
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ===================== Active/Inactive Single Function ==================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function activeInactiveSingle($id, Route $route)
    {
        try {
            $ourGoal = OurGoal::find($id);
            if ($ourGoal) {
                if ($ourGoal->is_active == 1) {
                    $ourGoal->is_active = 0;
                } elseif ($ourGoal->is_active == 0) {
                    $ourGoal->is_active = 1;
                }
                $ourGoal->save();
                return redirect()->route('super_admin.our_goals-index')->with('success', 'تم تغيير حالة الهدف بنجاح');
            } else {
                return redirect()->route('super_admin.our_goals-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
            }
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ===================== Handle Error Function ============================
    // ========================================================================
    private function handleError($th, $route)
    {
        $function_name = $route->getActionName();
        $check_old_errors = SupportTicket::select('*')->where([
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
