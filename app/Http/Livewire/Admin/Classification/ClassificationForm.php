<?php

namespace App\Http\Livewire\Admin\Classification;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Classification;

class ClassificationForm extends Component
{
    public $name, $modelId;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected $validationAttributes = [
        'name' => 'classification name',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('classification')->ignore($this->modelId)],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:classification,name,'.$this->modelId.'',
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
        $this->name = null;
    }
    public function StoreClassificationData()
    {
        $this->validate();
        $data = [
            'name' => $this->name,
        ];
        Classification::create($data);
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
        return view('livewire.admin.classification.classification-form');
    }
}
