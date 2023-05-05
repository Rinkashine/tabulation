<?php

namespace App\Http\Livewire\Admin\Team;

use Livewire\Component;
use App\Models\Team;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;

class TeamForm extends Component
{
    use WithFileUploads;

    public $name, $modelId, $photo;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected $validationAttributes = [
        'name' => 'team name',
        'photo' => 'team image',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('team')->ignore($this->modelId)],
            'photo' => 'required|image',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:team,name,'.$this->modelId.'',
            'photo' => 'required|image',
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
    }

    public function StoreTeamData()
    {
        $this->validate();
        $this->photo->store('team', 's3');
        $data = [
            'name' => $this->name,
            'photo' => $this->photo->hashName(),
        ];
        Team::create($data);
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
        return view('livewire.admin.team.team-form');
    }
}
