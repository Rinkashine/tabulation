<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Schedule;
class ListOfSchedules extends Component
{
    public $name;
    public function render()
    {
        $schedules = Schedule::get();
        if($this->name != null){
            $schedule_data = Schedule::findorfail($this->name);
            $schedule_img = $schedule_data->photo;

        }else{
            $schedule_img = '';
            $schedule_data = [];
        }
        return view('livewire.frontend.list-of-schedules',[
            'schedules' => $schedules,
            'schedule_img' => $schedule_img
        ]);
    }
}
