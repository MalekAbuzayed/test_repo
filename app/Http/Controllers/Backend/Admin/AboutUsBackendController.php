<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AboutUs\UpdateAboutUsFormRequest;
use App\Models\AboutUs;
use App\Models\SupportTicket;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class AboutUsBackendController extends Controller
{
    use UploadImageTrait;

    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $aboutUs = AboutUs::first();

            return view('admin.about_us.index', compact('aboutUs'));
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
            $aboutUs = AboutUs::first();
            if ($aboutUs) {
                return view('admin.about_us.edit', compact('aboutUs'));
            } else {
                return redirect()->route('super_admin.about_us-index')->with('danger', 'This data is not in the records');
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
    public function update($id, UpdateAboutUsFormRequest $request, Route $route)
    {
        try {
            $aboutUs = AboutUs::first();
            if ($aboutUs) {
                // Prepare Data :
                $updated_data = [
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                ];

                // Upload Image Section :

                // image
                if (isset($request->image)) {
                    $orginal_image = $request->file('image');
                    $upload_location = 'storage/images/AboutUs/';
                    $last_image = $this->saveFile($orginal_image, $upload_location);
                    $updated_data['image'] = $last_image;
                }

                // Update in DB :
                DB::transaction(function () use ($updated_data, $aboutUs) {
                    $aboutUs->update($updated_data);
                });

                return redirect()->route('super_admin.about_us-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.about_us-index')->with('danger', 'This record does not exist in the records');
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
