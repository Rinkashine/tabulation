<?php

namespace App\Http\Livewire\Admin\Team;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Team;

class TeamDelete extends Component
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
        $team = Team::find($this->modelId);

        if (!Storage::disk('s3')->exists('team/'.$team->photo)){
            Storage::disk('s3')->delete('team/'.$team->photo);
        }
            $team->delete();

            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => $team->name.' was successfully deleted!',
                'title' => 'Record Deleted',
            ]);
        //}
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }

    public function render()
    {
        return view('livewire.admin.team.team-delete');
    }
}
