<?php

namespace App\Http\Livewire\Admin\Event;

use Livewire\Component;
use App\Models\Event;
use App\Models\Score;

class EventUnsetScore extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelUnsetId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseUnsetModal');
    }

    public function getModelUnsetId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function unset()
    {
        $event = Event::find($this->modelId);
        $event->status = 0;
        $event->update();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $event->name.' was successfully unset!',
            'title' => 'Action Success',
        ]);
        $event_scored = Score::where('event_id', $this->modelId)->delete();
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseUnsetModal');
    }
    public function render()
    {
        return view('livewire.admin.event.event-unset-score');
    }
}
