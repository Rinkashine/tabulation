<?php

namespace App\Http\Controllers\Backend\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
class TabulationController extends Controller
{
    public function index()
    {
        return view('admin.page.tabulation');
    }

    public function create($event,$classification)
    {
        $events = Event::findorfail($event);
        if($events->status == 1){
            return redirect()->route('tabulation.index');
        }
        return view('admin.page.tabulationcreate',[
            'event' => $event,
            'classification' => $classification,
        ]);
    }
}
