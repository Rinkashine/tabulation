<?php

namespace App\Http\Livewire\Admin\Tabulation;

use Livewire\Component;
use App\Models\Event;
use App\Models\Classification;

class Tabulationindex extends Component
{
    public $event,$classification;

    protected $validationAttributes = [
        'event' => 'event name',
    ];

    protected function rules()
    {
        return [
            'event' => ['required'],
            'classification' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'event' => 'required',
            'classification' => 'required'

        ]);
    }

    public function SendTabulationData(){
        $this->validate();
        return redirect()->route('tabulation.create',['event' => $this->event, 'classification' => $this->classification]);
    }
    public function render()
    {
        $events = Event::where('status',0)->get();
        $classifications = Classification::get();
        return view('livewire.admin.tabulation.tabulationindex',[
            'events' => $events,
            'classifications' => $classifications
        ]);
    }
}
