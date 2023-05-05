<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ViewOverallData;
use App\Models\ViewListOfScoreData;

class HomeController extends Controller
{
    public function index()
    {
        $teams = ViewOverallData::orderby('ranking')->get();
        return view('frontend.page.home',[
            'teams' => $teams
        ]);
    }
    public function EventScoreIndex(){
        return view('frontend.page.event-score');
    }

    public function TeamScoreIndex($team){
        $team_data = ViewListOfScoreData::where('team_name',$team)->orderby('event_name','asc')->get();
        $overall_data = ViewOverallData::where('team_name',$team)->get()->first();
        $rank = $overall_data->ranking;
        $current_points = $overall_data->overall;
        return view('frontend.page.team-score',[
            'team_data' => $team_data,
            'team_name' => $team,
            'current_points' => $current_points,
            'rank' => $rank
        ]);
    }
}
