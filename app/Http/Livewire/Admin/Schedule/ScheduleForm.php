<?php

namespace App\Http\Livewire\Admin\Schedule;

use Livewire\Component;
use App\Models\Schedule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
class ScheduleForm extends Component
{
    use WithFileUploads;

    public $name, $modelId, $photo;

    protected $listeners = [
        'refreshChild' => '$refresh',
        'forceCloseModal',
    ];

    protected $validationAttributes = [
        'name' => 'schedule name',
        'photo' => 'schedule image',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('schedule')->ignore($this->modelId)],
            'photo' => 'required|image',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:schedule,name,'.$this->modelId.'',
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

    public function StoreScheduleData()
    {
        if (! Storage::disk('public')->exists('schedule')) {
            Storage::disk('public')->makeDirectory('schedule', 0775, true);
        }
        $this->validate();

        if (! empty($this->photo)) {
            $this->photo->store('public/schedule');
        }

        $data = [
            'name' => $this->name,
            'photo' => $this->photo->hashName(),
        ];
        Schedule::create($data);
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
        return view('livewire.admin.schedule.schedule-form');
    }
}
