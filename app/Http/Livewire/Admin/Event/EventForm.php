<?php

namespace App\Http\Livewire\Admin\Event;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Event;
class EventForm extends Component
{
    public $name, $modelId;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected $validationAttributes = [
        'name' => 'event name',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('events')->ignore($this->modelId)],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:events,name,'.$this->modelId.'',
        ]);
    }

    public function forceCloseModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('CloseAddItemModal');
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }

    public function StoreEventData()
    {

        $this->validate();
        $data = [
            'name' => $this->name,
        ];
        Event::create($data);
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $this->name.' was successfully saved!',
            'title' => 'Record Saved',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseAddItemModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.admin.event.event-form');
    }
}
