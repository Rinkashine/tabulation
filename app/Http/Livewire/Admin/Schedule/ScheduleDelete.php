<?php

namespace App\Http\Livewire\Admin\Schedule;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use App\Models\Schedule;

class ScheduleDelete extends Component
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
            $schedule = Schedule::find($this->modelId);

            Storage::delete('public/schedule/'.$schedule->photo);
            $schedule->delete();

            $this->dispatchBrowserEvent('SuccessAlert', [
                'name' => $schedule->name.' was successfully deleted!',
                'title' => 'Record Deleted',
            ]);
        //}
        $this->emit('refreshParent');
        $this->cleanVars();
        $this->dispatchBrowserEvent('CloseDeleteModal');
    }
    public function render()
    {
        return view('livewire.admin.schedule.schedule-delete');
    }
}
