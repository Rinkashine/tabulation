<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViewOverallData;

class RankingController extends Controller
{
    public function index()
    {
        $teams = ViewOverallData::orderby('ranking')->get();
        return view('admin.page.overall',[
            'teams' => $teams
        ]);
    }
}
