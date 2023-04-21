<?php

namespace App\Http\Livewire\Admin\Team;

use Livewire\Component;
use App\Models\Team;
use Illuminate\Validation\Rule;

class TeamEditForm extends Component
{
    public $name, $modelId, $oldname;

    protected $listeners = [
        'getModelId',
        'refreshChild' => '$refresh',
        'forceCloseEditModal',
    ];

    protected $validationAttributes = [
        'name' => 'team name',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('teams')->ignore($this->modelId)],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:teams,name,'.$this->modelId.'',
        ]);
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $team = Team::findorFail($this->modelId);
        $this->name = $team->name;
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

    public function UpdateTeamData()
    {
        if ($this->modelId) {

            $model = Team::find($this->modelId);

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
        return view('livewire.admin.team.team-edit-form');
    }
}
