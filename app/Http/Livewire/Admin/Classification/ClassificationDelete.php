<?php

namespace App\Http\Livewire\Admin\Classification;

use Livewire\Component;
use App\Models\Classification;
class ClassificationDelete extends Component
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
        $classification = Classification::find($this->modelId);
        $classification->delete();
        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $classification->name.' was successfully deleted!',
            'title' => 'Record Deleted',
        ]);
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.admin.classification.classification-delete');
    }
}
