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

    public $name, $modelId, $oldname, $photo;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected $validationAttributes = [
        'name' => 'team name',
        'photo' => 'brand image',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('teams')->ignore($this->modelId)],
            'photo' => 'required|image',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:teams,name,'.$this->modelId.'',
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
        $this->oldname = null;
    }

    public function StoreTeamData()
    {
        if (! Storage::disk('public')->exists('team')) {
            Storage::disk('public')->makeDirectory('team', 0775, true);
        }
        $this->validate();

        if (! empty($this->photo)) {
            $this->photo->store('public/team');
        }

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
