<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    public function ScheduleIndex(){
        return view('frontend.page.schedule');
    }
}
