<?php

namespace App\Http\Livewire\Admin\Event;

use Livewire\Component;
use App\Models\Event;
class EventDelete extends Component
{
    public $modelId;

    protected $listeners = [
        'getModelDeleteModalId',
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    private function cleanVars()
    {
        $this->modelId = null;
    }

    public function getModelDeleteModalId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function delete()
    {
        $event = Event::find($this->modelId);
        $event->delete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $event->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.admin.event.event-delete');
    }
}
