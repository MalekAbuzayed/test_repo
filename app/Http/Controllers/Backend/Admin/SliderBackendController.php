<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Slider\StoreSliderFormRequest;
use App\Http\Requests\Backend\Slider\UpdateSliderFormRequest;
use App\Models\Slider;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadImageTrait;


class SliderBackendController extends Controller
{
    use UploadImageTrait;
    // ========================================================================
    // =========================== index Function =============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function index(Request $request, Route $route)
    {
        try {
            $sliders = Slider::orderBy('created_at', 'desc')->get();
            return view('admin.sliders.index', compact('sliders'));
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $statement = DB::select("SHOW TABLE STATUS LIKE 'sliders'");
            $nextId = $statement[0]->Auto_increment;
            return view('admin.sliders.create', compact('nextId'));
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
    public function store(StoreSliderFormRequest $request, Route $route)
    {
        try {
            // Prepare Data :
            $created_data = [
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'status' => $request->status,
                'description_ar' => $request->description_ar,
                'description_en' => $request->description_en,
                'type' => $request->type
            ];

            // Upload Image Section :
            if (isset($request->image)) {
                $orginal_image = $request->file('image');
                $upload_location = 'storage/images/sliders/';
                $last_image = $this->saveFile($orginal_image, $upload_location);
                $created_data['image'] = $last_image;
            }

            // Upload video Section :
            if (isset($request->video)) {
                $orginal_image = $request->file('video');
                $upload_location = 'storage/videos/sliders/';
                $last_image = $this->saveFile($orginal_image, $upload_location);
                $created_data['video'] = $last_image;
            }

            // Store in DB :
            DB::transaction(function () use ($created_data) {
                Slider::create($created_data);
            });

            return redirect()->route('super_admin.sliders-index')->with('success', 'Record Has Been Added Successfully');
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $slider = Slider::find($id);
            if ($slider) {
                return view('admin.sliders.show', compact('slider'));
            } else {
                return redirect()->route('super_admin.sliders-index')->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $slider = Slider::find($id);
            if ($slider) {
                return view('admin.sliders.edit', compact('slider'));
            } else {
                return redirect()->route('super_admin.sliders-index')->with('danger', 'This data is not in the records');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
    public function update($id, UpdateSliderFormRequest $request, Route $route)
    {
        try {
            $slider = Slider::find($id);
            if ($slider) {
                // Prepare Data :
                $updated_data = [
                    'title_ar' => $request->title_ar,
                    'title_en' => $request->title_en,
                    'status' => $request->status,
                    'description_ar' => $request->description_ar,
                    'description_en' => $request->description_en,
                    'type' => $request->type
                ];

                // Upload Image Section :
                if (isset($request->image)) {
                    $orginal_image = $request->file('image');
                    $upload_location = 'storage/images/sliders/';
                    $last_image = $this->saveFile($orginal_image, $upload_location);
                    $updated_data['image'] = $last_image;
                }


                // Upload video Section :
                if (isset($request->video)) {
                    $orginal_image = $request->file('video');
                    $upload_location = 'storage/videos/sliders/';
                    $last_image = $this->saveFile($orginal_image, $upload_location);
                    $updated_data['video'] = $last_image;
                }

                // Update in DB :
                DB::transaction(function () use ($updated_data, $slider) {
                    $slider->update($updated_data);
                });

                return redirect()->route('super_admin.sliders-index')->with('success', 'Record Has Been Updated');
            } else {
                return redirect()->route('super_admin.sliders-index')->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $slider = Slider::find($id);
            if ($slider) {
                DB::transaction(function () use ($slider) {
                    $slider->delete();
                });
                return redirect()->route('super_admin.sliders-index')->with('success', 'The Deletion Process Has Been Successful');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $sliders = new Slider();
            $sliders = $sliders->onlyTrashed()->select('*')->orderBy('created_at', 'asc')->get();
            return view('admin.sliders.trashed', compact('sliders'));
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $slider = Slider::onlyTrashed()->find($id);
            if ($slider) {
                DB::transaction(function () use ($slider) {
                    $slider->restore();
                });
                return redirect()->route('super_admin.sliders-showSoftDelete')->with('success', 'Restore Completed Successfully');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $slider = Slider::find($id);
            if ($slider) {
                if ($slider->status == 'Active') {
                    $slider->status = 2;  // 2 => Inactive
                } elseif ($slider->status == 'Inactive') {
                    $slider->status = 1;  // 1 => Active
                }
                $slider->save();
                return redirect()->back()->with('success', 'Process Has Been Done Successfully');
            } else {
                return redirect()->back()->with('danger', 'Record Not Found');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $query = $request->selectedSliders;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedSliders = explode(',', $query);
                $sliders = Slider::whereIn('id', $selectedSliders)->get();
                if (isset($sliders) &&  $sliders->count() > 0) {
                    DB::transaction(function () use ($selectedSliders) {
                        Slider::whereIn('id', $selectedSliders)->delete();
                    });
                    return redirect()->route('super_admin.sliders-index')->with('success', 'The Deletion Process Has Been Successful');
                } else {
                    return redirect()->route('super_admin.sliders-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.sliders-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $query = $request->selectedSliders;
            if ($query) {
                // Split the query into an array using the comma ","
                $selectedSliders = explode(',', $query);
                $sliders = Slider::onlyTrashed()->whereIn('id', $selectedSliders)->get();
                if ($sliders) {
                    DB::transaction(function () use ($selectedSliders) {
                        Slider::onlyTrashed()->whereIn('id', $selectedSliders)->restore();
                    });
                    return redirect()->route('super_admin.sliders-index')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.sliders-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.sliders-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $query = $request->selectedSliders;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedSliders = explode(',', $query);
                $sliders = Slider::whereIn('id', $selectedSliders)->get();
                if (isset($sliders) &&  $sliders->count() > 0) {
                    DB::transaction(function () use ($selectedSliders) {
                        Slider::whereIn('id', $selectedSliders)->update(['status' => '1']); // 1 => Active
                    });
                    return redirect()->route('super_admin.sliders-index')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.sliders-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.sliders-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
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
            $query = $request->selectedSliders;

            if ($query) {
                // Split the query into an array using the comma ","
                $selectedSliders = explode(',', $query);
                $sliders = Slider::whereIn('id', $selectedSliders)->get();
                if (isset($sliders) &&  $sliders->count() > 0) {
                    DB::transaction(function () use ($selectedSliders) {
                        Slider::whereIn('id',  $selectedSliders)->update(['status' => 2]); // 1 => Inactive
                    });
                    return redirect()->route('super_admin.sliders-index')->with('success', 'Process Has Been Done Successfully');
                } else {
                    return redirect()->route('super_admin.sliders-index')->with('danger', 'Please Select At Least One Row');
                }
            } else {
                return redirect()->route('super_admin.sliders-index')->with('danger', 'Please Select At Least One Row');
            }
        } catch (\Throwable $th) {
            $function_name =  $route->getActionName();
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
                    'error_line' =>  $th->getLine(),
                ]);
                $end_error_ticket = $new_error_ticket;
            } else {
                $end_error_ticket = $check_old_errors->first();
            }
            return view('errors.support_tickets', compact('th', 'function_name', 'end_error_ticket'));
        }
    }
}
