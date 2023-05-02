<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Event;
use App\Models\Schedule;
use App\Models\ViewOverallData;

class DashboardController extends Controller
{
    public function index()
    {
        $teams = ViewOverallData::orderby('ranking')->get();

        $number_of_events = Event::get()->count();
        $number_of_teams = Team::get()->count();
        $number_of_schedule = Schedule::get()->count();
        $number_of_scored_events = Event::where('status',1)->get()->count();
        return view('admin.page.dashboard',[
            'number_of_events' => $number_of_events,
            'number_of_teams' => $number_of_teams,
            'number_of_schedule' => $number_of_schedule,
            'number_of_scored_events' => $number_of_scored_events,
            'teams' => $teams

        ]);
    }
}
