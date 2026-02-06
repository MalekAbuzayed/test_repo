<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TeamMember\StoreTeamMemberFormRequest;
use App\Http\Requests\Backend\TeamMember\UpdateTeamMemberFormRequest;
use App\Models\TeamMember;
use App\Models\SupportTicket;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;


class TeamMemberBackendController extends Controller
{
    use UploadImageTrait;

    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $teamMembers = TeamMember::orderBy('order')->orderBy('created_at', 'desc')->get();
            return view('admin.team_members.index', compact('teamMembers'));
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
            return view('admin.team_members.create');
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // ============================ Store Function ============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function store(StoreTeamMemberFormRequest $request, Route $route)
    {
        try {
            $validatedData = $request->validated();

            // Add order if not provided
            if (!isset($validatedData['order'])) {
                $maxOrder = TeamMember::max('order');
                $validatedData['order'] = $maxOrder + 1;
            }

            // Upload Image
            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/images/team_members/';
                $last_image = $this->saveFile($orginal_image, $upload_location);
                $validatedData['image'] = $last_image;
            }

            DB::transaction(function () use ($validatedData) {
                TeamMember::create($validatedData);
            });

            return redirect()->route('super_admin.team_members_index')->with('success', 'تم إضافة عضو الفريق بنجاح');
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
            $teamMember = TeamMember::find($id);
            if ($teamMember) {
                return view('admin.team_members.edit', compact('teamMember'));
            } else {
                return redirect()->route('super_admin.team_members-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
            }
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // =========================== Update Function ============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function update($id, UpdateTeamMemberFormRequest $request, Route $route)
    {
        try {
            $teamMember = TeamMember::find($id);
            if ($teamMember) {
                $validatedData = $request->validated();

                // Upload Image if new image provided
                if (isset($request->image)) {
                    $orginal_image = $request->file('image');
                    $upload_location = 'storage/images/team_members/';
                    $last_image = $this->saveFile($orginal_image, $upload_location);
                    $validatedData['image'] = $last_image;
                }

                DB::transaction(function () use ($validatedData, $teamMember) {
                    $teamMember->update($validatedData);
                });

                return redirect()->route('super_admin.team_members-index')->with('success', 'تم تحديث بيانات عضو الفريق بنجاح');
            } else {
                return redirect()->route('super_admin.team_members-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
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
            $teamMember = TeamMember::find($id);
            if ($teamMember) {
                return view('admin.team_members.show', compact('teamMember'));
            } else {
                return redirect()->route('super_admin.team_members-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
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
            $teamMember = TeamMember::find($id);
            if ($teamMember) {
                DB::transaction(function () use ($teamMember) {
                    $teamMember->delete();
                });
                return redirect()->route('super_admin.team_members-index')->with('success', 'تم حذف عضو الفريق بنجاح');
            } else {
                return redirect()->route('super_admin.team_members-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
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
            $teamMembers = TeamMember::onlyTrashed()->orderBy('deleted_at', 'desc')->get();
            return view('admin.team_members.soft_delete', compact('teamMembers'));
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
            $teamMember = TeamMember::onlyTrashed()->find($id);
            if ($teamMember) {
                DB::transaction(function () use ($teamMember) {
                    $teamMember->restore();
                });
                return redirect()->route('super_admin.team_members-showSoftDelete')->with('success', 'تم استعادة عضو الفريق بنجاح');
            } else {
                return redirect()->route('super_admin.team_members-showSoftDelete')->with('danger', 'هذه البيانات غير موجودة في السجلات');
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
            $teamMember = TeamMember::find($id);
            if ($teamMember) {
                if ($teamMember->is_active == 1) {
                    $teamMember->is_active = 0;
                } elseif ($teamMember->is_active == 0) {
                    $teamMember->is_active = 1;
                }
                $teamMember->save();
                return redirect()->route('super_admin.team_members-index')->with('success', 'تم تغيير حالة عضو الفريق بنجاح');
            } else {
                return redirect()->route('super_admin.team_members-index')->with('danger', 'هذه البيانات غير موجودة في السجلات');
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
