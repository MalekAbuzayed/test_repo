<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\ContactUsRequest;
use App\Models\Slider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardBackendController extends Controller
{
    // ========================================================================
    // ============================ index Function ============================
    // =========================Created By :Ahmad Abdulmonem Obeidat ==========
    // ========================================================================
    public function index(Request $request)
    {
        $carbonGetNowTime = Carbon::now('Asia/Amman')->format('Y-m-d / h:i A / l');
        $contactUsRequestsCount = ContactUsRequest::count();
        $usersCount = User::count();
        $adminsCount = Admin::count();
        $slidersCount = Slider::count();

        return view('admin.index', compact('carbonGetNowTime', 'contactUsRequestsCount', 'usersCount', 'adminsCount', 'slidersCount'));
    }
}
