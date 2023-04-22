<?php

namespace App\Http\Livewire\Admin\Classification;

use Livewire\Component;
use App\Models\ClassificationPoint;

class ClassficationPointsEditForm extends Component
{
    public $score,$position, $modelId;

    protected $listeners = [
        'getModelId',
        'refreshChild' => '$refresh',
        'forceCloseEditModal',
    ];

    protected $validationAttributes = [
        'position' => 'position name',
    ];

    protected function rules()
    {
        return [
            'position' => ['required'],
            'score' => 'required|integer|min:0'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'position' => 'required',
            'score' => 'required|integer|min:0'
        ]);
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $classification = ClassificationPoint::findorFail($this->modelId);
        $this->position = $classification->position;
        $this->score = $classification->score;
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

            $model = ClassificationPoint::find($this->modelId);
            $this->validate();
            $model->position = $this->position;
            $model->score = $this->score;
            $model->update();

            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => "Action Success",
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
        return view('livewire.admin.classification.classfication-points-edit-form');
    }
}
