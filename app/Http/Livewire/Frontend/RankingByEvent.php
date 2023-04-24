<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Event;
use App\Models\ViewListOfScoreData;

class RankingByEvent extends Component
{
    public $name;

    public function render()
    {
        $event_data = ViewListOfScoreData::where('event_name',$this->name)->orderby('score','desc')->get();
        $events = Event::orderby('name','asc')->get();
        return view('livewire.frontend.ranking-by-event',[
            'events' => $events,
            'event_data' => $event_data,
        ]);
    }
}
