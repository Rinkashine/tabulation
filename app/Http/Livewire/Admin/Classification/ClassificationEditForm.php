<?php

namespace App\Http\Livewire\Admin\Classification;

use Livewire\Component;
use App\Models\Classification;
use Illuminate\Validation\Rule;

class ClassificationEditForm extends Component
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
            'name' => ['required', Rule::unique('classification')->ignore($this->modelId)],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:classification,name,'.$this->modelId.'',
        ]);
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $classification = Classification::findorFail($this->modelId);
        $this->name = $classification->name;
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


    public function UpdateClassificationData()
    {
        if ($this->modelId) {

            $model = Classification::find($this->modelId);
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
        return view('livewire.admin.classification.classification-edit-form');
    }
}
