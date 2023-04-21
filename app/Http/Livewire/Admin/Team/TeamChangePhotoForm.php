<?php

namespace App\Http\Livewire\Admin\Team;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Team;

class TeamChangePhotoForm extends Component
{
    use WithFileUploads;

    public $modelId,$name,$photo;

    protected $listeners = [
        'getModelInfo',
        'refreshChild' => '$refresh',
        'forceCloseInfoModal',
    ];

    protected function rules()
    {
        return [
            'photo' => 'required|image',
        ];
    }

    public function forceClosePhotoModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }

    public function getModelInfo($modelId)
    {
        $this->modelId = $modelId;
        $brand = Team::findorFail($this->modelId);
        $this->name = $brand->name;
    }

    public function closeChangePhotoModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeChangePhotoModal');
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->name = null;
        $this->oldname = null;
    }

    public function ChangeBrandPhoto()
    {
        if (! Storage::disk('public')->exists('team')) {
            Storage::disk('public')->makeDirectory('team', 0775, true);
        }
        $this->validate();

        $model = Team::find($this->modelId);
        Storage::delete('public/team/'.$model->photo);
        $this->photo->store('public/team');
        $model->photo = $this->photo->hashName();
        $model->update();

        $this->dispatchBrowserEvent('SuccessAlert', [
            'name' => $this->name.' was successfully saved!',
            'title' => 'Record Edited Successfully',
        ]);

        $this->cleanVars();
        $this->dispatchBrowserEvent('closeChangePhotoModal');
        $this->emit('refreshParent');
        $this->resetErrorBag();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'photo' => 'required|image',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.team.team-change-photo-form');
    }
}
