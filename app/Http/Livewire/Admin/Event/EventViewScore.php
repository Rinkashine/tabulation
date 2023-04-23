<?php

namespace App\Http\Livewire\Admin\Event;

use Livewire\Component;
use App\Models\Score;
use App\Models\Event;

class EventViewScore extends Component
{
    public $modelId,$event_name;

    protected $listeners = [
        'getModelViewId',
        'refreshChild' => '$refresh',
        'forceCloseEditModal',
    ];

    public function getModelViewId($modelId)
    {
        $this->modelId = $modelId;
        $event_name = Event::findorfail($modelId);
        $this->event_name = $event_name->name;
    }

    public function render()
    {
        $event_scores = Score::where('event_id',$this->modelId)
        ->get();

        return view('livewire.admin.event.event-view-score',[
            'event_scores' => $event_scores
        ]);
    }
}
