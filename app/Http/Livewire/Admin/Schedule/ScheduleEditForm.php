<?php

namespace App\Http\Livewire\Admin\Schedule;

use Livewire\Component;
use App\Models\Schedule;
use Illuminate\Validation\Rule;

class ScheduleEditForm extends Component
{
    public $name, $modelId, $oldname;

    protected $listeners = [
        'getModelId',
        'refreshChild' => '$refresh',
        'forceCloseEditModal',
    ];

    protected $validationAttributes = [
        'name' => 'schedule name',
    ];

    protected function rules()
    {
        return [
            'name' => ['required', Rule::unique('schedule')->ignore($this->modelId)],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:schedule,name,'.$this->modelId.'',
        ]);
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;
        $schedule = Schedule::findorFail($this->modelId);
        $this->name = $schedule->name;
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

    public function UpdateScheduleData()
    {
        if ($this->modelId) {

            $model = Schedule::find($this->modelId);

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
        return view('livewire.admin.schedule.schedule-edit-form');
    }
}
