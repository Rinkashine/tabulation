<?php

namespace App\Http\Livewire\Admin\Schedule;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Schedule;

class ScheduleChangePhotoForm extends Component
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

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'photo' => 'required|image',
        ]);
    }

    public function getModelInfo($modelId)
    {
        $this->modelId = $modelId;
        $schedule = Schedule::findorFail($this->modelId);
        $this->name = $schedule->name;
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

    public function ChangeSchedulePhoto()
    {
        if (! Storage::disk('public')->exists('schedule')) {
            Storage::disk('public')->makeDirectory('schedule', 0775, true);
        }
        $this->validate();

        $model = Schedule::find($this->modelId);
        Storage::delete('public/schedule/'.$model->photo);
        $this->photo->store('public/schedule');
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


    public function forceClosePhotoModal()
    {
        $this->cleanVars();
        $this->resetErrorBag();
    }


    public function render()
    {
        return view('livewire.admin.schedule.schedule-change-photo-form');
    }
}
