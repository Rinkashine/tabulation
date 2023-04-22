<?php

namespace App\Http\Livewire\Admin\Classification;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\ClassificationPoint;

class ClassficationPointsForm extends Component
{
    public $classification_id, $position, $score;

    public function mount($classification_id){
        $this->classification_id = $classification_id;
    }

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
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
        $this->position = null;
        $this->score = null;
    }

    public function StorePositionData()
    {
        $this->validate();
        $data = [
            'classification_id' => $this->classification_id,
            'position' => $this->position,
            'score' => $this->score
        ];
        ClassificationPoint::create($data);
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $this->position.' was successfully saved!',
            'title' => 'Record Saved',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseAddItemModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }
    public function render()
    {
        return view('livewire.admin.classification.classfication-points-form');
    }
}
