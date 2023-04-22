<?php

namespace App\Http\Livewire\Admin\Tabulation;

use Livewire\Component;
use App\Models\Event;
use App\Models\Classification;
use App\Models\Team;
use App\Models\Score;

class Tabulationcreate extends Component
{
    public $event_id,$classificaiton_id,$event_name,$classification_name;
    public $data = [];
    public $model3;


    public function mount($event,$classification){
        $this->event_id = $event;
        $this->classification_id = $classification;
        $this->model3 = Team::get();
        foreach($this->model3 as $key=>$test){
            $this->data[$key]['team_id'] = $test->id;


        }

    }

    public function rules()
    {
        return [
            'data.*.name' => 'required',
            'data.*.position' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'data.*.name' => 'required',
            'data.*.position' => 'required',
        ]);
    }

    protected $validationAttributes = [

        'data.*.position' => 'position',

    ];

    public function SendTabulationData(){
        $this->validate();
        $configure = Event::find($this->event_id);
        $configure->status = 1;
        $configure->update();

        foreach($this->data as $points){
            Score::create([
                'event_id' => $this->event_id,
                'team_id' => $points['team_id'],
                'classification_pointing_id' => $points['position']
            ]);
        }
        return redirect()->route('tabulation.index');

    }


    public function render()
    {
        $model1 = Event::findorfail($this->event_id);
        $model2 = Classification::findorfail($this->classification_id);

        return view('livewire.admin.tabulation.tabulationcreate',[
            'event' => $model1,
            'classification' => $model2,
            'teams' => $this->model3
        ]);
    }
}
