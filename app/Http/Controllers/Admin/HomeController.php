<?php

namespace App\Http\Controllers\Admin;

use App\LightSystem;

class HomeController
{
    public function index()
    {
        $lights = LightSystem::orderBy('updated_at','DESC')
            ->limit(5)
            ->get();
        $lightsTurnedON = LightSystem::where('status','==',1)->get();
        $lightsNeedRepair = LightSystem::where('health', '==', 0)->get();
        $lightsPerfectCondition = LightSystem::where('health', '==', 2)->get();
        $mostRecentLight = LightSystem::orderBy('id', 'DESC')->first();
        $mostRecentBadLight = LightSystem::where('health', '==', 0)
            ->orderBy('id', 'ASC')->first();
        $lightsNeedsAttention = LightSystem::where('health', '!=', 2)
            ->orderBy('updated_at', 'DESC')
            ->limit(5)
            ->get();
        return view('dashboard', compact('lights', 'lightsTurnedON', 'lightsNeedRepair', 'lightsPerfectCondition', 'mostRecentLight', 'mostRecentBadLight', 'lightsNeedsAttention'));
    }
}
