<?php

namespace App\Http\Livewire\Admin\Classification;

use Livewire\Component;
use App\Models\ClassificationPoint;

class ClassficationPointsDelete extends Component
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
        $position = ClassificationPoint::find($this->modelId);
        $position->delete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $position->position.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
    public function render()
    {
        return view('livewire.admin.classification.classfication-points-delete');
    }
}
