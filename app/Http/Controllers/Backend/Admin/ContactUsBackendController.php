<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ContactUs\UpdateContactUsFormRequest;
use App\Models\ContactUs;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class ContactUsBackendController extends Controller
{
    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $contactUs = ContactUs::first();

            return view('admin.contact_us.index', compact('contactUs'));
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
            $contactUs = ContactUs::first();
            if ($contactUs) {
                return view('admin.contact_us.edit', compact('contactUs'));
            } else {
                return redirect()->route('super_admin.contact_us-index')->with('danger', 'This data is not in the records');
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
    public function update($id, UpdateContactUsFormRequest $request, Route $route)
    {
        try {
            $contactUs = ContactUs::first();
            if ($contactUs) {
                // Prepare Data :
                $updated_data = [
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address_ar' => $request->address_ar,
                    'address_en' => $request->address_en,
                    'whatsapp' => $request->whatsapp,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                    'linkedin' => $request->linkedin,
                    'youtube' => $request->youtube,
                    'snapchat' => $request->snapchat,
                    'tiktok' => $request->tiktok,
                    'telegram' => $request->telegram,
                ];

                // Update in DB :
                DB::transaction(function () use ($updated_data, $contactUs) {
                    $contactUs->update($updated_data);
                });

                return redirect()->route('super_admin.contact_us-index')->with('success', 'The data has been successfully updated');
            } else {
                return redirect()->route('super_admin.contact_us-index')->with('danger', 'This record does not exist in the records');
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
