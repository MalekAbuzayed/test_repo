<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\OurVision;
use App\Models\OurGoal;
use App\Models\TeamMember;

class AboutUsController extends Controller
{
    public function index(){
            $aboutUs = AboutUs::first();

            $ourVision = OurVision::where('is_active', true)->first();

            $ourGoals = OurGoal::where('is_active', true)
                            ->orderBy('order')
                            ->get();

            $teamMembers = TeamMember::where('is_active', true)
                                    ->orderBy('order')
                                    ->get();

            return view('user.about.index', compact(
                'aboutUs',
                'ourVision',
                'ourGoals',
                'teamMembers'
            ));
    }





}
