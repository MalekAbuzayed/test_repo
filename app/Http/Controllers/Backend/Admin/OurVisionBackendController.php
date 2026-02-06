<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OurVision\UpdateOurVisionFormRequest;
use App\Models\OurVision;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class OurVisionBackendController extends Controller
{
    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $ourVision = OurVision::first();

            // إذا ما في سجلات، ننشئ واحد افتراضي
            if (!$ourVision) {
                $ourVision = OurVision::create([
                    'icon' => 'lightbulb',
                    'title_ar' => 'رؤيتنا',
                    'title_en' => 'Our Vision',
                    'bold_description_ar' => 'لتصبح شريك التكنولوجيا الأكثر ثقة في العالم',
                    'bold_description_en' => 'To become the world\'s most trusted technology partner',
                    'normal_description_ar' => 'نتصور مستقبلًا حيث تندمج التكنولوجيا بسلاسة في كل جانب من جوانب الحياة',
                    'normal_description_en' => 'We envision a future where technology seamlessly integrates into every aspect of life',
                    'is_active' => true,
                ]);
            }

            return view('admin.our_vision.index', compact('ourVision'));
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
            $ourVision = OurVision::find($id);

            if ($ourVision) {
                return view('admin.our_vision.edit', compact('ourVision'));
            } else {
                return redirect()->route('super_admin.our_vision-index')->with('danger', 'This data is not in the records');
            }
        } catch (\Throwable $th) {
            return $this->handleError($th, $route);
        }
    }

    // ========================================================================
    // =========================== Update Function ============================
    // =========================Created By :Ayhm Rahhal ==========
    // ========================================================================
    public function update($id, UpdateOurVisionFormRequest $request, Route $route)
    {
        try {
            $ourVision = OurVision::find($id);

            if ($ourVision) {
                $updated_data = [
                    'icon' => $request->icon,
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'bold_description_ar' => $request->bold_description_ar,
                    'bold_description_en' => $request->bold_description_en,
                    'normal_description_ar' => $request->normal_description_ar,
                    'normal_description_en' => $request->normal_description_en,
                ];

                DB::transaction(function () use ($updated_data, $ourVision) {
                    $ourVision->update($updated_data);
                });

                return redirect()->route('super_admin.our_vision-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.our_vision-index')->with('danger', 'This record does not exist in the records');
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
