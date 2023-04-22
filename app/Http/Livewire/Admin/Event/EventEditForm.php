<?php

namespace App\Http\Livewire\Admin\Event;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Validation\Rule;

class EventEditForm extends Component
{
    public $name, $modelId, $oldname;

    protected $listeners = [
        'getModelId',
        'refreshChild' => '$refresh',
        'forceCloseEditModal',
    ];

    protected $validationAttributes = [
        'name' => 'event name',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('event')->ignore($this->modelId)],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:event,name,'.$this->modelId.'',
        ]);
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $event = Event::findorFail($this->modelId);
        $this->name = $event->name;
    }

    public function closeEditModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeEditModal');
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }

    public function forceCloseEditModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

  public function UpdateEventData()
    {
        if ($this->modelId) {

            $model = Event::find($this->modelId);

            $this->validate();
            $this->oldname = $model->name;
            $model->name = $this->name;
            $model->update();

            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => $this->oldname.' was sucessfully changed to '.$this->name,
                'title' => 'Record Successfully Edit',
            ]);
        }
        $this->cleanVars();
        $this->dispatchBrowserEvent('closeEditModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.event.event-edit-form');
    }
}
